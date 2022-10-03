<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobApplicationCertificate
 *
 * @property int $id
 * @property int|null $career_application_id
 * @property string|null $filename
 *
 * @property JobApplication|null $job_application
 *
 * @package App\Models
 */
class JobApplicationCertificate extends Model
{
	protected $table = 'job_application_certificates';
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'career_application_id' => 'int'
	];

	protected $fillable = [
		'career_application_id',
		'filename'
	];

	public function job_application()
	{
		return $this->belongsTo(JobApplication::class, 'career_application_id');
	}
}
