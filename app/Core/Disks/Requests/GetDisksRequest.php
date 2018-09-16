<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Requests;

/**
 * Class GetDisksRequest
 * @property int $limit
 * @property int $offset
 */
class GetDisksRequest
{
    /**
     * GetDisksRequest constructor.
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->limit = $request['limit'];
        $this->offset = $request['offset'];
    }
}