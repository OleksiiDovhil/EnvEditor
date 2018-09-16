<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Controllers;

use EnvEditor\Core\Disks\DataAccess\Disks;
use EnvEditor\Core\Disks\Entities\Disk;
use EnvEditor\Core\Disks\Entities\DiskFactory;
use EnvEditor\Core\Disks\Requests\ConfigRequestFactory;
use EnvEditor\Core\Disks\Requests\CreateDiskRequest;
use EnvEditor\Core\Disks\Requests\GetDisksRequest;

/**
 * Class DisksController
 */
final class DisksController
{
    /**
     * @var Disks
     */
    private $disks;

    /**
     * @var DiskFactory
     */
    private $diskFactory;

    /**
     * DisksController constructor.
     * @param Disks $disks
     * @param DiskFactory $diskFactory
     */
    public function __construct(Disks $disks, DiskFactory $diskFactory)
    {
        $this->disks = $disks;
        $this->diskFactory = $diskFactory;
    }

    /**
     * @param ConfigRequestFactory $configRequestFactory
     * @param array $request
     */
    public function create(
        ConfigRequestFactory $configRequestFactory,
        array $request
    ): void {
        $this->disks->insert($this->createDisk($configRequestFactory, $request));
    }

    /**
     * @param int $diskId
     * @param ConfigRequestFactory $configRequestFactory
     * @param array $request
     */
    public function update(
        ConfigRequestFactory $configRequestFactory,
        int $diskId,
        array $request
    ): void {
        $this->disks->update($diskId, $this->createDisk($configRequestFactory, $request));
    }

    /**
     * @param array $request
     * @return array
     */
    public function index(array $request): array
    {
        $getDisksRequest = new GetDisksRequest($request);

        return $this->disks->take($getDisksRequest->limit, $getDisksRequest->offset);
    }

    /**
     * @param int $diskId
     * @return Disk
     */
    public function get(int $diskId): Disk
    {
        return $this->disks->find($diskId);
    }

    /**
     * @param ConfigRequestFactory $configRequestFactory
     * @param array $request
     * @return Disk
     */
    private function createDisk(ConfigRequestFactory $configRequestFactory, array $request): Disk
    {
        return $this->diskFactory->create(
            new CreateDiskRequest($request),
            $configRequestFactory->createRequest($request['driver'], $request)
        );
    }
}