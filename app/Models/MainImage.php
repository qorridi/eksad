<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MainImage
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $image_path
 * @property string|null $description
 * @property string|null $alt_text
 * @property string|null $url
 * @property string|null $target
 * @property string $status
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MainImage extends Model
{
	protected $table = 'main_images';

	protected $casts = [
		'sort_order' => 'int'
	];

	protected $fillable = [
		'name',
		'image_path',
		'description',
		'alt_text',
		'url',
		'target',
		'status',
		'sort_order'
	];
}
