<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Complaint;
use App\Models\ComplaintDetail;
use App\Models\ComplaintHistory;
use App\Models\ContactUsMessage;
use App\Models\Subscriber;
use App\Transformer\ContactusTransformer;
use App\Transformer\SubscriberTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.contactus.index');
    }

    public function getIndex(){
        $contactUs = ContactUsMessage::where('id', '>', 0)->orderBy('created_at', 'desc')->get();

        return DataTables::of($contactUs)
            ->setTransformer(new ContactusTransformer)
            ->make(true);
    }

    public function show($id){
        $contactUs = ContactUsMessage::where('id', $id)->first();

        $data = [
            'contactUs'  => $contactUs,
        ];

        return view('admin.contactus.show')->with($data);
    }

    public function destroy(Request $request){
//        dd($request);
        try{
            $Id = $request->input('id');
            $data = ContactUsMessage::find($Id);
            if(empty($data)){
                return redirect()->back();
            }
            $data->delete();

            Session::flash('success', 'Berhasil Hapus Data!');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }
    }

    public function indexSubscribe(){
        return view('admin.contactus.index-subscribe');
    }

    public function getIndexSubscribe(){
        $contactUs = Subscriber::where('id', '>', 0)->orderBy('id', 'desc')->get();

        return DataTables::of($contactUs)
            ->setTransformer(new SubscriberTransformer)
            ->make(true);
    }

    public function destroySubscribe(Request $request){
//        dd($request);
        try{
            $Id = $request->input('id');
            $data = Subscriber::find($Id);
            if(empty($data)){
                return redirect()->back();
            }
            $data->delete();

            //update sitemap for SEO
//        Utilities::CreateSitemap();
            Session::flash('success', 'Berhasil Hapus Data!');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID'));
        }
    }
}
