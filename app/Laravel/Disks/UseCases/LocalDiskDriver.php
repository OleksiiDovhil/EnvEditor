<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\UseCases;

use EnvEditor\Core\Disks\UseCases\DiskDriver;
use EnvEditor\Core\Entities\Config;
use EnvEditor\Core\Entities\File;
use EnvEditor\Exceptions\WrongConfigInDriverException;
use EnvEditor\Laravel\Disks\Entities\LocalConfig;

class LocalDiskDriver implements DiskDriver
{
    /**
     * @var LocalConfig
     */
    private $config;

    /**
     * LocalDiskDriver constructor
     * @param Config $config
     * @return void
     * @throws \EnvEditor\Exceptions\WrongConfigInDriverException
     */
    public function __construct(Config $config)
    {
        if (!($config instanceof LocalConfig)) {
            throw new WrongConfigInDriverException();
        }

        $this->config = $config;
        // Setup Connection
    }

    /**
     * @param File $file
     * @return bool
     */
    public function fileExists(File $file): bool
    {
        return false; // TOdo check existing file
    }

    /**
     * @param File $file
     * @return string
     */
    public function getEnv(File $file): string
    {
        return 'dfs'; // TOdo Get file
    }
}