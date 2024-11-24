<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use Illuminate\Auth\Access\AuthorizationException;

final class MissingAbilityException extends AuthorizationException
{
    public function __construct(
        private readonly array $abilities = [],
        string $message = 'Invalid ability provided.',
    ) {
        parent::__construct($message);
    }

    public function getAbilities(): array
    {
        return $this->abilities;
    }
}
