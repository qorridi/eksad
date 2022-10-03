<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class AdminUser
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class AdminUser extends Authenticatable
{
    protected $guard = 'admin';
	protected $table = 'admin_users';

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'name',
		'phone',
		'password',
		'created_by',
		'updated_by'
	];
}
