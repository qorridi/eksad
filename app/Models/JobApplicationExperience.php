<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobApplicationExperience
 * 
 * @property int $id
 * @property int|null $career_application_id
 * @property string|null $title
 * @property string|null $type
 * @property string|null $company
 * @property string|null $start_month
 * @property string|null $start_year
 * @property string|null $end_month
 * @property string|null $end_year
 * @property int|null $is_still_working
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * 
 * @property JobApplication|null $job_application
 *
 * @package App\Models
 */
class JobApplicationExperience extends Model
{
	protected $table = 'job_application_experiences';

	protected $casts = [
		'career_application_id' => 'int',
		'is_still_working' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'career_application_id',
		'title',
		'type',
		'company',
		'start_month',
		'start_year',
		'end_month',
		'end_year',
		'is_still_working',
		'description',
		'created_by',
		'updated_by'
	];

	public function job_application()
	{
		return $this->belongsTo(JobApplication::class, 'career_application_id');
	}
}
