<?php

declare(strict_types=1);

namespace BaseCodeOy\Zeus;

use Carbon\Carbon;

it('can set and get type', function (): void {
    $pendingAccessToken = new PendingAccessToken();
    $pendingAccessToken->setType('type');
    expect($pendingAccessToken->getType())->toBe('type');
});

it('can set and get name', function (): void {
    $pendingAccessToken = new PendingAccessToken();
    $pendingAccessToken->setName('name');
    expect($pendingAccessToken->getName())->toBe('name');
});

it('can set and get prefix', function (): void {
    $pendingAccessToken = new PendingAccessToken();
    $pendingAccessToken->setPrefix('prefix');
    expect($pendingAccessToken->getPrefix())->toBe('prefix');
});

it('can set and get abilities', function (): void {
    $pendingAccessToken = new PendingAccessToken();
    $pendingAccessToken->setAbilities(['ability1', 'ability2']);
    expect($pendingAccessToken->getAbilities())->toBe(['ability1', 'ability2']);
});

it('can set and get domains', function (): void {
    $pendingAccessToken = new PendingAccessToken();
    $pendingAccessToken->setDomains(['domain1', 'domain2']);
    expect($pendingAccessToken->getDomains())->toBe(['domain1', 'domain2']);
});

it('can set and get expiresAt', function (): void {
    $pendingAccessToken = new PendingAccessToken();
    $date = Carbon::parse('2023-07-26');
    $pendingAccessToken->setExpiration($date);
    expect($pendingAccessToken->getExpiration())->toBe($date);
});
