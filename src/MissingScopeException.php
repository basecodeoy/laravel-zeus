<?php

declare(strict_types=1);

namespace BombenProdukt\Zeus;

use Illuminate\Auth\Access\AuthorizationException;

final class MissingScopeException extends AuthorizationException
{
    public function __construct(
        private readonly array $scopes = [],
        string $message = 'Invalid scope(s) provided.',
    ) {
        parent::__construct($message);
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }
}
