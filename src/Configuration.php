<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use Illuminate\Support\Facades\Config;

final class Configuration implements ConfigurationInterface
{
    private ?\Closure $accessTokenHasher = null;

    public function __construct()
    {
        $this->setAccessTokenHasher(fn (string $accessToken): string => \hash('sha256', $accessToken));
    }

    public function getAccessTokenModel(): string
    {
        $value = Config::get('zeus.model');

        if (\is_string($value)) {
            return $value;
        }

        throw new \TypeError('Configuration value "zeus.model" must be a string.');
    }

    public function getDefaultAbilities(): ?array
    {
        $value = Config::get('zeus.defaults.abilities');

        if (\is_array($value)) {
            return $value;
        }

        return null;
    }

    public function getDefaultDomains(): ?array
    {
        $value = Config::get('zeus.defaults.domains');

        if (\is_array($value)) {
            return $value;
        }

        return null;
    }

    public function getDefaultExpiration(): ?int
    {
        $value = Config::get('zeus.defaults.expiration');

        if (\is_int($value)) {
            return $value;
        }

        return null;
    }

    public function getDefaultPrefix(): ?string
    {
        $value = Config::get('zeus.defaults.prefix');

        if (\is_string($value)) {
            return $value;
        }

        return null;
    }

    public function getDefaultType(): ?string
    {
        $value = Config::get('zeus.defaults.type');

        if (\is_string($value)) {
            return $value;
        }

        return null;
    }

    public function getAccessTokenHasher(): \Closure
    {
        if ($this->accessTokenHasher === null) {
            throw new \TypeError('Configuration value "accessTokenHasher" must be a Closure.');
        }

        return $this->accessTokenHasher;
    }

    public function setAccessTokenHasher(\Closure $callback): self
    {
        $this->accessTokenHasher = $callback;

        return $this;
    }
}
