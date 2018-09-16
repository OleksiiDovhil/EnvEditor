<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\UseCases;

use EnvEditor\Core\Entities\Config;
use EnvEditor\Core\Entities\File;

/**
 * Interface DiskDriver
 * @package EnvEditor\Core\Disks\UseCases
 */
interface DiskDriver
{
    /**
     * DiskDriver constructor.
     * @param Config $config
     */
    public function __construct(Config $config);

    /**
     * @param File $file
     * @return bool
     */
    public function fileExists(File $file): bool;

    /**
     * @param File $file
     * @return string
     */
    public function getEnv(File $file): string; // TODO will be Env entity
}