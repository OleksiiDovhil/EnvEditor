<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\UseCases;

use EnvEditor\Core\Entities\Config;

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