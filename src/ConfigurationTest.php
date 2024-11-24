<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use BaseCodeOy\Zeus\Configuration;
use Illuminate\Support\Facades\Config;

beforeEach(function (): void {
    $this->configuration = new Configuration();
});

afterEach(function (): void {
    Mockery::close();
});

it('can get access token model', function (): void {
    Config::shouldReceive('get')
        ->with('zeus.model')
        ->andReturn('Model');

    expect($this->configuration->getAccessTokenModel())->toBe('Model');
});

it('can get default abilities', function (): void {
    Config::shouldReceive('get')
        ->with('zeus.defaults.abilities')
        ->andReturn(['*']);

    expect($this->configuration->getDefaultAbilities())->toBe(['*']);
});

it('can get default domains', function (): void {
    Config::shouldReceive('get')
        ->with('zeus.defaults.domains')
        ->andReturn(['localhost']);

    expect($this->configuration->getDefaultDomains())->toBe(['localhost']);
});

it('can get default expiration', function (): void {
    Config::shouldReceive('get')
        ->with('zeus.defaults.expiration')
        ->andReturn(3_600);

    expect($this->configuration->getDefaultExpiration())->toBe(3_600);
});

it('can get default prefix', function (): void {
    Config::shouldReceive('get')
        ->with('zeus.defaults.prefix')
        ->andReturn('prefix');

    expect($this->configuration->getDefaultPrefix())->toBe('prefix');
});

it('can get default type', function (): void {
    Config::shouldReceive('get')
        ->with('zeus.defaults.type')
        ->andReturn('type');

    expect($this->configuration->getDefaultType())->toBe('type');
});

it('can get and set access token hasher', function (): void {
    $hasher = fn (string $accessToken): string => \hash('sha256', $accessToken);

    $this->configuration->setAccessTokenHasher($hasher);

    expect($this->configuration->getAccessTokenHasher())->toBe($hasher);
});
