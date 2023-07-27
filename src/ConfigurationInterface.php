<?php

declare(strict_types=1);

namespace BombenProdukt\Zeus;

use Closure;

interface ConfigurationInterface
{
    public function getAccessTokenModel(): string;

    public function getDefaultAbilities(): ?array;

    public function getDefaultDomains(): ?array;

    public function getDefaultExpiration(): ?int;

    public function getDefaultPrefix(): ?string;

    public function getDefaultType(): ?string;

    public function getAccessTokenHasher(): Closure;

    public function setAccessTokenHasher(Closure $callback): self;
}
