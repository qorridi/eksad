<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\Client;
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

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $clients = Client::where('id', '>', 0)
//            ->where('banner_type', 0)
            ->orderBy('sort_order')
            ->get();
        if(empty($clients)){
            return redirect()->back();
        }

        $data = [
            'clients'  => $clients,
        ];

        return view('admin.client.index')->with($data);
    }

    public function update(Request $request){

        try{
            $bannerImages = $request->file('banner-image');
            $bannerImageMobiles = $request->file('banner-image-mobile');
            $titles = $request->input('title');
            $descriptions = $request->input('description');
            $orders = $request->input('order');

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
                    $banner = Client::create([
                        'name'          => $titles[$ct] ?? "",
                        'alt_text'      => $titles[$ct] ?? "" ,
                        'description'   => $descriptions[$ct] ?? "",
                        'status'        => 1,
                        'sort_order'    => $orders[$ct] ?? 999,
                        'banner_type'   => 0
                    ]);

                    // Save featured image
                    $folderPath = 'uploads/clients';
                    $img = Image::make($bannerImage);
                    $ext = explode('/', $img->mime(), 2);
                    $fileName = 'CLIENT_'.$banner->id. Carbon::now('Asia/Jakarta')->format('hms'). '.webp';

                    $path = $bannerImage->storeAs(
                        $folderPath, $fileName, 'public_uploads'
                    );

                    $banner->image_path = $folderPath. '/'. $fileName;
                    $banner->save();

//                    if($bannerImageMobiles[$ct] != null){
//                        // Save brand image
//                        $folderPath = 'uploads/clients';
//                        $img = Image::make($bannerImageMobiles[$ct]);
//                        $ext = explode('/', $img->mime(), 2);
//                        $fileName = 'CLIENT_MOBILE_'.$banner->id."_". Carbon::now('Asia/Jakarta')->format('hms'). '.png';
//
//                        $path = $bannerImageMobiles[$ct]->storeAs(
//                            $folderPath, $fileName, 'public_uploads'
//                        );
//
//                        $banner->image_path_mobile = $folderPath. '/'. $fileName;
//                        $banner->save();
//                    }
                }

                $ct++;
            }

            Session::flash('message', 'Berhasil ubah Slide!');

            return redirect()->route('admin.client.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error ubah Banner!');
            return redirect()->route('admin.client.index');
        }
    }

    public function edit($id){
        $banner = Client::where('id', $id)->first();
        $data = [
            'banner'  => $banner,
        ];

        return view('admin.client.edit')->with($data);
    }

    public function updateSingle(Request $request){
        try{
            $ct = 0;
            $bannerDb = Client::where('id', $request->input('id'))->first();
            $bannerDb->name = $request->input('title') ?? "";
            $bannerDb->alt_text = $request->input('title') ?? "";
            $bannerDb->description = $request->input('description') ?? "";
            $bannerDb->sort_order = $request->input('order') ?? 999;
            $bannerDb->banner_type = 0;
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

//            if($request->hasFile('banner-image-mobile')){
//                $bannerImage = $request->file('banner-image-mobile');
//                $fileName = $bannerDb->image_path_mobile;
//
//                // Delete old featured image
//                if(!empty($bannerDb->image_path_mobile)){
//                    $deletedPath = public_path($bannerDb->image_path_mobile);
//                    if(file_exists($deletedPath)) unlink($deletedPath);
//                }
//                // Save featured image
//                $img = Image::make($bannerImage);
//                $img->save(public_path($fileName), 75);
//
//                $bannerDb->image_path_mobile = $fileName;
//                $bannerDb->save();
//            }

            Session::flash('message', 'Berhasil ubah Slide!');

            return redirect()->route('admin.client.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error Editing Slide!');
            return redirect()->route('admin.client.index');
        }
    }

    public function destroy(Request $request){
        try{
            $videoId = $request->input('deleted-id');
            $video = Client::find($videoId);
            if(empty($video)){
                return redirect()->back();
            }

            $video->delete();

            Session::flash('message', 'Berhasil Hapus Slide!');
            return redirect()->route('admin.client.index');
        }
        catch(\Exception $ex){
            Session::flash('error', 'Error Hapus Slide!');
            return redirect()->route('admin.client.index');
        }
    }

}
