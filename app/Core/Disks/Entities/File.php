<?php
declare(strict_types=1);

namespace EnvEditor\Core\Entities;

/**
 * Class File
 */
final class File extends Entity
{
    protected const CASTS = [
        'id' => ['int'],
        'path' => ['string']
    ];
}