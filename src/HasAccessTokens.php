<?php

declare(strict_types=1);

namespace BaseCodeOy\Zeus;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAccessTokens
{
    private AccessToken $accessToken;

    public function accessTokens(): MorphMany
    {
        return $this->morphMany(AccessToken::class, 'tokenable');
    }

    public function getAccessToken(): ?AccessToken
    {
        return $this->accessToken;
    }

    public function setAccessToken(AccessToken $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }
}
