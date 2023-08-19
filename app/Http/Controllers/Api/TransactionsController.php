<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function getTransactions(Request $request)
    {
        $data = $request->all();
        if (!empty($data)) {
            $transactions = Transactions::where('user_id', $data['user_id'])
                ->join("activity", "activity.id", "=", "account_transaction.activity_id")
                ->where('account_number', $data['account_number'])->get();
            if (!empty($transactions[0])) {
                return response()->json(['success' => true, "code" => 200, 'message' => "Transactions found successfully", 'data' => $transactions]);
            } else {
                return response()->json(['success' => true, "code" => 200, 'message' => 'No transactions found', "data" => []]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid request']);
        }
    }

    public function addTransaction(Request $request)
    {
        $data = $request->all();
        if (!empty($data)) {
            $transactions = new Transactions(
                [
                    'user_id' => $data['user_id'],
                    'amount' => $data['amount'],
                    'activity_id' => $data['activity_id'],
                    'account_number' => $data['account_number'],
                    'remarks' => $data['remarks']
                ]
            );
            if ($transactions->save()) {
                return response()->json(['success' => true, "code" => 200, 'message' => "Transactions saved successfully"]);
            } else {
                return response()->json(['error' => true, "code" => 200, 'message' => "Transactions failed"]);
            }
        } else {
            return response()->json(['error' => true, "code" => 200, 'message' => "Empty request"]);
        }
    }
}
