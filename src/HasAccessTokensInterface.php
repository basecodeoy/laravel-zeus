<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

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
