<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @implements Arrayable<string, mixed>
 */
final class CommittedAccessToken implements Arrayable, \JsonSerializable
{
    public function __construct(
        private readonly AccessToken $accessToken,
        private readonly string $plainTextToken,
    ) {}

    public function getAccessToken(): AccessToken
    {
        return $this->accessToken;
    }

    public function getPlainTextToken(): string
    {
        return $this->plainTextToken;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'accessToken' => $this->accessToken,
            'plainTextToken' => $this->plainTextToken,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
