<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AboutTeam
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $position
 * @property string|null $description
 * @property string|null $img_path
 * @property string|null $sosmed_1
 * @property string|null $sosmed_2
 * @property string|null $sosmed_3
 * @property string|null $sosmed_4
 * @property string|null $sosmed_5
 * @property int|null $status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Status|null $status
 *
 * @package App\Models
 */
class AboutTeam extends Model
{
	protected $table = 'about_teams';

	protected $casts = [
		'status_id' => 'int'
	];

	protected $fillable = [
		'name',
		'position',
		'description',
		'img_path',
		'sosmed_1',
		'sosmed_2',
		'sosmed_3',
		'sosmed_4',
		'sosmed_5',
		'status_id'
	];

	public function status()
	{
		return $this->belongsTo(Status::class);
	}
}
