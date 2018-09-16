<?php
declare(strict_types=1);

namespace EnvEditor\Core\Entities;

use EnvEditor\Core\Entities\Exceptions\PropertyDoesntExistsInEntityException;
use EnvEditor\Core\Entities\Exceptions\WrongEntityTypeReturnedError;
use EnvEditor\Core\Entities\Exceptions\WrongEntityTypeToBeSetError;

/**
 * Class Entity
 *
 * Supported types: 'null', 'string', 'int', 'bool', 'float', 'object'(Class of object)
 */
abstract class Entity
{
    public const SET = 1;
    public const GET = 2;
    protected const CASTS = null;
    private const BASIC_TYPES = [
        'null',
        'string',
        'int',
        'bool',
        'float'
    ];

    /**
     * @var array
     */
    private $entityCastsRules;

    /**
     * @var array
     */
    private $dataContainer = [];

    /**
     * Entity constructor
     */
    public function __construct()
    {
        $this->entityCastsRules = $this->getCasts();
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     * @throws \EnvEditor\Core\Entities\Exceptions\PropertyDoesntExistsInEntityException
     * @throws WrongEntityTypeToBeSetError
     */
    public function __set($name, $value)
    {
        [$type, $result] = $this->checkAndReturnType($name, $value, self::SET);

        if (!$result) {
            throw new WrongEntityTypeToBeSetError($this, $name, $this->entityCastsRules[$name], $type);
        }

        $this->dataContainer[$name] = $value;
    }

    /**
     * @param string $name
     * @throws \EnvEditor\Core\Entities\Exceptions\PropertyDoesntExistsInEntityException
     * @throws WrongEntityTypeReturnedError
     * @return mixed
     */
    public function __get(string $name)
    {
        $value = $this->dataContainer[$name] ?? null;
        [$type, $result] = $this->checkAndReturnType($name, $value, self::GET);

        if (!$result) {
            throw new WrongEntityTypeReturnedError($this, $name, $this->entityCastsRules[$name], $type);
        }

        return $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return array_key_exists($name, $this->entityCastsRules);
    }

    /**
     * @return array|null
     */
    public function getCasts(): ?array
    {
        return static::CASTS;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param int $type
     * @return array
     * @throws \EnvEditor\Core\Entities\Exceptions\PropertyDoesntExistsInEntityException
     */
    private function checkAndReturnType(string $name, $value, int $type): array
    {
        $rules = $this->entityCastsRules[$name] ?? null;

        if ($rules === null) {
            throw new PropertyDoesntExistsInEntityException($this, $name, $type);
        }

        $result = false;
        $class = null;

        foreach ($rules as $rule) {
            if (\in_array($rule, self::BASIC_TYPES, true)) {
                $result = $result || \call_user_func('is_' . $rule, $value);

                continue;
            }

            if (\is_object($value) && class_exists($rule)) {
                $result = $result || $value instanceof $rule;
                $class = \get_class($value);
            }
        }

        return [$class ?? \gettype($value), $result];
    }
}