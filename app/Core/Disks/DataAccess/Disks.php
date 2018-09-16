<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\DataAccess;

use EnvEditor\Core\Disks\Entities\Disk;

/**
 * Class Disks
 */
interface Disks
{
    /**
     * @param int $diskId
     * @return Disk|null
     */
    public function find(int $diskId): ?Disk;

    /**
     * @param Disk $disk
     * @return void
     */
    public function insert(Disk $disk): void;

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