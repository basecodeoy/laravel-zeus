<?php

declare(strict_types=1);

namespace Tests\Models;

use BombenProdukt\Zeus\HasAccessTokens;
use BombenProdukt\Zeus\HasAccessTokensInterface;
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
