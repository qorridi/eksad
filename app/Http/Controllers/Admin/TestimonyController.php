<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\AdminUser;
use App\Models\Testimonial;
use App\Transformer\AdminUserTransformer;
use App\Transformer\TestimonyTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class TestimonyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getIndex(Request $request){
        $testimonies = Testimonial::where('id', '>', 0)->orderby('id', 'asc')->get();
        return DataTables::of($testimonies)
            ->setTransformer(new TestimonyTransformer)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.testimony.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.testimony.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'            => 'required|regex:/^[a-zA-Z]/u|max:150',
//                'picture'         => 'required',
                'description'     => 'required',
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            //Create Admin
            $testimony = Testimonial::create([
                'name'          => $request->input('name'),
//                'picture'       => $request->input('picture'),
                'company_name'   => $request->input('company_name'),
                'description'   => $request->input('description'),
                'image_path'       => 'testimony_default.png',
                'image_path_2'       => 'testimony_logo.png',
                'status_id'     => 1,
            ]);

            $dateTimeNow = Carbon::now('Asia/Jakarta');

            if($request->hasFile('featured-image')){
                //Upload Image
                //Creating Path Everyday
                $today = Carbon::now('Asia/Jakarta');
                $publicPath = 'uploads/testimony';
                if(!File::isDirectory($publicPath)){
                    File::makeDirectory(public_path($publicPath), 0777, true, true);
                }

                $image = $request->file('featured-image');
                $avatar = Image::make($image);
                $extension = $image->extension();
                $extension = "png";
                $filename = $testimony->name . '_testimony_'. $testimony->id . '_' .
                    Carbon::now('Asia/Jakarta')->format('Ymdhms') . '.' . $extension;
                $filename = str_replace('*', '_', $filename);
                // resize the image to a height of 200 and constrain aspect ratio (auto width)
                $avatar->resize(null, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                // resize the image to a height of 200 and constrain aspect ratio (auto width)
                $avatar->resize(null, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $avatar->save(public_path($publicPath ."/". $filename));

                $testimony->image_path = $publicPath."/". $filename;
                $testimony->save();
            }

//            if($request->hasFile('picture_after')){
//                //Upload Image
//                //Creating Path Everyday
//                $today = Carbon::now('Asia/Jakarta');
//                $publicPath = 'storage/testimony';
//                if(!File::isDirectory($publicPath)){
//                    File::makeDirectory(public_path($publicPath), 0777, true, true);
//                }
//
//                $image2 = $request->file('picture_after');
//                $avatar2 = Image::make($image2);
//                $extension = $image2->extension();
//                $extension = "webp";
//                $filename2 = $testimony->name . '_testimony-after_'. $testimony->id . '_' .
//                    Carbon::now('Asia/Jakarta')->format('Ymdhms') . '.' . $extension;
//                $filename2 = str_replace('*', '_', $filename2);
//                // resize the image to a height of 200 and constrain aspect ratio (auto width)
//                $avatar2->resize(null, 200, function ($constraint) {
//                    $constraint->aspectRatio();
//                });
//                // resize the image to a height of 200 and constrain aspect ratio (auto width)
//                $avatar2->resize(null, 200, function ($constraint) {
//                    $constraint->aspectRatio();
//                });
//                $avatar2->save(public_path($publicPath ."/". $filename2));
//
//                $testimony->picture_after = $filename2;
//                $testimony->save();
//            }

            Session::flash('success', 'Success Creating new Testimony!');
            return redirect()->route('admin.testimony.index');
        }

        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error Creating new Testimony!');
            return redirect()->route('admin.testimony.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $testimony = Testimonial::find($id);
//        dd($testimony);
        return view('admin.testimony.show', compact('testimony'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $testimony = Testimonial::find($id);
//        dd($testimony);
        return view('admin.testimony.edit', compact('testimony'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'name'            => 'required|regex:/^[a-zA-Z]/u|max:150',
//                'picture'         => 'required',
                'description'     => 'required',
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            //Update Testimony
            $testimony = Testimonial::find($request->input('id'));
            $testimony->name = Utilities::removeSpecialCharactes($request->input('name'));
            $testimony->description = Utilities::removeSpecialCharactes($request->input('description'));
            $testimony->company_name = Utilities::removeSpecialCharactes($request->input('company_name'));
            $testimony->status_id = $request->input('status');

            if($request->file('featured-image') != null){
                // Delete old featured image
                $publicPath = 'uploads/testimony';
                $deletedPath = public_path($publicPath ."/". $testimony->image_path);
                if(file_exists($deletedPath)) unlink($deletedPath);

                if(!File::isDirectory($publicPath)){
                    File::makeDirectory(public_path($publicPath), 0777, true, true);
                }
                $image = $request->file('featured-image');
                $avatar = Image::make($image);
                $extension = $image->extension();
                $extension = "png";
                $filename = $testimony->name . '_testimony_'. $testimony->id . '_' .
                    Carbon::now('Asia/Jakarta')->format('Ymdhms') . '.' . $extension;
                // resize the image to a height of 200 and constrain aspect ratio (auto width)
                $avatar->resize(null, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $avatar->save(public_path($publicPath ."/". $filename));

                $testimony->image_path = $publicPath."/". $filename;
            }

//            if($request->hasFile('picture_after')){
//                // Delete old featured image
//                $publicPath = 'storage/testimony';
//                if(!empty($testimony->picture_after)){
//                    $deletedPath2 = public_path($publicPath ."/". $testimony->picture_after);
//                    if(file_exists($deletedPath2)) unlink($deletedPath2);
//                }
//                //Upload Image
//                //Creating Path Everyday
//                $today = Carbon::now('Asia/Jakarta');
//                if(!File::isDirectory($publicPath)){
//                    File::makeDirectory(public_path($publicPath), 0777, true, true);
//                }
//
//                $image2 = $request->file('picture_after');
//                $avatar2 = Image::make($image2);
//                $extension = $image2->extension();
//                $extension = "webp";
//                $filename2 = $testimony->name . '_testimony-after_'. $testimony->id . '_' .
//                    Carbon::now('Asia/Jakarta')->format('Ymdhms') . '.' . $extension;
//                $filename2 = str_replace('*', '_', $filename2);
//                // resize the image to a height of 200 and constrain aspect ratio (auto width)
//                $avatar2->resize(null, 200, function ($constraint) {
//                    $constraint->aspectRatio();
//                });
//                $avatar2->save(public_path($publicPath ."/". $filename2));
//
//                $testimony->picture_after = $filename2;
//            }


            $testimony->save();

            Session::flash('success', 'Success Updating Testimony!');
            return redirect()->route('admin.testimony.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error Updating Testimony!');
            return redirect()->route('admin.testimony.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        //
        try {
            //Belum melakukan pengecekan hubungan antar Table
            $testimonyId = $request->input('id');
            $testimony = Testimonial::find($testimonyId);
            $testimony->delete();

            Session::flash('success', 'Success Deleting Testimony');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }
    }
}
