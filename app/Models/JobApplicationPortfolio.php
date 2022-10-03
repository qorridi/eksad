<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobApplicationPortfolio
 * 
 * @property int $id
 * @property int|null $career_application_id
 * @property string|null $filename
 * 
 * @property JobApplication|null $job_application
 *
 * @package App\Models
 */
class JobApplicationPortfolio extends Model
{
	protected $table = 'job_application_portfolios';
	public $timestamps = false;

	protected $casts = [
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
