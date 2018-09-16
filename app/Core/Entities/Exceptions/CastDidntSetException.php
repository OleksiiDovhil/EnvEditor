<?php
declare(strict_types=1);

namespace EnvEditor\Core\Entities\Exceptions;

use EnvEditor\Core\Entities\Entity;
use ErrorException;

/**
 * Class CastDidntSetException
 */
class CastDidntSetException extends ErrorException
{
    /**
     * CastDidntSetException constructor.
     *
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $message = 'Casts const did not set in ' . \get_class($entity) . ' entity;';

        parent::__construct($message, 500);
    }
}