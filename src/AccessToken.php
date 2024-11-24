<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use BaseCodeOy\Zeus\Database\Factories\AccessTokenFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property list<string>             $abilities
 * @property list<string>             $domains
 * @property null|Carbon              $expires_at
 * @property null|Carbon              $last_used_at
 * @property string                   $name
 * @property string                   $token
 * @property HasAccessTokensInterface $tokenable
 * @property string                   $type
 */
final class AccessToken extends Model
{
    use HasFactory;

    protected $casts = [
        'abilities' => 'array',
        'domains' => 'array',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected $fillable = [
        'type',
        'name',
        'token',
        'abilities',
        'domains',
        'last_used_at',
        'expires_at',
    ];

    protected $hidden = ['token'];

    /**
     * @return MorphTo<Model, HasAccessTokensInterface>
     */
    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }

    public function can(string $ability): bool
    {
        if (\in_array('*', $this->abilities, true)) {
            return true;
        }

        return \array_key_exists($ability, \array_flip($this->abilities));
    }

    public function cannot(string $ability): bool
    {
        return !$this->can($ability);
    }

    public function hasExpired(): bool
    {
        return $this->expires_at?->isPast() === true;
    }

    /**
     * @return Factory<AccessTokenFactory>
     */
    protected static function newFactory(): Factory
    {
        return AccessTokenFactory::new();
    }
}
