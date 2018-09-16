<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Entities;

use EnvEditor\Core\Disks\Requests\ConfigRequest;
use EnvEditor\Core\Disks\Requests\CreateDiskRequest;

/**
 * Class DiskFactory
 * @package EnvEditor\Core\Disks\Entities
 */
abstract class DiskFactory
{
    /**
     * @param CreateDiskRequest $request
     * @param ConfigRequest $configRequest
     * @return Disk
     */
    public function create(CreateDiskRequest $request, ConfigRequest $configRequest): Disk
    {
        $disk = new Disk();
        $disk->alias = $request->alias;
        $disk->driver = $request->driver;
        $disk->config = $this->createConfig($configRequest);

        return $disk;
    }

    /**
     * @param ConfigRequest $request
     * @return Config
     */
    abstract protected function createConfig(ConfigRequest $request): Config;
}