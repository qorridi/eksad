<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategory
 *
 * @property int $id
 * @property string|null $description
 * @property int|null $status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Blog[] $blogs
 *
 * @package App\Models
 */
class BlogCategory extends Model
{
	protected $table = 'blog_categories';

	protected $fillable = [
		'description',
		'status_id',
	];

	public function blogs()
	{
		return $this->hasMany(Blog::class);
	}
}
