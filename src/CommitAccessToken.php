<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use BaseCodeOy\TypeId\PrefixException;
use BaseCodeOy\TypeId\TypeId;

final readonly class CommitAccessToken
{
    /**
     * @throws PrefixException
     */
    public function __invoke(PendingAccessToken $pendingAccessToken, HasAccessTokensInterface $hasAccessTokens): CommittedAccessToken
    {
        $plainTextToken = TypeId::fromPrefix($pendingAccessToken->getPrefix())->toString();

        /** @var AccessToken $accessToken */
        $accessToken = $hasAccessTokens->accessTokens()->create([
            'type' => $pendingAccessToken->getType(),
            'name' => $pendingAccessToken->getName(),
            'token' => Zeus::getAccessTokenHasher()($plainTextToken),
            'abilities' => $pendingAccessToken->getAbilities(),
            'domains' => $pendingAccessToken->getDomains(),
            'expires_at' => $pendingAccessToken->getExpiration(),
        ]);

        return new CommittedAccessToken($accessToken, $plainTextToken);
    }
}
