<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserUnit;
use App\Transformer\UserTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getIndex(Request $request){
        $users = User::join('statuses', 'statuses.id', '=', 'users.status_id')
//                     ->join('user_units', 'user_units.user_id', '=', 'users.id')
            ->select('users.*', 'statuses.description as status_description')
        ->where('users.status_id', 1);

        error_log($users->count());

        return DataTables::of($users)
            ->setTransformer(new UserTransformer)
            ->make(true);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function index(){
        $users = User::where('id', '>', 0)
            ->orderBy('created_at')
            ->get();

        if(empty($companies)){
            return redirect()->back();
        }

        $data = [
            'users'  => $users,
        ];

        return view('admin.user.index')->with($data);
    }*/
    public function index()
    {
        return view('admin.user.index');
    }

//    public function create()
//    {
//        //
//        return view('admin.user.create');
//    }
//
//    public function store(Request $request)
//    {
//        try {
//            $validator = Validator::make($request->all(), [
//                'name'            => 'required',
//                'code'            => 'required',
//                'db_type'            => 'required',
//                'db_connection'            => 'required',
//                'db_port'            => 'required',
//                'db_name'            => 'required',
//                'db_user'            => 'required',
//                'db_pass'            => 'required',
//            ]);
//            if ($validator->fails())
//                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
//            if($request->input('type') == -1)
//                return redirect()->back()->withErrors('Please Select User Type', 'default')->withInput($request->all());
//
//
//            $user = Auth::guard('admin')->user();
//            $dateTimeNow = Carbon::now('Asia/Jakarta');
//            $newCompany = User::create([
//                'code'          => $request->input('code'),
//                'name'          => $request->input('name'),
//                'type'          => $request->input('type'),
//                'address'       => $request->input('address') == null ? '' : $request->input('address'),
//                'db_type'       => $request->input('db_type'),
//                'db_connection' => $request->input('db_connection'),
//                'db_port'       => $request->input('db_port'),
//                'db_name'       => $request->input('db_name'),
//                'db_user'       => $request->input('db_user'),
//                'db_pass'       => $request->input('db_pass'),
//                'status_id'     => 1,
//                'created_at'    => $dateTimeNow->toDateTimeString(),
//                'created_by'    => $user->id,
//            ]);
//
//            if($request->hasFile('company_image')){
//                // Save image
//                $folderPath = 'uploads/User';
//                $img = Image::make($request->file('company_image'));
//                $ext = explode('/', $img->mime(), 2);
//                $fileName = 'COMPANY_'. strtoupper($request->input('code')).'_'.strtoupper($request->input('name')).'.png';
//
//                $img->save(public_path($folderPath. '/'. $fileName), 75);
//
//                $newCompany->img_path = $folderPath. '/'. $fileName;
//                $newCompany->save();
//            }
//
//
//            Session::flash('success', 'Success Creating User!');
//            return redirect()->route('admin.user.index');
//        }
//
//        catch(\Exception $ex){
//            dd($ex);
//            Session::flash('error', 'Error Creating User!');
//            return redirect()->route('admin.user.create');
//        }
//    }

    public function show($id){
        $user = User::where('id', $id)->first();
        $userUnits = UserUnit::where('user_id', $id)->get();
        $data = [
            'user'  => $user,
            'userUnits'  => $userUnits,
        ];

        return view('admin.user.show')->with($data);
    }

    public function edit($id){
        $user = User::where('id', $id)->first();
        $data = [
            'user'  => $user,
        ];

        return view('admin.user.edit')->with($data);
    }

    public function update(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name'            => 'required',
                'phone'            => 'required',
                'email'         => 'required',
                'status_id'   => 'required',
            ]);
            if ($validator->fails())
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            if($request->input('status_id') == -1)
                return redirect()->back()->withErrors('Please Select Status', 'default')->withInput($request->all());


            $user = Auth::guard('admin')->user();
            $dateTimeNow = Carbon::now('Asia/Jakarta');

            $company = User::where('id', $request->input('id'))->first();
            $company->phone = $request->input('phone');
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->status_id = $request->input('status_id');
            $company->updated_at = $dateTimeNow->toDateTimeString();
            $company->updated_by = $user->id;
            $company->save();

            Session::flash('message', 'Success Editing User Information!');

            return redirect()->route('admin.user.index');
        }
        catch(\Exception $ex){
            dd($ex);
            Session::flash('error', 'Error Editing User Information!');
            return redirect()->route('admin.user.index');
        }
    }

    public function destroy(Request $request){
        try{
            $id = $request->input('deleted-id');
            $company = User::find($id);
            if(empty($company)){
                return redirect()->back();
            }

            $company->status_id = 2;
            $company->save();

            Session::flash('message', 'Success Delete User Information!');
            return redirect()->route('admin.user.index');
        }
        catch(\Exception $ex){
            Session::flash('error', 'Error Delete User Information!');
            return redirect()->route('admin.user.index');
        }
    }

}
