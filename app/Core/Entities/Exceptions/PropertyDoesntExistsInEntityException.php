<?php
declare(strict_types=1);

namespace EnvEditor\Core\Entities\Exceptions;

use EnvEditor\Core\Entities\Entity;
use ErrorException;

/**
 * Class PropertyDoesntExistsInEntityException
 */
class PropertyDoesntExistsInEntityException extends ErrorException
{
    /**
     * PropertyDoesntExistsInEntityException constructor.
     *
     * @param Entity $entity
     * @param string $property
     * @param int $type
     */
    public function __construct(Entity $entity, string $property, int $type)
    {
        $message = 'Exception throws in ' . get_class($entity) . '; When try to '
            . $type === Entity::GET ? 'get' : 'set'
            . ' property \'' . $property . ' This property does not exists in this entity.';

        parent::__construct($message, 500);
    }
}