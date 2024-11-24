<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
