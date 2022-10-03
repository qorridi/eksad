<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobVacancyDepartment
 * 
 * @property int $id
 * @property string|null $description
 * @property int $status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|JobVacancy[] $job_vacancies
 *
 * @package App\Models
 */
class JobVacancyDepartment extends Model
{
	protected $table = 'job_vacancy_departments';

	protected $casts = [
		'status_id' => 'int'
	];

	protected $fillable = [
		'description',
		'status_id'
	];

	public function job_vacancies()
	{
		return $this->hasMany(JobVacancy::class);
	}
}
