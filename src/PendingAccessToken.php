<?php

declare(strict_types=1);

namespace BombenProdukt\Zeus;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

final class PendingAccessToken implements Arrayable, JsonSerializable
{
    private string $type;

    private string $name;

    private string $prefix;

    private array $abilities = ['*'];

    private array $domains = ['*'];

    private ?Carbon $expiresAt = null;

    public static function make(): self
    {
        return new self();
    }

    public static function defaults(): self
    {
        $instance = new self();

        if (Zeus::getDefaultAbilities()) {
            $instance->setAbilities(Zeus::getDefaultAbilities());
        }

        if (Zeus::getDefaultDomains()) {
            $instance->setDomains(Zeus::getDefaultDomains());
        }

        if (Zeus::getDefaultExpiration()) {
            $instance->setExpiration(Carbon::now()->addMinutes(Zeus::getDefaultExpiration()));
        }

        if (Zeus::getDefaultPrefix()) {
            $instance->setPrefix(Zeus::getDefaultPrefix());
        }

        if (Zeus::getDefaultType()) {
            $instance->setType(Zeus::getDefaultType());
        }

        return $instance;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getAbilities(): array
    {
        return $this->abilities;
    }

    public function setAbilities(array $abilities): self
    {
        $this->abilities = $abilities;

        return $this;
    }

    public function getDomains(): ?array
    {
        return $this->domains;
    }

    public function setDomains(array $domains): self
    {
        $this->domains = $domains;

        return $this;
    }

    public function getExpiration(): ?Carbon
    {
        return $this->expiresAt;
    }

    public function setExpiration(?Carbon $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'type' => $this->getType(),
            'name' => $this->getName(),
            'prefix' => $this->getPrefix(),
            'abilities' => $this->getAbilities(),
            'domains' => $this->getDomains(),
            'expires_at' => $this->getExpiration(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
