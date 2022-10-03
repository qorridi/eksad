<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Transformer\BlogTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.blog.index');
    }

    public function getIndex(Request $request){

//        $blogs = Blog::query();
        $blogs = Blog::join('statuses', 'statuses.id', '=', 'blogs.status_id')
            ->join('blog_categories', 'blog_categories.id', '=', "blogs.blog_category_id")
            ->select('blogs.*', 'statuses.description as status_description', 'blog_categories.description as category_name')
            ->where('blogs.id', '>', 0)->orderby('blogs.created_at', 'asc')->get();

        error_log($blogs->count());

        return DataTables::of($blogs)
            ->setTransformer(new BlogTransformer)
            ->make(true);
    }

    public function show($id){
        $categories = BlogCategory::all();
        $blog = Blog::find($id);
        if(empty($blog)){
            return redirect()->back();
        }
        $detailImage = [];
        if(!empty($blog->optional_path)){
            $filenameArrs = explode(";", $blog->optional_path);
            foreach ($filenameArrs as $filenameArr){
                if(!empty($filenameArr)){
                    array_push($detailImage, $filenameArr);
                }
            }
        }

        $data = [
            'blog'  => $blog,
            'categories'  => $categories,
            'detailImage'  => $detailImage
        ];
        return view('admin.blog.show')->with($data);
    }

    public function create(){
        $blogs = Blog::find(1);
        $categories = BlogCategory::where('status_id', 1)->get();
        $data = [
            'categories'    => $categories,
            'blogs'    => $blogs,
        ];
        return view('admin.blog.create')->with($data);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title'              => 'required|regex:/^[a-zA-Z]/u|max:100',
//            'content'            => 'required',
            'category'            => 'required',
            'subtitle'            => 'required|regex:/^[a-zA-Z]/u',
//            'm_keyword'            => 'required',
//            'm_description'            => 'required',
            'start_date'            => 'required',
        ],[
            'title.required'        => 'Judul artikel wajib diisi!',
//            'content.required'      => 'Konten artikel wajib diisii!',
            'category.required'      => 'Kategori artikel wajib diisii!',
            'subtitle.required'      => 'Deskripsi Singkat artikel wajib diisii!',
//            'm_keyword.required'      => 'Meta Keyword wajib diisii!',
//            'm_description.required'      => 'Meta Description Singkat artikel wajib diisii!',
            'start_date.required'      => 'Tanggal Publish artikel wajib diisii!',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        if($request->input('category') == -1){
            return redirect()->back()->withErrors('Kategori artikel wajib diisii!', 'default')->withInput($request->all());
        }
        if($request->input('status_id') == -1){
            return redirect()->back()->withErrors('Status artikel wajib diisii!', 'default')->withInput($request->all());
        }
        $detailImages = $request->file('detail_image');
        if($request->input('category') == 5 ||  $request->input('category') == 6){
            if($detailImages == null){
                return back()->withErrors("Images wajib diisi untuk Category yang dipilih")->withInput($request->all());
            }
        }


        if($request->file('featured-image') == null){
            return redirect()->back()->withErrors('Gambar utama wajib upload!', 'default')->withInput($request->all());
        }

        // Checking title exist
        $title = Utilities::removeSpecialCharactes($request->input('title'));
        $titleLower = strtolower($title);

        $existBlog = Blog::whereRaw("LOWER(title) LIKE '%". $titleLower ."%'")->first();
        //dd($existBlog);
        if(!empty($existBlog)){
            return redirect()->back()->withErrors('Judul Artikel sudah ada!', 'default')->withInput($request->all());
        }

        $dateTimeNow = Carbon::now('Asia/Jakarta');

        $startDateRequest = $request->input('start_date');
        $startDate = Carbon::parse($startDateRequest)->format('Y-m-d 00:00:00');

        $user = Auth::guard('admin')->user();
        $slug = Str::slug(strtolower($request->input('title')));
//        dd($request);
        $newBlog = Blog::create([
            'title'             => $title,
            'slug'              => $slug,
            'blog_category_id'       => $request->input('category'),
            'subtitle'          => Utilities::removeSpecialCharactes($request->input('subtitle') ?? ""),
            'description_1'       => $request->input('content') ?? null,
            'meta_keyword'      => $request->input('m_keyword'),
            'meta_description'  => $request->input('m_description'),
            'read_count'        => 0,
            'status_id'         => $request->input('status_id'),
            'published_at'      => Carbon::parse($request->input('start_date'))->toDateTimeString(),
            'created_at'        => $dateTimeNow->toDateTimeString(),
            'created_by'        => $user->id,
        ]);

        // Save featured image
        $folderPath = 'uploads/blogs';
        $img = Image::make($request->file('featured-image'));
        $ext = explode('/', $img->mime(), 2);
        $fileName = 'BlOG_'. $slug. '.png';

        $path = $request->file('featured-image')->storeAs(
            $folderPath, $fileName, 'public_uploads'
        );

        $newBlog->img_path = $folderPath. '/'. $fileName;
        $newBlog->save();

        $optional_path = "";
        $ct=1;
        if($detailImages != null){
            for($i=0;$i<sizeof($detailImages);$i++){
                $img = Image::make($detailImages[$i]);
                $ext = explode('/', $img->mime(), 2);
                $fileName = 'BlOG_DETAIL_'.$ct.'_'. $slug. '.png';

                $path = $detailImages[$i]->storeAs(
                    $folderPath, $fileName, 'public_uploads'
                );

                $optional_path .= $folderPath. '/'. $fileName.";";
                $newBlog->optional_path = $optional_path;
                $newBlog->save();
                $ct++;
            }
        }

        //update sitemap for SEO
//        Utilities::CreateSitemap();
        Session::flash('message', 'Berhasil buat Artikel baru!');

        return redirect()->route('admin.blog.show', ['id' => $newBlog->id]);
    }

    public function edit($id){
        $categories = BlogCategory::where('status_id', 1)->get();
        $blog = Blog::find($id);
        if(empty($blog)){
            return redirect()->back();
        }
        $detailImage = [];
        if(!empty($blog->optional_path)){
            $filenameArrs = explode(";", $blog->optional_path);
            foreach ($filenameArrs as $filenameArr){
                if(!empty($filenameArr)){
                    array_push($detailImage, $filenameArr);
                }
            }
        }

        $data = [
            'blog'  => $blog,
            'categories'  => $categories,
            'detailImage'  => $detailImage
        ];
        return view('admin.blog.edit')->with($data);
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title'              => 'required|regex:/^[a-zA-Z]/u|max:100',
//            'content'            => 'required',
            'category'            => 'required',
            'subtitle'            => 'required|regex:/^[a-zA-Z]/u',
//            'm_keyword'            => 'required',
//            'm_description'            => 'required',
            'start_date'            => 'required',
        ],[
            'title.required'        => 'Judul artikel wajib diisi!',
//            'content.required'      => 'Konten artikel wajib diisii!',
            'category.required'      => 'Kategori artikel wajib diisii!',
            'subtitle.required'      => 'Deskripsi Singkat artikel wajib diisii!',
//            'm_keyword.required'      => 'Meta Keyword wajib diisii!',
//            'm_description.required'      => 'Meta Description Singkat artikel wajib diisii!',
            'start_date.required'      => 'Tanggal Publish artikel wajib diisii!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if($request->input('category') == -1){
            return redirect()->back()->withErrors('Kategori artikel wajib diisii!', 'default')->withInput($request->all());
        }
        if($request->input('status_id') == -1){
            return redirect()->back()->withErrors('Status artikel wajib diisii!', 'default')->withInput($request->all());
        }
        $detailImages = $request->file('detail_image');

        // Checking title exist
        $title = Utilities::removeSpecialCharactes($request->input('title'));
        $titleLower = strtolower($title);
        $existBlog = Blog::whereRaw("LOWER(title) = '". $titleLower ."'")
            ->where('id', '!=', $id)
            ->first();

        //dd($existBlog);

        if(!empty($existBlog)){
            return redirect()->back()->withErrors('Judul Artikel sudah ada!', 'default')->withInput($request->all());
        }

        $dateTimeNow = Carbon::now('Asia/Jakarta');

        $user = Auth::guard('admin')->user();
        //dd($user);

        $blog = Blog::find($id);
        if(empty($blog)){
            return redirect()->back();
        }
        $startDateRequest = $request->input('start_date');
        $startDate = Carbon::parse($startDateRequest)->format('Y-m-d 00:00:00');
