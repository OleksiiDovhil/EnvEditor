<?php
declare(strict_types=1);

namespace Tests\Unit\Core\Disks;

use EnvEditor\Core\Disks\Controllers\DisksController;
use EnvEditor\Core\Disks\DataAccess\Disks;
use EnvEditor\Core\Disks\Entities\Config;
use EnvEditor\Core\Disks\Entities\Disk;
use EnvEditor\Core\Disks\Entities\DiskFactory;
use EnvEditor\Core\Disks\Requests\ConfigRequest;
use EnvEditor\Core\Disks\Requests\ConfigRequestFactory;
use Tests\TestCase;

/**
 * Class DisksControllerTest
 * @covers \EnvEditor\Core\Disks\Controllers\DisksController
 */
class DisksControllerTest extends TestCase
{
    /**
     * @var int
     */
    private $iterationSavingNewDisk = 0;

    /**
     * @return void
     */
    public function testCreateNewDisk(): void
    {
        $this->createDisk(1);
    }

    /**
     * @return void
     */
    public function testUpdateDisk(): void
    {
        $this->createDisk(1);
        $controller = new DisksController($this->getDisks(), $this->getDiskFactory());
        $controller->update($this->getConfigRequestFactory(), $this->iterationSavingNewDisk, [
            'driver' => 'test',
            'alias' => 'updated',
            'testField' => 'updated'
        ]);
        $disk = $this->getDisks()->find($this->iterationSavingNewDisk);
        $this->assertSame($disk->alias, 'updated');
        $this->assertSame($disk->config->field, 'updated');
    }

    /**
     * @return void
     */
    public function testTakeDisks(): void
    {
        $this->createDisk(10);
        $controller = new DisksController($this->getDisks(), $this->getDiskFactory());
        $disks = $controller->index([
            'limit' => 3,
            'offset' => 5
        ]);

        $firstId = 6;
        foreach ($disks as $disk) {
            $this->assertSame($firstId++, $disk->id);
        }
    }

    /**
     * @param int $count
     */
    private function createDisk(int $count): void
    {
        while ($count-- > 0) {
            $controller = new DisksController($this->getDisks(), $this->getDiskFactory());

            $controller->create($this->getConfigRequestFactory(), [
                'driver' => 'test',
                'alias' => 'test',
                'testField' => 'some text'
            ]);
            $this->iterationSavingNewDisk++;
            $this->assertNotNull($this->getDisks()->find($this->iterationSavingNewDisk));
        }
    }

    /**
     * @return ConfigRequestFactory
     */
    private function getConfigRequestFactory(): ConfigRequestFactory
    {
        return new class() implements ConfigRequestFactory
        {
            /**
             * @param string $driver
             * @param array $request
             * @return ConfigRequest
             */
            public function createRequest(string $driver, array $request): ConfigRequest
            {
                return new class($request) implements ConfigRequest
                {
                    /**
                     * ConfigRequest constructor.
                     * @param array $request
                     */
                    public function __construct(array $request)
                    {
                        $this->testField = $request['testField'];
                    }

                    /**
                     * @return string
                     */
                    public function getDriver(): string
                    {
                        return 'test';
                    }
                };
            }
        };
    }

    /**
     * @return DiskFactory
     */
    private function getDiskFactory(): DiskFactory
    {
        /**
         * Class DiskFactory
         */
        return new class() extends DiskFactory
        {
            /**
             * @param ConfigRequest $request
             * @return Config
             */
            protected function createConfig(ConfigRequest $request): Config
            {
                $config =  new class extends Config {

                    protected const CASTS = [
                        'field' => ['string']
                    ];

                    /**
                     * @return string
                     */
                    public function getDriver(): string
                    {
                        return 'test';
                    }
                };

                $config->field = $request->testField;

                return $config;
            }
        };
    }

    /**
     * @return Disks
     */
    private function getDisks(): Disks
    {
        static $disks = null;

        if ($disks !== null) {
            return $disks;
        }

        /**
         * Class Disks
         * @property $field
         */
        $disks =  new class() implements Disks {

            /**
             * @var array
             */
            private $storage = [];

            /**
             * @param int $diskId
             * @return Disk|null
             */
            public function find(int $diskId): ?Disk
            {
                return $this->storage[$diskId];
            }

            /**
             * @param Disk $disk
             * @return void
             */
            public function insert(Disk $disk): void
            {
                $newId = empty($this->storage) ? 1 : max(array_keys($this->storage)) + 1;
                $disk->id = $newId;
                $this->storage[$newId] = $disk;
            }

            /**
             * @param int $diskId
             * @param Disk $disk
             * @return void
             */
            public function update(int $diskId, Disk $disk): void
            {
                $oldDisk = $this->storage[$diskId];
                foreach (array_keys($disk->getCasts()) as $property) {
                    $oldDisk->$property = $disk->$property;
                }
            }

            /**
             * @param int $limit
             * @param int $offset
             * @return Disk[]
             */
            public function take(int $limit, int $offset): array
            {
                return \array_slice($this->storage, $offset, $limit);
            }
        };

        return $disks;
    }
}