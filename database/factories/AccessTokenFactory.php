<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus\Database\Factories;

use BaseCodeOy\TypeId\TypeId;
use BaseCodeOy\Zeus\AccessToken;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<AccessToken>
 */
final class AccessTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'personal_access_token',
            'name' => Str::random(10),
            'token' => TypeId::fromPrefix('pta'),
            'abilities' => ['*'],
            'domains' => ['*'],
            'last_used_at' => Carbon::now(),
            'expires_at' => Carbon::now()->addYear(),
        ];
    }
}
