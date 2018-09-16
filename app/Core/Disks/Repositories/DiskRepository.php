<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Repositories;

use EnvEditor\Core\Disks\Entities\Disk;

/**
 * Class DiskRepository
 */
interface DiskRepository
{
    /**
     * @param int $diskId
     * @return Disk
     */
    public function find(int $diskId): Disk;

    /**
     * @param Disk $disk
     * @return void
     */
    public function create(Disk $disk): void;

    /**
     * @param int $diskId
     * @param Disk $disk
     * @return void
     */
    public function update(int $diskId, Disk $disk): void;

    /**
     * @param int $limit
     * @param int $offset
     * @return Disk[]
     */
    public function take(int $limit, int $offset): array;
}