<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\Adapters\Entities;

use EnvEditor\Core\Disks\Entities\Config;

/**
 * Class LocalConfig
 */
final class LocalConfig extends Config
{
    public const DRIVER = 'local';

    protected const CASTS = [
        'root' => ['string'],
    ];

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return self::DRIVER;
    }
}