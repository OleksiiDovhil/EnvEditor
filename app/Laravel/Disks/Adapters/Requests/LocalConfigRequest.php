<?php
declare(strict_types=1);

namespace EnvEditor\Laravel\Disks\Adapters\Requests;

use EnvEditor\Core\Disks\Requests\ConfigRequest;
use EnvEditor\Laravel\Disks\Adapters\Entities\LocalConfig;

/**
 * Class LocalConfigRequest
 * @package EnvEditor\Laravel\Disks\Adapters\Requests
 */
class LocalConfigRequest implements ConfigRequest
{
    /**
     * LocalConfigRequest constructor.
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->root = $request['root'];
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return LocalConfig::DRIVER;
    }
}