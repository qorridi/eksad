<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SolutionCategory
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $image_path
 * @property int $status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|JobVacancy[] $job_vacancies
 * @property Collection|Solution[] $solutions
 *
 * @package App\Models
 */
class SolutionCategory extends Model
{
	protected $table = 'solution_categories';

	protected $casts = [
		'status_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'image_path',
		'status_id'
	];

	public function job_vacancies()
	{
		return $this->hasMany(JobVacancy::class, 'service_category_id');
	}

	public function solutions()
	{
		return $this->hasMany(Solution::class);
	}
}
