<?php
declare(strict_types=1);

return [
    'drivers' => [
        \EnvEditor\Laravel\Disks\Adapters\Entities\LocalConfig::DRIVER => [
            \EnvEditor\Core\Disks\Entities\Config::class
                => \EnvEditor\Laravel\Disks\Adapters\Entities\LocalConfig::class,
            \EnvEditor\Core\DiskDrivers\UseCases\DiskDriver::class
                => \EnvEditor\Laravel\Disks\Adapters\UseCases\LocalDiskDriver::class,
            \EnvEditor\Core\Disks\Requests\ConfigRequest::class
                => \EnvEditor\Laravel\Disks\Adapters\Requests\LocalConfigRequest::class
        ]
    ]
];