<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * 
 * @property int $id
 * @property string|null $description
 * 
 * @property Collection|Blog[] $blogs
 * @property Collection|CompanyAdmin[] $company_admins
 * @property Collection|Complaint[] $complaints
 * @property Collection|PaymentType[] $payment_types
 * @property Collection|Transaction[] $transactions
 * @property Collection|UserPackage[] $user_packages
 * @property Collection|UserUnit[] $user_units
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Status extends Model
{
	protected $table = 'statuses';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function blogs()
	{
		return $this->hasMany(Blog::class);
	}

	public function company_admins()
	{
		return $this->hasMany(CompanyAdmin::class);
	}

	public function complaints()
	{
		return $this->hasMany(Complaint::class);
	}

	public function payment_types()
	{
		return $this->hasMany(PaymentType::class);
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

	public function user_packages()
	{
		return $this->hasMany(UserPackage::class);
	}

	public function user_units()
	{
		return $this->hasMany(UserUnit::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
