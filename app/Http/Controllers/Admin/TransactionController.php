<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Transaction;
use App\Models\TransactionDetail;;
use App\Transformer\TransactionTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.transaction.index');
    }

    public function getIndex(){
        $transactions = Transaction::join('statuses', 'statuses.id', '=', 'transactions.status_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->join('user_units', 'user_units.id', '=', 'transactions.user_unit_id')
//            ->join('payment_types', 'payment_types.id', '=', 'transactions.payment_type_id')
            ->select('transactions.*', 'statuses.description as status_description',
            'users.name as user_name', 'user_units.unit_code as unit_code');

        error_log($transactions->count());

        return DataTables::of($transactions)
            ->setTransformer(new TransactionTransformer)
            ->make(true);
    }

    public function show($id){
        $transaction = Transaction::where('id', $id)->first();
        $transactionDetail = TransactionDetail::where('transaction_id', $id)
            ->get();
        $names = TransactionDetail::join('companies', 'companies.code', '=', 'transaction_details.company_code')
            ->select('transaction_details.*', 'companies.code as company_code')->get();

        $data = [
            'transaction'  => $transaction,
            'transactionDetail'  => $transactionDetail,
            '$names'      =>$names,
        ];

        return view('admin.transaction.show')->with($data);
    }


}
