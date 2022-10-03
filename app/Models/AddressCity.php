<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressCity
 * 
 * @property int $id
 * @property string|null $code
 * @property int|null $province_id
 * @property string|null $type
 * @property string|null $name
 * @property string|null $postal_code
 * 
 * @property Collection|JobApplication[] $job_applications
 *
 * @package App\Models
 */
class AddressCity extends Model
{
	protected $table = 'address_cities';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'province_id' => 'int'
	];

	protected $fillable = [
		'code',
		'province_id',
		'type',
		'name',
		'postal_code'
	];

	public function job_applications()
	{
		return $this->hasMany(JobApplication::class, 'city_id');
	}
}
