<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AddressCountry
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $phone_code
 * @property string|null $currency_code
 * @property string|null $currency_symbol
 * @property string|null $lang_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|JobApplication[] $job_applications
 *
 * @package App\Models
 */
class AddressCountry extends Model
{
	protected $table = 'address_countries';

	protected $fillable = [
		'code',
		'name',
		'phone_code',
		'currency_code',
		'currency_symbol',
		'lang_code'
	];

	public function job_applications()
	{
		return $this->hasMany(JobApplication::class, 'country_id');
	}
}
