<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

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
