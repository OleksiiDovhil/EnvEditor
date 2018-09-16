<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\Adapters\UseCases;

use EnvEditor\Core\DiskDrivers\UseCases\DiskDriver;
use EnvEditor\Core\DiskDrivers\UseCases\DiskDriverFactory as DiskDriverFactoryContract;
use EnvEditor\Core\Disks\Entities\Config;

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
        $driver = \config('enveditor.' . $config->getDriver())[DiskDriver::class];

        return new $driver($config);
    }
}