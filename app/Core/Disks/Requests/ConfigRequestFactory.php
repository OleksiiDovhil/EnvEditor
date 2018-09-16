<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Requests;

/**
 * Interface ConfigRequestFactory
 * @package EnvEditor\Core\Disks\Requests
 */
interface ConfigRequestFactory
{
    /**
     * @param string $driver
     * @param array $request
     * @return ConfigRequest
     */
    public function createRequest(string $driver, array $request): ConfigRequest;
}