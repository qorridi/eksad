<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Utilities;
use App\Models\AboutTeam;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use App\Transformer\BlogTransformer;
use App\Transformer\TeamTransformer;
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

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.team.index');
    }

    public function getIndex(Request $request){

        $datas = AboutTeam::with('status')
            ->where('id', '>', 0)
            ->where('status_id', 1)
            ->orderby('created_at', 'asc')->get();;

        return DataTables::of($datas)
            ->setTransformer(new TeamTransformer)
            ->make(true);
    }

    public function show($id){
        $aboutTeam = AboutTeam::where('id', $id)->first();
        if(empty($aboutTeam)){
            return redirect()->back();
        }

        $data = [
            'team'  => $aboutTeam,
        ];
        return view('admin.team.show')->with($data);
    }

    public function create(){
        return view('admin.team.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name'              => 'required|regex:/^[a-zA-Z]/u|max:100',
            'position'            => 'required|regex:/^[a-zA-Z]/u',
            'description'            => 'required|regex:/^[a-zA-Z]/u',
        ],[
            'name.required'        => 'Judul artikel wajib diisi!',
            'position.required'      => 'Kategori artikel wajib diisii!',
            'description.required'      => 'Deskripsi Singkat artikel wajib diisii!',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }

        if($request->file('featured-image') == null){
            return redirect()->back()->withErrors('Gambar utama wajib upload!', 'default')->withInput($request->all());
        }

        // Checking title exist
        $dateTimeNow = Carbon::now('Asia/Jakarta');
        $user = Auth::guard('admin')->user();

        $newTeam = AboutTeam::create([
            'name'          => Utilities::removeSpecialCharactes($request->input('name')),
            'position'      => Utilities::removeSpecialCharactes($request->input('position')),
            'description'   => Utilities::removeSpecialCharactes($request->input('description')),
            'img_path'      => '',
            'sosmed_1'      => $request->input('sosmed_1'),
            'sosmed_2'      => $request->input('sosmed_2'),
            'sosmed_3'      => $request->input('sosmed_3'),
            'sosmed_4'      => '',
            'sosmed_5'      => '',
            'status_id'     => 1,
            'created_at'    => $dateTimeNow->toDateTimeString(),
        ]);

        // Save featured image
        $folderPath = 'uploads/teams';
        $img = Image::make($request->file('featured-image'));
        $fileName = 'TEAM_'. $newTeam->id. '.webp';

        $path = $request->file('featured-image')->storeAs(
            $folderPath, $fileName, 'public_uploads'
        );

        $newTeam->img_path = $folderPath. '/'. $fileName;
        $newTeam->save();

        Session::flash('message', 'Berhasil buat Data baru!');

        return redirect()->route('admin.team.show', ['id' => $newTeam->id]);
    }

    public function edit($id){
        $aboutTeam = AboutTeam::find($id);
        if(empty($aboutTeam)){
            return redirect()->back();
        }

        $data = [
            'team'  => $aboutTeam,
        ];
        return view('admin.team.edit')->with($data);
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'name'              => 'required|regex:/^[a-zA-Z]/u|max:100',
            'position'            => 'required|regex:/^[a-zA-Z]/u',
            'description'            => 'required|regex:/^[a-zA-Z]/u',
        ],[
            'name.required'        => 'Judul artikel wajib diisi!',
            'position.required'      => 'Kategori artikel wajib diisii!',
            'description.required'      => 'Deskripsi Singkat artikel wajib diisii!',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $user = Auth::guard('admin')->user();

        $aboutTeam = AboutTeam::find($id);
        if(empty($aboutTeam)){
            return redirect()->back();
        }
        $dateTimeNow = Carbon::now('Asia/Jakarta');

        $aboutTeam->name = Utilities::removeSpecialCharactes($request->input('name'));
        $aboutTeam->position = Utilities::removeSpecialCharactes($request->input('position'));
        $aboutTeam->description = Utilities::removeSpecialCharactes($request->input('description'));
        $aboutTeam->sosmed_1 = $request->input('sosmed_1');
        $aboutTeam->sosmed_2 = $request->input('sosmed_2');
        $aboutTeam->sosmed_3 = $request->input('sosmed_3');
        $aboutTeam->updated_at = $dateTimeNow->toDateTimeString();
        $aboutTeam->save();

        if($request->file('featured-image') != null){
            // Delete old featured image
            if (!empty($aboutTeam->img_path)){
                $deletedPath = public_path($aboutTeam->img_path);
                if(file_exists($deletedPath)) unlink($deletedPath);
            }

            // Save featured image
            $folderPath = 'uploads/teams';
            $img = Image::make($request->file('featured-image'));
            $fileName = 'TEAM_'. $aboutTeam->id. '.webp';

            $path = $request->file('featured-image')->storeAs(
                $folderPath, $fileName, 'public_uploads'
            );

            $aboutTeam->img_path = $folderPath. '/'. $fileName;
            $aboutTeam->save();
        }

        //update sitemap for SEO
        Session::flash('message', 'Berhasil ubah Data!');

        return redirect()->route('admin.team.show', ['id' => $id]);
    }

    public function destroy(Request $request){
        $aboutTeamId = $request->input('id');
        $aboutTeam = AboutTeam::find($aboutTeamId);
        if(empty($aboutTeam)){
            return redirect()->back();
        }

        $aboutTeam->status_id = 2;
        $aboutTeam->save();

        Session::flash('message', 'Berhasil Hapus!');
        return redirect()->route('admin.team.index');
    }
}
