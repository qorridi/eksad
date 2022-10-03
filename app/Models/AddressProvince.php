<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressProvince
 * 
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * 
 * @property Collection|JobApplication[] $job_applications
 *
 * @package App\Models
 */
class AddressProvince extends Model
{
	protected $table = 'address_provinces';
	public $timestamps = false;

	protected $fillable = [
		'code',
		'name'
	];

	public function job_applications()
	{
		return $this->hasMany(JobApplication::class, 'province_id');
	}
}
