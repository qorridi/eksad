<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PortfolioSolution
 * 
 * @property int $id
 * @property int|null $portfolio_id
 * @property int|null $solution_id
 * 
 * @property Portfolio|null $portfolio
 * @property Solution|null $solution
 *
 * @package App\Models
 */
class PortfolioSolution extends Model
{
	protected $table = 'portfolio_solutions';
	public $timestamps = false;

	protected $casts = [
		'portfolio_id' => 'int',
		'solution_id' => 'int'
	];

	protected $fillable = [
		'portfolio_id',
		'solution_id'
	];

	public function portfolio()
	{
		return $this->belongsTo(Portfolio::class);
	}

	public function solution()
	{
		return $this->belongsTo(Solution::class);
	}
}
