<?php
declare(strict_types=1);

namespace EnvEditor\Core\Disks\Entities;

use EnvEditor\Core\Entities\Entity;

/**
 * Class Config
 */
abstract class Config extends Entity
{
    /**
     * @return string
     */
    abstract public function getDriver(): string;
}