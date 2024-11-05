<?php

declare(strict_types=1);

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
