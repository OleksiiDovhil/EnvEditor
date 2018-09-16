<?php
declare(strict_types=1);

namespace EnvEditor\Core\Entities\Exceptions;

use EnvEditor\Core\Entities\Entity;
use ErrorException;

/**
 * Class WrongEntityTypeReturnedError
 */
class WrongEntityTypeReturnedError extends ErrorException
{
    /**
     * WrongEntityTypeReturnedError constructor.
     *
     * @param Entity $entity
     * @param string $property
     * @param array $casts
     * @param string $real
     */
    public function __construct(Entity $entity, string $property, array $casts, string $real)
    {
        $message = 'Type Error throws in ' . get_class($entity) . '; When try to get property \'' . $property
            . '\' must be in next rules: [' . implode(',', $casts) . '] but get ' . $real . ' instead.';

        parent::__construct($message, 500);
    }
}