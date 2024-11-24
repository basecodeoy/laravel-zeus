<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use BaseCodeOy\PackagePowerPack\Package\AbstractServiceProvider;
use Illuminate\Auth\RequestGuard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->singleton(
            ConfigurationInterface::class,
            Configuration::class,
        );

        Config::set([
            'auth.guards.zeus' => [
                'driver' => 'zeus',
                'provider' => null,
            ],
        ]);
    }

    public function packageBooted(): void
    {
        Auth::resolved(function ($auth): void {
            $auth->extend('zeus', function ($app, $name, array $config) {
                App::refresh(
                    'request',
                    $guard = new RequestGuard(
                        new Guard(),
                        request(),
                        Auth::createUserProvider($config['provider'] ?? null),
                    ),
                    'setRequest',
                );

                return $guard;
            });
        });
    }
}
