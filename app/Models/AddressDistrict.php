<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressDistrict
 * 
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property int|null $city_id
 * 
 * @property Collection|JobApplication[] $job_applications
 *
 * @package App\Models
 */
class AddressDistrict extends Model
{
	protected $table = 'address_districts';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'city_id' => 'int'
	];

	protected $fillable = [
		'code',
		'name',
		'city_id'
	];

	public function job_applications()
	{
		return $this->hasMany(JobApplication::class, 'district_id');
	}
}
