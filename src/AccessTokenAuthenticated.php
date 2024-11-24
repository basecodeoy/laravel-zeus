<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

final readonly class AccessTokenAuthenticated
{
    public function __construct(
        private AccessToken $token,
    ) {}

    public function getAccessToken(): AccessToken
    {
        return $this->token;
    }
}
