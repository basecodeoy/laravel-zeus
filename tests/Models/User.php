<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Models;

use BaseCodeOy\Zeus\HasAccessTokens;
use BaseCodeOy\Zeus\HasAccessTokensInterface;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Auth;

final class User extends Auth implements HasAccessTokensInterface
{
    use HasFactory;
    use HasAccessTokens;

    protected static function newFactory(): Factory
    {
        return new UserFactory();
    }
}
