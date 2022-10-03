<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscriber
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 *
 * @package App\Models
 */
class Subscriber extends Model
{
	protected $table = 'subscribers';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'email'
	];
}
