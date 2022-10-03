<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Testimonial
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $company_name
 * @property string|null $image_path
 * @property string|null $image_path_2
 * @property string|null $description
 * @property int|null $status_id
 *
 * @package App\Models
 */
class Testimonial extends Model
{
	protected $table = 'testimonials';
	public $timestamps = false;

	protected $casts = [
		'status_id' => 'int'
	];

	protected $fillable = [
		'name',
		'company_name',
		'image_path',
		'image_path_2',
		'description',
		'status_id'
	];
}
