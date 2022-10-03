<?php


namespace App\Transformer;


use App\Models\Blog;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class BlogTransformer extends TransformerAbstract
{
    public function transform(Blog $blog){
        try {
            $date = Carbon::parse($blog->created_at)->toIso8601String();
            $updateDate = Carbon::parse($blog->updated_at)->toIso8601String();
            $publishDate = Carbon::parse($blog->published_at)->toIso8601String();

            $urlShowBlog = route('admin.blog.show', ['id' => $blog->id]);
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowBlog."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>";

//            $action .= "<a class='delete-modal btn btn-xs btn-danger' data-id='". $blog->id ."' ><i class='fas fa-xs fa-times  '></i></a>";

            return[
                'created_at'        => $date,
                'updated_at'        => $updateDate,
                'published_at'      => $publishDate,
                'title'             => $blog->title,
                'category'          => $blog->category_name ?? "-",
//                'meta_keyword'      => $blog->meta_keyword,
//                'meta_description'  => $blog->meta_description,
//                'read_count'        => $blog->read_count,
                'status'            => $blog->status->description,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/Blog - transform error EX: '. $ex);
            return null;
        }
    }
}
