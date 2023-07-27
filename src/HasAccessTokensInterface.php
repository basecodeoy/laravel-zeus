<?php

declare(strict_types=1);

namespace BombenProdukt\Zeus;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasAccessTokensInterface
{
    /**
     * @return MorphMany<AccessToken>
     */
    public function accessTokens(): MorphMany;

    public function getAccessToken(): ?AccessToken;

    public function setAccessToken(AccessToken $accessToken): self;
}
