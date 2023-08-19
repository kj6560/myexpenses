<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function getTransactions(Request $request){
        $data = $request->all();
        if(!empty($data)){
            $transactions = Transactions::where('user_id', $data['user_id'])
            ->join("activity","activity.id","=","account_transaction.activity_id")
            ->where('account_number', $data['account_number'])->get();
            if(!empty($transactions[0])){
                return response()->json(['success'=>true,"code"=>200,'message'=>"Transactions found successfully", 'data'=>$transactions]);
            }else{
                return response()->json(['success'=>true, "code"=>200,'message'=>'No transactions found',"data"=>[]]);
            }
        }else{
            return response()->json(['success'=>false, 'message'=>'Invalid request']);
        }
    }
}
