<?php

declare(strict_types=1);

namespace BaseCodeOy\Zeus;

final readonly class AccessTokenAuthenticated
{
    public function __construct(private AccessToken $token) {}

    public function getAccessToken(): AccessToken
    {
        return $this->token;
    }
}
