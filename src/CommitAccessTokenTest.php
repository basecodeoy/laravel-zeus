<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use Carbon\Carbon;
use Tests\Models\User;
use function Pest\Laravel\assertDatabaseHas;

it('can commit access token', function (): void {
    $user = User::factory()->create();

    expect($user->accessTokens()->count())->toBe(0);

    $committedAccessToken = (new CommitAccessToken())(
        PendingAccessToken::make()
            ->setType('personal_access_token')
            ->setName('workflows')
            ->setPrefix('pta')
            ->setAbilities(['*'])
            ->setDomains(['*'])
            ->setExpiration($expiration = Carbon::now()->addYear()),
        $user
    );

    expect($committedAccessToken)->toBeInstanceOf(CommittedAccessToken::class);
    expect($user->accessTokens()->count())->toBe(1);

    assertDatabaseHas('access_tokens', [
        'tokenable_id' => $user->id,
        'tokenable_type' => $user::class,
        'type' => 'personal_access_token',
        'name' => 'workflows',
        'abilities' => \json_encode(['*']),
        'domains' => \json_encode(['*']),
        'expires_at' => $expiration,
    ]);
});
