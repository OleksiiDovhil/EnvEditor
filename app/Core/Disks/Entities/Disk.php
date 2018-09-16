<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Entities;

use EnvEditor\Core\Entities\Entity;

/**
 * Class Disk
 *
 * @property int $id
 * @property string $alias
 * @property string $driver
 * @property Config $config
 */
final class Disk extends Entity
{
    protected const CASTS = [
        'id' => ['int', 'null'],
        'alias' => ['string'],
        'driver' => ['string'],
        'config' => [Config::class]
    ];
}