<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Requests;

/**
 * Class CreateDiskRequest
 * @property string $alias
 * @property string $driver
 */
final class CreateDiskRequest
{
    /**
     * CreateDiskRequest constructor.
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->alias = $request['alias'];
        $this->driver = $request['driver'];
    }
}