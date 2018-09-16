<?php
declare(strict_types=1);

namespace EnvEditor\Core\DiskDrivers\UseCases;

use EnvEditor\Core\Disks\Entities\Config;

/**
 * Interface DiskDriver
 * @package EnvEditor\Core\Disks\UseCases
 */
interface DiskDriverFactory
{
    /**
     * @param Config $config
     * @return DiskDriver
     */
    public function makeDriver(Config $config): DiskDriver;
}