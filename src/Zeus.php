<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Zeus;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Closure               getAccessTokenHasher()
 * @method static string                 getAccessTokenModel()
 * @method static ?array                 getDefaultAbilities()
 * @method static ?array                 getDefaultDomains()
 * @method static ?int                   getDefaultExpiration()
 * @method static ?string                getDefaultPrefix()
 * @method static ?string                getDefaultType()
 * @method static ConfigurationInterface setAccessTokenHasher(\Closure $callback)
 */
final class Zeus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ConfigurationInterface::class;
    }
}
