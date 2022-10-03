<?php

namespace App\Sys_Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BlcokUnit
 *
 * @property int $id
 * @property int $id_Branch
 * @property string $Code
 * @property string $Name
 * @property float $LandArea
 * @property float $BuildingArea
 * @property string $VA_BCA
 * @property string $VA_BNI
 * @property string $VA_Mandiri
 * @property string $VA_BRI
 * @property int|null $Active
 * @property int $StatusUnit
*/

class BlockUnit extends Model
{
    protected $connection= 'sqlsrv';
    protected $table = 'm_BlockUnit';

    protected $casts = [
        'id'            => 'int',
        'id_Branch'     => 'int',
        'id_BlockType'  => 'int',
        'id_BlockView'  => 'int',
        'id_Project'    => 'int',
        'id_Cluster'    => 'int',
        'id_Status'     => 'int',
    ];
}
