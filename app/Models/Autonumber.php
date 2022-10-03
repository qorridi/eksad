<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Autonumber
 * 
 * @property int $id
 * @property string|null $doc_code
 * @property int|null $next_no
 *
 * @package App\Models
 */
class Autonumber extends Model
{
	protected $table = 'autonumbers';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'next_no' => 'int'
	];

	protected $fillable = [
		'doc_code',
		'next_no'
	];
}