//        dd($startDate);

        $slug = Str::slug(strtolower($title));
        $blog->title = $title;
        $blog->slug = $slug;
        $blog->blog_category_id = $request->input('category');
        $blog->subtitle = Utilities::removeSpecialCharactes($request->input('subtitle'));
        $blog->description_1 = $request->input('content');
        $blog->meta_keyword = $request->input('m_keyword');
        $blog->meta_description = $request->input('m_description');
        $blog->description_1 = $request->input('content')?? null;
        $blog->status_id = $request->input('status_id');
        $blog->published_at = $startDate;
        $blog->updated_at = $dateTimeNow->toDateTimeString();


        if($request->file('featured-image') != null){
            // Delete old featured image
            if (!empty($blog->img_path)){
                $deletedPath = public_path($blog->img_path);
                if(file_exists($deletedPath)) unlink($deletedPath);
            }

            // Save featured image
            $folderPath = 'uploads/blogs';
            $img = Image::make($request->file('featured-image'));
            $ext = explode('/', $img->mime(), 2);
//            $fileName = 'FEATURED_'. $id. '_'. $dateTimeNow->format('Ymdhms'). '.'. $ext[1];
            $fileName = 'BlOG_'. $slug. '.png';

            $path = $request->file('featured-image')->storeAs(
                $folderPath, $fileName, 'public_uploads'
            );

            $blog->img_path = $folderPath. '/'. $fileName;
        }
        $optional_path = "";
        $ct=1;
        if($detailImages != null){
            $filenameArrs = explode(";", $blog->optional_path);
            foreach ($filenameArrs as $filenameArr){
                if(!empty($filenameArr)){
                    // Delete old image
                    $deletedPath = public_path($filenameArr);
                    if(file_exists($deletedPath)) unlink($deletedPath);
                }
            }
            for($i=0;$i<sizeof($detailImages);$i++){

                $img = Image::make($detailImages[$i]);
                $ext = explode('/', $img->mime(), 2);
                $fileName = 'BlOG_DETAIL_'.$ct.'_'. $slug. '.png';

                $folderPath = 'uploads/blogs';
                $path = $detailImages[$i]->storeAs(
                    $folderPath, $fileName, 'public_uploads'
                );

                $optional_path .= $folderPath. '/'. $fileName.";";
                $blog->optional_path = $optional_path;
                $ct++;
            }
        }

        $blog->save();

        //update sitemap for SEO
        Session::flash('message', 'Berhasil ubah Artikel!');

        return redirect()->route('admin.blog.show', ['id' => $id]);
    }

    public function destroy(Request $request){
//        dd($request);
        $blogId = $request->input('id');
        $blog = Blog::find($blogId);
        if(empty($blog)){
            return redirect()->back();
        }

        if(!empty($blog->img_path)){
            $deletedPath = public_path($blog->img_path);
            if(file_exists($deletedPath)) unlink($deletedPath);
        }

        $blog->status_id = 2;
        $blog->save();
//        $blog->delete();

        //update sitemap for SEO
//        Utilities::CreateSitemap();
        Session::flash('message', 'Berhasil Hapus Artikel!');
        return redirect()->route('admin.blog.index');
    }

    public function unpublishBlog($id){
        $blog = Blog::find($id);
        if(empty($blog)){
            return redirect()->back();
        }

        $blog->status_id = 9;
        $blog->save();

        //update sitemap for SEO
//        Utilities::CreateSitemap();
        Session::flash('message', 'Berhasil Tutup Artikel!');
        return redirect()->back();
    }

    public function publishBlog($id){
        $blog = Blog::find($id);
        if(empty($blog)){
            return redirect()->back();
        }

        $blog->status_id = 10;
        $blog->save();

        //update sitemap for SEO
//        Utilities::CreateSitemap();
        Session::flash('message', 'Berhasil Buka Artikel!');
        return redirect()->back();
    }
}
