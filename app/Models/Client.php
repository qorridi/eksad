<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $image_path
 * @property string|null $image_path_mobile
 * @property string|null $description
 * @property string|null $alt_text
 * @property string|null $url
 * @property string|null $target
 * @property string $status
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $banner_type
 *
 * @package App\Models
 */
class Client extends Model
{
	protected $table = 'clients';

	protected $casts = [
		'sort_order' => 'int',
		'banner_type' => 'int'
	];

	protected $fillable = [
		'name',
		'image_path',
		'image_path_mobile',
		'description',
		'alt_text',
		'url',
		'target',
		'status',
		'sort_order',
		'banner_type'
	];
}
