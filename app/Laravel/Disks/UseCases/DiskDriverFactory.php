<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\UseCases;

use EnvEditor\Core\Disks\UseCases\DiskDriver;
use EnvEditor\Core\Disks\UseCases\DiskDriverFactory as DiskDriverFactoryContract;
use EnvEditor\Core\Entities\Config;

/**
 * Class LocalDriverFactory
 * @package EnvEditor\Laravel\Disks\UseCases
 */
class DiskDriverFactory implements DiskDriverFactoryContract
{
    /**
     * @param Config $config
     * @return DiskDriver
     */
    public function makeDriver(Config $config): DiskDriver
    {
        $drivers = \config('enveditor.driver');

        return new $drivers[\get_class($config)]($config);
    }
}