<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Requests;

/**
 * Interface ConfigRequest
 */
interface ConfigRequest
{
    /**
     * ConfigRequest constructor.
     * @param array $request
     */
    public function __construct(array $request);

    /**
     * @return string
     */
    public function getDriver(): string;
}