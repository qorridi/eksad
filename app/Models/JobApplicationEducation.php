<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobApplicationEducation
 * 
 * @property int $id
 * @property int|null $career_application_id
 * @property string|null $instution
 * @property string|null $degree
 * @property string|null $field_of_study
 * @property string|null $grade
 * @property string|null $location
 * @property string|null $start_year
 * @property string|null $end_year
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
class JobApplicationEducation extends Model
{
	protected $table = 'job_application_educations';

	protected $casts = [
		'career_application_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'career_application_id',
		'instution',
		'degree',
		'field_of_study',
		'grade',
		'location',
		'start_year',
		'end_year',
		'description',
		'created_by',
		'updated_by'
	];

	public function job_application()
	{
		return $this->belongsTo(JobApplication::class, 'career_application_id');
	}
}
