<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Solution
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $image_path
 * @property int|null $status_id
 * @property int|null $solution_category_id
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 *
 * @property SolutionCategory|null $solution_category
 *
 * @package App\Models
 */
class Solution extends Model
{
	protected $table = 'solutions';

	protected $casts = [
		'status_id' => 'int',
		'solution_category_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'image_path',
		'status_id',
		'solution_category_id',
		'created_by',
		'updated_by'
	];

	public function solution_category()
	{
		return $this->belongsTo(SolutionCategory::class);
	}

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio_solutions')
            ->withPivot('id');
    }
}
