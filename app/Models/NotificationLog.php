<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationLog
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $user_unit_id
 * @property string|null $user_phone
 * @property string|null $user_name
 * @property string|null $transaction_number
 * @property int|null $transaction_id
 * @property string|null $type
 * @property string|null $unit_code
 * @property Carbon|null $created_at
 *
 * @package App\Models
 */
class NotificationLog extends Model
{
	protected $table = 'notification_logs';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'user_unit_id' => 'int',
		'transaction_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'user_unit_id',
		'user_phone',
		'user_name',
		'transaction_number',
		'transaction_id',
		'type',
		'unit_code'
	];
}
