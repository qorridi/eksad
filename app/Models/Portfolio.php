<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Portfolio
 *
 * @property int $id
 * @property string|null $client_name
 * @property string|null $img_logo
 * @property string|null $img_primary
 * @property string|null $description
 * @property string|null $description_2
 * @property string|null $description_3
 * @property string|null $description_4
 * @property string|null $description_5
 * @property int|null $year
 * @property int|null $status_id
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 *
 * @property Collection|PortfolioImage[] $portfolio_images
 * @property Collection|Product[] $products
 * @property Collection|PortfolioSolution[] $portfolio_solutions
 *
 * @package App\Models
 */
class Portfolio extends Model
{
	protected $table = 'portfolios';

	protected $casts = [
		'year' => 'int',
		'status_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'client_name',
		'img_logo',
		'img_primary',
		'description',
		'description_2',
		'description_3',
		'description_4',
		'description_5',
		'year',
		'status_id',
		'created_by',
		'updated_by'
	];

	public function portfolio_images()
	{
		return $this->hasMany(PortfolioImage::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'portfolio_products')
					->withPivot('id', 'product_name', 'product_slug');
	}

    public function solutions()
    {
        return $this->belongsToMany(Solution::class, 'portfolio_solutions')
            ->withPivot('id');
    }

	public function portfolio_solutions()
	{
		return $this->hasMany(PortfolioSolution::class);
	}
}
