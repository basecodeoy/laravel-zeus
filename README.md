## About Laravel Zeus

This project was created by, and is maintained by [Brian Faust](https://github.com/faustbrian), and is a Laravel-compatible API token manager featuring prefix and ability scoping support. Be sure to browse through the [changelog](CHANGELOG.md), [code of conduct](.github/CODE_OF_CONDUCT.md), [contribution guidelines](.github/CONTRIBUTING.md), [license](LICENSE), and [security policy](.github/SECURITY.md).

## Design

Laravel Zeus, in terms of design goals, is akin to [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum). It offers a lightweight authentication system for APIs, similar to Sanctum. However, it's important to note that Zeus isn't meant to replace Sanctum, Passport, or Fortify. Instead, it serves as a simpler alternative for developers who don't need the extensive features of the aforementioned systems. Its primary function is to authenticate users using easily identifiable API tokens. This design choice makes it simpler to detect and revoke tokens.

All the access tokens are stored in the `access_tokens` table and are prefixed at the time of generation. The prefixing helps distinguish the token types, for instance, `pat` is used for personal access tokens. We employ [TypeID](https://github.com/jetpack-io/typeid) to generate these tokens. It creates type-safe, K-sortable, and globally unique API keys. The design is inspired by the system used by Stripe IDs.

Moreover, Laravel Zeus offers the option to restrict tokens to particular abilities and domains. This measure adds another layer of control over their usage. Tokens can also be programmed to expire after a specified duration from their creation. This feature is especially useful for creating short-lived tokens for one-time-use scenarios or long-lived tokens for trusted applications. This auto-expiry function not only enhances security but also enforces regular token rotation, mitigating the risks associated with a permanent token leak.

## Installation

> **Note**
> This package requires [PHP](https://www.php.net/) 8.2 or later, and it supports [Laravel](https://laravel.com/) 10 or later.

To get the latest version, simply require the project using [Composer](https://getcomposer.org/):

```bash
$ composer require bombenprodukt/laravel-zeus
```

You can publish the migrations by using:

```bash
$ php artisan vendor:publish --tag="laravel-zeus-migrations"
```

You can publish the configuration file by using:

```bash
$ php artisan vendor:publish --tag="laravel-zeus-config"
```

## Usage

> **Note**
> Please review the contents of [our test suite](/tests) for detailed usage examples.

The first step to get started is to prepare your model by implementing the `HasAccessTokensInterface` interface. This can be done by including the `HasAccessTokens` trait, which provides default implementations for all necessary methods. The process is as follows:

```diff
<?php

namespace App\Models;

use BombenProdukt\Zeus\HasAccessTokens;
use BombenProdukt\Zeus\HasAccessTokensInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
- use Laravel\Sanctum\HasApiTokens;

- class User extends Authenticatable implements MustVerifyEmail
+ class User extends Authenticatable implements HasAccessTokensInterface, MustVerifyEmail
{
-    use HasApiTokens;
+    use HasAccessTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
```

Once you've completed that, you can open your `routes/api.php` file and replace `auth:sanctum` with `auth:zeus`. Everything should work as before, provided you use valid Zeus access tokens.

```diff
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

-Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
+Route::middleware('auth:zeus')->get('/user', function (Request $request) {
    return $request->user();
});
```

Now that you've set up your model, you could create a controller to store an access token based on user input, such as providing a name for it. Take a look at the `PendingAccessToken` class for all available getters and setters. However, in most cases, it's enough to stick to the defaults once you've configured them to match your use case.

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use BombenProdukt\Zeus\CommitAccessToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreAccessTokenController
{
    public function __invoke(Request $request, CommitAccessToken $commitAccessToken): Response
    {
        return $commitAccessToken(
            PendingAccessToken::defaults()->setName($request->input('name')),
            $request->user()
        );
    }
}
```

If you want to apply rate limiting per access token rather than user ID or IP address, you could achieve this by modifying the API Rate Limiter inside the `app/Providers/RouteServiceProvider.php` file and specifying the access token as the identifier for rate limiting attempts.

```diff
<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
-            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
+            return Limit::perMinute(60)->by($request->user()?->getAccessToken()?->token ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
```
