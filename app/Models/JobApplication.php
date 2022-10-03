<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobApplication
 *
 * @property int $id
 * @property int|null $job_vacancy_id
 * @property string|null $name
 * @property string|null $gender
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $district
 * @property string|null $city
 * @property string|null $province
 * @property string|null $country
 * @property string|null $sosmed1
 * @property string|null $sosmed2
 * @property string|null $sosmed3
 * @property string|null $sosmed4
 * @property string|null $sosmed5
 * @property string|null $online_porto_1
 * @property string|null $online_porto_2
 * @property string|null $short_desc
 * @property int $status_id
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 *
 * @property JobVacancy|null $job_vacancy
 * @property Collection|JobApplicationCertificate[] $job_application_certificates
 * @property Collection|JobApplicationEducation[] $job_application_educations
 * @property Collection|JobApplicationExperience[] $job_application_experiences
 * @property Collection|JobApplicationPortfolio[] $job_application_portfolios
 *
 * @package App\Models
 */
class JobApplication extends Model
{
	protected $table = 'job_applications';

	protected $casts = [
		'job_vacancy_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
        'status_id' => 'int'
	];

	protected $fillable = [
		'job_vacancy_id',
		'name',
		'gender',
		'phone',
		'email',
		'address',
		'district',
		'city',
		'province',
		'country',
		'sosmed1',
		'sosmed2',
		'sosmed3',
		'sosmed4',
		'sosmed5',
		'online_porto_1',
		'online_porto_2',
		'short_desc',
        'status_id',
		'created_by',
		'updated_by'
	];

	public function job_vacancy()
	{
		return $this->belongsTo(JobVacancy::class);
	}

	public function job_application_certificates()
	{
		return $this->hasMany(JobApplicationCertificate::class, 'career_application_id');
	}

	public function job_application_educations()
	{
		return $this->hasMany(JobApplicationEducation::class, 'career_application_id');
	}

	public function job_application_experiences()
	{
		return $this->hasMany(JobApplicationExperience::class, 'career_application_id');
	}

	public function job_application_portfolios()
	{
		return $this->hasMany(JobApplicationPortfolio::class, 'career_application_id');
	}
}
