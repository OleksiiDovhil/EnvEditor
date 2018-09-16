<?php
declare(strict_types=1);

return [
    'drivers' => [
        \EnvEditor\Laravel\Disks\Entities\LocalConfig::class => \EnvEditor\Laravel\Disks\UseCases\LocalDiskDriver::class
    ]
];