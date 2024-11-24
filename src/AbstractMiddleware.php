<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

abstract readonly class AbstractMiddleware
{
    /**
     * @throws AuthenticationException
     */
    protected function getAccessTokenFromRequest(Request $request): AccessToken
    {
        /** @var null|HasAccessTokensInterface $user */
        $user = $request->user();

        if ($user === null) {
            throw new AuthenticationException();
        }

        $accessToken = $user->getAccessToken();

        if ($accessToken === null) {
            throw new AuthenticationException();
        }

        return $accessToken;
    }
}
