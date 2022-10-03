<?php


namespace App\Transformer;


use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    public function transform(Transaction $transaction){
        try {
            $date = Carbon::parse($transaction->created_at)->toIso8601String();
            $updateDate = Carbon::parse($transaction->updated_at)->toIso8601String();

            $urlShowTransaction = route('admin.transaction.show', ['id' => $transaction->id]);
            $transaction_no = "<a name='". $transaction->transaction_no. "' href='".$urlShowTransaction."' data-toggle='tooltip' data-placement='top'>". $transaction->transaction_no. "</a>";
            $action = "<a class='btn btn-xs btn-info' href='". $urlShowTransaction."' data-toggle='tooltip' data-placement='top'><i class='fas fa-xs fa-info'></i></a>";

            return[
                'created_at'        => $date,
                'updated_at'        => $updateDate,

                'transaction_no'    => $transaction_no,
                'amount'           => $transaction->amount,

                'user_name'         => $transaction->user->name,
                'unit_code'         => $transaction->user_unit->unit_code,
                'status'            => $transaction->status->description,
                'action'            => $action
            ];
        }
        catch(\Exception $ex){
            Log::error('Admin/Complaint - transform error EX: '. $ex);
            return null;
        }
    }
}
