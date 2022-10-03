<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ForgotPasswordHistory
 * 
 * @property int $id
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property string|null $last_password
 * @property string|null $new_password
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class ForgotPasswordHistory extends Model
{
	protected $table = 'forgot_password_histories';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int'
	];

	protected $hidden = [
		'last_password',
		'new_password'
	];

	protected $fillable = [
		'user_id',
		'last_password',
		'new_password'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
