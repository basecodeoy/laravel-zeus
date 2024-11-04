<?php

declare(strict_types=1);

namespace BaseCodeOy\Zeus;

use Carbon\Carbon;
use Illuminate\Http\Request;

final readonly class Guard
{
    public function __invoke(Request $request): HasAccessTokensInterface
    {
        $accessToken = $this->getAccessTokenFromRequest($request);

        if ($accessToken->domains !== null) {
            if (!\in_array('*', $accessToken->domains, true)) {
                abort_unless(
                    \in_array($request->getSchemeAndHttpHost(), $accessToken->domains, true),
                    401,
                    'This access token cannot be used with your domain.',
                );
            }
        }

        abort_if(
            $accessToken->hasExpired(),
            401,
            'This access token has expired.',
        );

        $tokenable = $accessToken->tokenable->setAccessToken($accessToken);

        event(new AccessTokenAuthenticated($accessToken));

        $accessToken->update(['last_used_at' => Carbon::now()]);

        return $tokenable;
    }

    private function getAccessTokenFromRequest(Request $request): AccessToken
    {
        $accessToken = $request->bearerToken() ?? $request->get('access_token');

        abort_unless(\is_string($accessToken), 401, 'Please provide a valid access token.');

        $accessToken = AccessToken::where('token', Zeus::getAccessTokenHasher()($accessToken))->first();

        abort_unless($accessToken instanceof AccessToken, 401, 'Please provide a valid access token.');

        return $accessToken;
    }
}
