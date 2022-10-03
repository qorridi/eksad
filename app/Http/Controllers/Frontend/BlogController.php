<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\Share;

class BlogController extends Controller
{
    private static $poageContext = '';
    public function index(Request $request){
        $now = Carbon::now()->format('Y-m-d 00:00:00');
        $blogs = Blog::with('blog_category')->where('status_id', 10)
            ->where('published_at', '<=', $now)->skip(2)->take(1000)->orderByDesc('created_at');
        $relatedBlogs = Blog::with('blog_category')
            ->where('status_id', 10)
            ->where('published_at', '<=', $now)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $latestBlogs = Blog::with('blog_category')
            ->where('status_id', 10)
            ->where('published_at', '<=', $now)
            ->latest()
            ->limit(2)
            ->get();

        $filterKeyword = '';
        if($request->keyword !== null){
            $filterKeyword = $request->keyword;
            $blogs = $blogs->where('title', 'LIKE', '%'. $filterKeyword. '%');
        }
        $filterCategoryName = '';
        $filterCategoryId = 0;
        if($request->category_id !== null){
            $filterCategory = $request->category_id;
            $categoryDb = BlogCategory::where('id', $filterCategory)->first();

            $filterCategoryId = $request->category_id;
            $filterCategoryName = $categoryDb->description;
            $blogs = $blogs->where('blog_category_id', $filterCategory);
        }

        $blogs = $blogs->paginate(6);

        if(str_contains($request->keyword, '%')){
            $blogs = [];
        }

        return view('frontend.blog', [
            'blogs' => $blogs,
            'filterKeyword' => $filterKeyword,
            'filterCategoryId' => $filterCategoryId,
            'filterCategoryName' => $filterCategoryName,
            'relatedBlogs' => $relatedBlogs,
            'latestBlogs' => $latestBlogs
        ]);
    }

    public function show($slug){
        $now = Carbon::now()->format('Y-m-d 00:00:00');
        $blog = Blog::with('blog_category')
            ->where('slug', '=', $slug)
            ->first();

        if(empty($blog)){
            return 'BAD REQUEST';
        }

        $relatedBlogs = Blog::with('blog_category')
            ->where('status_id', 10)
            ->where('blog_category_id', $blog->blog_category_id)
            ->where('published_at', '<=', $now)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $shareButtons = (new \Jorenvh\Share\Share)->page(route('frontend.blog.show', ['slug' => $blog->slug]), $blog->title)
            ->linkedin('Something New from Eksad For your Interest')
            ->facebook()
            ->whatsapp()
            ->getRawLinks();
//        $shareButtons = [
//            'whatsapp' => '',
//            'facebook' => '',
//            'linkedin' => '',
//            'share' => '',
//        ];

        return view('frontend.blog_detail', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
            'shareButtons' => $shareButtons,
        ]);
    }
}
