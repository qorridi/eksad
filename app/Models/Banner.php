<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Banner
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $image_path
 * @property string|null $alt_text
 * @property string|null $description
 * @property string|null $description_1
 * @property string|null $description_2
 * @property string|null $url
 * @property string|null $target
 * @property string $status
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class Banner extends Model
{
	protected $table = 'banners';

	protected $casts = [
		'sort_order' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'name',
		'image_path',
		'alt_text',
		'description',
		'description_1',
		'description_2',
		'url',
		'target',
		'status',
		'sort_order',
		'created_by',
		'updated_by'
	];
}
