<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use GuzzleHttp\Psr7\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

final readonly class CheckForAnyAbility extends AbstractMiddleware
{
    /**
     * @throws AuthenticationException
     */
    public function handle(Request $request, \Closure $next, string ...$abilities): Response
    {
        $accessToken = $this->getAccessTokenFromRequest($request);

        foreach ($abilities as $ability) {
            if ($accessToken->can($ability)) {
                return $next($request);
            }
        }

        throw new MissingAbilityException($abilities);
    }
}
