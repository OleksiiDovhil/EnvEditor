<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\Entities;

use EnvEditor\Core\Entities\Config;

/**
 * Class LocalConfig
 */
final class LocalConfig extends Config
{
    protected const CASTS = [
        'driver' => ['string'],
        'root' => ['string'],
    ];
}