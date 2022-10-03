<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PortfolioProduct
 * 
 * @property int $id
 * @property int|null $portfolio_id
 * @property int|null $product_id
 * @property string|null $product_name
 * @property string|null $product_slug
 * 
 * @property Portfolio|null $portfolio
 * @property Product|null $product
 *
 * @package App\Models
 */
class PortfolioProduct extends Model
{
	protected $table = 'portfolio_products';
	public $timestamps = false;

	protected $casts = [
		'portfolio_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'portfolio_id',
		'product_id',
		'product_name',
		'product_slug'
	];

	public function portfolio()
	{
		return $this->belongsTo(Portfolio::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
