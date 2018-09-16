<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\Adapters\Entities;

use EnvEditor\Core\Disks\Entities\Config;
use EnvEditor\Core\Disks\Entities\DiskFactory as AbstractDiskFactory;
use EnvEditor\Core\Disks\Requests\ConfigRequest;

class DiskFactory extends AbstractDiskFactory
{
    /**
     * @param ConfigRequest $request
     * @return Config
     */
    protected function createConfig(ConfigRequest $request): Config
    {
        $configClass = \config('enveditor.' . $request->getDriver())[Config::class];
        /** @var LocalConfig $config */
        $config = new $configClass;

        foreach (array_keys($config->getCasts()) as $property) {
            $config->$property = $request->$property;
        }

        return $config;
    }
}