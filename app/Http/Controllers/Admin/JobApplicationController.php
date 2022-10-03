<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\Solution;
use App\Transformer\JobApplicationTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.job_application.index');
    }

    public function getIndex(Request $request){


        $datas = JobApplication::where('status_id', 1)->orderBy('created_at', 'desc')->get();

        return DataTables::of($datas)
            ->setTransformer(new JobApplicationTransformer)
            ->make(true);
    }

    public function show($id){
        $data = JobApplication::where('id', $id)->first();

        //dd($data);
        return view('admin.job_application.show', compact('data'));
    }

    public function download($filename){
        $file_path = public_path('storage/job_applications/'.$filename);
//        dd($file_path);
        return response()->download($file_path);
    }

    public function destroy(Request $request){
//        dd($request);
        try{
            $Id = $request->input('id');
            $data = JobApplication::find($Id);
            if(empty($data)){
                return redirect()->back();
            }
            $data->status_id = 2;
            $data->save();

            //update sitemap for SEO
//        Utilities::CreateSitemap();
            Session::flash('message', 'Berhasil Hapus Job Application!');
            return redirect()->route('admin.job_application.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Gagal Hapus Job Application!');
            return redirect()->route('admin.job_application.index');
        }
    }
}
