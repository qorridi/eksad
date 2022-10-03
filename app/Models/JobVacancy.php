<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobVacancy
 * 
 * @property int $id
 * @property int|null $solution_category_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $job_vacancy_level_id
 * @property int|null $job_vacancy_department_id
 * @property string|null $location
 * @property int|null $status_id
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * @property string|null $slug
 * 
 * @property JobVacancyDepartment|null $job_vacancy_department
 * @property JobVacancyLevel|null $job_vacancy_level
 * @property SolutionCategory|null $solution_category
 * @property Collection|JobApplication[] $job_applications
 *
 * @package App\Models
 */
class JobVacancy extends Model
{
	protected $table = 'job_vacancies';

	protected $casts = [
		'solution_category_id' => 'int',
		'job_vacancy_level_id' => 'int',
		'job_vacancy_department_id' => 'int',
		'status_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'solution_category_id',
		'name',
		'description',
		'job_vacancy_level_id',
		'job_vacancy_department_id',
		'location',
		'status_id',
		'created_by',
		'updated_by',
		'slug'
	];

	public function job_vacancy_department()
	{
		return $this->belongsTo(JobVacancyDepartment::class);
	}

	public function job_vacancy_level()
	{
		return $this->belongsTo(JobVacancyLevel::class);
	}

	public function solution_category()
	{
		return $this->belongsTo(SolutionCategory::class);
	}

	public function job_applications()
	{
		return $this->hasMany(JobApplication::class);
	}
}
