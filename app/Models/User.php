<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $citcall_token
 * @property string|null $device_id
 * @property string|null $notif_token
 * @property int|null $status_id
 * @property string|null $forgot_password_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Status|null $status
 * @property Collection|ComplaintDetail[] $complaint_details
 * @property Collection|Complaint[] $complaints
 * @property Collection|ForgotPasswordHistory[] $forgot_password_histories
 * @property Collection|Transaction[] $transactions
 * @property Collection|UserCompany[] $user_companies
 * @property Collection|UserNotification[] $user_notifications
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'status_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'citcall_token',
		'forgot_password_token'
	];

	protected $fillable = [
		'name',
		'phone',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'citcall_token',
		'device_id',
		'notif_token',
		'status_id',
		'forgot_password_token'
	];

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

	public function complaint_details()
	{
		return $this->hasMany(ComplaintDetail::class);
	}

	public function complaints()
	{
		return $this->hasMany(Complaint::class);
	}

	public function forgot_password_histories()
	{
		return $this->hasMany(ForgotPasswordHistory::class);
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

	public function user_companies()
	{
		return $this->hasMany(UserCompany::class);
	}

	public function user_notifications()
	{
		return $this->hasMany(UserNotification::class);
	}
}
