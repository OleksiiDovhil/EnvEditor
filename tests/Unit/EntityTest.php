<?php
declare(strict_types=1);

namespace Tests\Unit;

use EnvEditor\Core\Entities\Entity;
use EnvEditor\Core\Entities\Exceptions\CastDidntSetException;
use EnvEditor\Core\Entities\Exceptions\PropertyDoesntExistsInEntityException;
use EnvEditor\Core\Entities\Exceptions\WrongEntityTypeReturnedError;
use EnvEditor\Core\Entities\Exceptions\WrongEntityTypeToBeSetError;
use Tests\TestCase;

/**
 * Class EntityTest
 * @package Tests\Unit
 */
class EntityTest extends TestCase
{
    /**
     * @return void
     */
    public function testWrongSetTypeThrowedError(): void
    {
        $this->expectException(WrongEntityTypeToBeSetError::class);
        $entity = $this->getEntity(['string', 'nullable']);
        $entity->field = 123;
    }

    /**
     * @return void
     */
    public function testWrongGetTypeThrowedError(): void
    {
        $this->expectException(WrongEntityTypeReturnedError::class);
        $entity = $this->getEntity(['string']);
        $entity->field;
        // Field stay to be null
    }

    /**
     * @return void
     */
    public function testSaveNotExistsProperty(): void
    {
        $this->expectException(PropertyDoesntExistsInEntityException::class);
        $entity = $this->getEntity(['string']);
        $entity->wrongProprty = 'sdf';
    }

    /**
     * @return void
     */
    public function testGetNotExistsProperty(): void
    {
        $this->expectException(PropertyDoesntExistsInEntityException::class);
        $entity = $this->getEntity(['string']);
        $entity->wrongProprty;
    }

    /**
     * @return void
     */
    public function testEntityExtendedWituoutOverloadingCastsConst(): void
    {
        $this->expectException(CastDidntSetException::class);
        $this->getEntity();
    }

    /**
     * @return void
     */
    public function testSupportedTypesFilledWithoutError(): void
    {
        $entity = $this->getEntity(['null', 'string']);
        $entity->field = '123';
        $this->assertSame($entity->field, '123');
        $entity->field = null;
        $this->assertNull($entity->field);
        $entity = $this->getEntity(['int']);
        $entity->field = 123;
        $this->assertSame($entity->field, 123);
        $entity = $this->getEntity(['bool']);
        $entity->field = true;
        $this->assertTrue($entity->field);
        $entity = $this->getEntity(['float']);
        $entity->field = 123.123;
        $this->assertSame($entity->field, 123.123);
        $entity = $this->getEntity([\stdClass::class]);
        $entity->field = new \stdClass();
        $this->assertInstanceOf(\stdClass::class, $entity->field);
    }

    /**
     * @param array|null $rules
     * @return Entity
     */
    private function getEntity(?array $rules = null): Entity
    {
        /**
         * Class Extended Entity
         * @property $field
         */
        return new class($rules) extends Entity {
            /**
             * @var array|null
             */
            private $testCaseRules;

            /**
             *  constructor.
             * @param array $rules
             * @throws \EnvEditor\Core\Entities\Exceptions\CastDidntSetException
             */
            public function __construct(?array $rules = null)
            {
                $this->testCaseRules = $rules === null ? null : ['field' => $rules];
                parent::__construct();
            }

            /**
             * @return array|null
             */
            protected function getCasts(): ?array
            {
                return $this->testCaseRules;
            }
        };
    }
}