<?php
declare(strict_types=1);

namespace EnvEditor\Exceptions;

use LogicException;

/**
 * Class WrongConfigInDriverException
 * @package EnvEditor\Exceptions
 */
class WrongConfigInDriverException extends LogicException
{
    public function __construct()
    {
        parent::__construct("Wrong Config Type Set in Disk Driver", 500);
    }
}