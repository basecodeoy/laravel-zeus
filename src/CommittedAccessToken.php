<?php

declare(strict_types=1);

namespace BombenProdukt\Zeus;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * @implements Arrayable<string, mixed>
 */
final class CommittedAccessToken implements Arrayable, JsonSerializable
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
