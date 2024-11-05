<?php

declare(strict_types=1);

namespace BaseCodeOy\Zeus;

beforeEach(function (): void {
    $this->accessToken = new AccessToken();
});

it('can get AccessToken', function (): void {
    $committedAccessToken = new CommittedAccessToken($this->accessToken, 'plainTextToken');

    expect($committedAccessToken->getAccessToken())->toBe($this->accessToken);
});

it('can get plain text token', function (): void {
    $committedAccessToken = new CommittedAccessToken($this->accessToken, 'plainTextToken');

    expect($committedAccessToken->getPlainTextToken())->toBe('plainTextToken');
});

it('can convert to array', function (): void {
    $committedAccessToken = new CommittedAccessToken($this->accessToken, 'plainTextToken');

    expect($committedAccessToken->toArray())->toBe(['accessToken' => $this->accessToken, 'plainTextToken' => 'plainTextToken']);
});

it('can json serialize', function (): void {
    $committedAccessToken = new CommittedAccessToken($this->accessToken, 'plainTextToken');

    expect($committedAccessToken->jsonSerialize())->toBe(['accessToken' => $this->accessToken, 'plainTextToken' => 'plainTextToken']);
});
