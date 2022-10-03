<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\libs\Utilities;
use App\Models\AdminUser;
use App\Transformer\AdminUserTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminUserController extends Controller
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
        $users = AdminUser::where('status_id', 1)->orderby('created_at', 'asc')->get();
        return DataTables::of($users)
            ->setTransformer(new AdminUserTransformer)
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
        return view('admin.adminuser.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.adminuser.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|regex:/^[a-zA-Z]/u|max:50',
            'email'             => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:admin_users|max:50',
//            'phone'              => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,15|starts_with:+628,08,02',
            'phone'              => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|starts_with:+628,08,02',
            'password'          => 'required',
//            'confirm_password'  => 'required | same:password',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        $number = $request->input('phone');
        $length = strlen((string) $number);
        if($length < 10 || $length > 15){
            return redirect()->back()->withErrors('The phone must be between 10 and 15 digits!', 'default')->withInput($request->all());
        }

        //Create Admin
        $user = Auth::guard('admin')->user();

        AdminUser::create([
            'name'           => strip_tags($request->input('name')),
            'email'         => strip_tags($request->input('email')),
            'phone'         => strip_tags($request->input('phone')),
            'password'      => Hash::make(strip_tags($request->input('password'))),
            'status_id'     => 1,
//            'is_super_admin'=> $superAdmin,
            'created_by'    => $user->id,
            'created_at'    => Carbon::now('Asia/Jakarta')
        ]);

        Session::flash('success', 'Sukses membuat Admin User baru');
        return redirect()->route('admin.adminuser.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminUser = AdminUser::find($id);
//        $roles = AdminUserRole::orderBy('name')->get();
        $admin = Auth::guard('admin')->user();
//        $isSuperAdmin = $admin->is_super_admin === 1;

        $data = [
//            'isSuperAdmin'  => $isSuperAdmin,
            'adminUser'     => $adminUser,
//            'roles'         => $roles
        ];

        return view('admin.adminuser.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|regex:/^[a-zA-Z]/u|max:50',
            'email'             => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|max:50',
//            'phone'              => 'required|numeric|regex:/^[0-9]+$/|digits_between:10,14',
            'phone'              => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|starts_with:+628,08,02',
        ],[
//            'email.unique'      => 'ID Login Akses telah terdaftar!',
//            'email.regex'       => 'ID Login Akses harus tanpa spasi!'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        //validate email
        if(AdminUser::where('email', $request->input('email'))->where('id', '!=', $id)->exists()){
            return redirect()->back()->withErrors('ID Login Akses telah terdaftar!', 'default')->withInput($request->all());
        }

        $number = $request->input('phone');
        $length = strlen((string) $number);
        if($length < 10 || $length > 15){
            return redirect()->back()->withErrors('The phone must be between 10 and 15 digits!', 'default')->withInput($request->all());
        }

        //Create Admin
        $user = Auth::guard('admin')->user();

        $adminUser = AdminUser::find($id);
        $adminUser->email = strip_tags($request->input('email'));
        $adminUser->name = strip_tags($request->input('name'));
        $adminUser->phone = strip_tags($request->input('phone'));
//        $adminUser->last_name = $request->input('last_name');
//        $adminUser->is_super_admin = $superAdmin;
        $adminUser->updated_at = Carbon::now('Asia/Jakarta');
//        $adminUser->status_id = $request->input('status');
        $adminUser->save();

        Session::flash('success', 'Success Updating Admin User!');
        return redirect()->route('admin.adminuser.index');
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
            $adminUserId = $request->input('id');
            $adminUser = AdminUser::find($adminUserId);

            if(empty($adminUser)){
                return Response::json(array('errors' => 'INVALID'));
            }

            $adminUser->status_id = 2;
            $adminUser->save();

            Session::flash('success', 'Sukses menghapus user Admin ' . $adminUser->email . ' - ' . $adminUser->name);
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            Log::error('Admin/AdminUserController - destroy - error EX: '. $ex);
            return Response::json(array('errors' => 'INVALID'));
        }
    }
}
