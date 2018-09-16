<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\Adapters\Requests;

use EnvEditor\Core\Disks\Requests\ConfigRequest;
use EnvEditor\Core\Disks\Requests\ConfigRequestFactory as ConfigRequestFactoryContract;

/**
 * Class ConfigRequestFactory
 * @package EnvEditor\Laravel\Disks\Adapters\Requests
 */
class ConfigRequestFactory implements ConfigRequestFactoryContract
{
    /**
     * @param string $driver
     * @param array $request
     * @return ConfigRequest
     */
    public function createRequest(string $driver, array $request): ConfigRequest
    {
        $requestClass = config('enveditor.' . $driver)[ConfigRequest::class];

        return new $requestClass($request);
    }
}