<?php
declare(strict_types=1);

namespace EnvEditor\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Disk
 *
 * @property int $id
 * @property string $alias
 * @property string $driver
 * @property array $config
 */
class Disk extends Model
{
    const TABLE_NAME = 'disks';

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int'
    ];

    /**
     * @param string $config
     * @return array
     */
    public function getConfigAttribute(string $config): array
    {
        return decrypt($config);
    }

    /**
     * @param array $config
     * @return void
     */
    public function setConfigAttribute(array $config): void
    {
        $this->attributes['config'] = encrypt($config);
    }
}