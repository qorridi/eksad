<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\libs\Utilities;
use App\Models\MainImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class MainImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $mainimages = MainImage::where('id', '>', 0)
            ->get();
        if(empty($mainimages)){
            return redirect()->back();
        }

        $data = [
            'mainimages'  => $mainimages,
        ];

        return view('admin.mainimage.index')->with($data);
    }

    public function update(Request $request){

        try{
            $bannerImages = $request->file('banner-image');
            $titles = $request->input('name');
            $descriptions = $request->input('description');


            $ct = 0;
//            $bannerDbs = Banner::where();
//            foreach ($bannerDbs as $bannerDb){
//                // Delete old featured image
//                if(!empty($bannerDb->image_path)){
//                    $deletedPath = public_path($bannerDb->image_path);
//                    if(file_exists($deletedPath)) unlink($deletedPath);
//                }
//
//                $bannerDb->delete();
//            }
            foreach ($bannerImages as $bannerImage){
                if($bannerImage != null){
                    $banner = MainImage::create([
                        'name'          => $titles[$ct] ?? "",
                        'description'   => $descriptions[$ct] ?? "",
                        'status'        => 1,
                    ]);

                    // Save featured image
                    $folderPath = 'uploads/main_image';
                    $img = Image::make($bannerImage);
                    $ext = explode('/', $img->mime(), 2);
                    $fileName = 'MAINIMAGE'.$banner->id."_". Carbon::now('Asia/Jakarta')->format('hms'). '.webp';

                    $path = $bannerImage->storeAs(
                        $folderPath, $fileName, 'public_uploads'
                    );

                    $banner->image_path = $folderPath. '/'. $fileName;
                    $banner->save();
                }

                $ct++;
            }

            Session::flash('message', 'Berhasil ubah Main Image!');

            return redirect()->route('admin.mainimage.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error ubah Main Image!');
            return redirect()->route('admin.mainimage.index');
        }
    }

    public function edit($id){
        $mainimage = MainImage::where('id', $id)->first();
        $data = [
            'mainimage'  => $mainimage,
        ];

        return view('admin.mainimage.edit')->with($data);
    }

    public function updateSingle(Request $request){
        try{
            $ct = 0;
            $bannerDb = MainImage::where('id', $request->input('id'))->first();
            $bannerDb->name = $request->input('name') ?? "";
            $bannerDb->description = $request->input('description') ?? "";
            $bannerDb->save();

            if($request->hasFile('banner-image')){
                $bannerImage = $request->file('banner-image');
                $fileName = $bannerDb->image_path;

                // Delete old featured image
                if(!empty($bannerDb->image_path)){
                    $deletedPath = public_path($bannerDb->image_path);
                    if(file_exists($deletedPath)) unlink($deletedPath);
                }
                // Save featured image
                $img = Image::make($bannerImage);
                $img->save(public_path($fileName), 75);

                $bannerDb->image_path = $fileName;
                $bannerDb->save();
            }

            Session::flash('message', 'Berhasil ubah Main Image!');

            return redirect()->route('admin.mainimage.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error Editing Main Image!');
            return redirect()->route('admin.mainimage.index');
        }
    }

    public function destroy(Request $request){
        try{
            $videoId = $request->input('deleted-id');
            $video = MainImage::find($videoId);
            if(empty($video)){
                return redirect()->back();
            }

            $video->delete();

            Session::flash('message', 'Berhasil Hapus Main Image!');
            return redirect()->route('admin.mainimage.index');
        }
        catch(\Exception $ex){
            Session::flash('error', 'Error Hapus Main Image!');
            return redirect()->route('admin.mainimage.index');
        }
    }


}
