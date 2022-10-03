<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Blog
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $subtitle
 * @property string|null $slug
 * @property string|null $img_path
 * @property string|null $optional_path
 * @property string|null $description_1
 * @property string|null $description_2
 * @property string|null $description_3
 * @property int|null $blog_category_id
 * @property string|null $read_count
 * @property int|null $status_id
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $meta_keyword
 * @property string|null $meta_description
 *
 * @property BlogCategory|null $blog_category
 * @property Status|null $status
 *
 * @package App\Models
 */
class Blog extends Model
{
	protected $table = 'blogs';

	protected $casts = [
		'blog_category_id' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'published_at'
	];

	protected $fillable = [
		'title',
		'subtitle',
		'slug',
		'img_path',
		'optional_path',
		'description_1',
		'description_2',
		'description_3',
		'blog_category_id',
		'read_count',
		'status_id',
		'published_at',
		'meta_keyword',
		'meta_description'
	];

	public function blog_category()
	{
		return $this->belongsTo(BlogCategory::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}
}
