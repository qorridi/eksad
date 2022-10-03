<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PortfolioImage
 * 
 * @property int $id
 * @property int|null $portfolio_id
 * @property string|null $img_path
 * @property bool|null $is_primary
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Portfolio|null $portfolio
 *
 * @package App\Models
 */
class PortfolioImage extends Model
{
	protected $table = 'portfolio_images';

	protected $casts = [
		'portfolio_id' => 'int',
		'is_primary' => 'bool'
	];

	protected $fillable = [
		'portfolio_id',
		'img_path',
		'is_primary'
	];

	public function portfolio()
	{
		return $this->belongsTo(Portfolio::class);
	}
}
