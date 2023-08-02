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
            $transactions = Transactions::where('user_id', $data['user_id'])->where('account_number', $data['account_number'])->get();
            if(!empty($transactions[0])){
                return response()->json(['success'=>true,'message'=>"Transactions found successfully", 'transactions'=>$transactions]);
            }else{
                return response()->json(['success'=>true, 'message'=>'No transactions found']);
            }
        }else{
            return response()->json(['success'=>false, 'message'=>'Invalid request']);
        }
    }
}
