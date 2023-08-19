<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Accounts;
use App\Models\Activity;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function createAccount(Request $request){
        $data = $request->all();
        if(!empty($data)){
            $account = new Accounts($data);
            if($account->save()){
                return response()->json(["success"=>true,"code"=>200,"message"=>"Account created successfully","data"=>$account]);
            }else{
                return response()->json(["success"=>false,"code"=>400,"message"=>"Account creation failed"]);
            }
        }else{
            return response()->json(["success"=>false,"code"=>400,"message"=>"Account creation failed. Data missing"]);
        }
    }
    public function getAccounts(Request $request){
        $data = $request->all();
        if(!empty($data)){
            $account = Accounts::where('user_id',$data['user_id'])->get();
            if(!empty($account)){
                return response()->json(["success"=>true,"code"=>200,"message"=>"Accounts fetched successfully","data"=>$account]);
            }else{
                return response()->json(["success"=>false,"code"=>400,"message"=>"Accounts not found"]);
            }
        }else{
            return response()->json(["success"=>false,"code"=>400,"message"=>"Accounts not found. Data missing"]);
        }
    }
    public function getAccountActivity(Request $request){
        $data = $request->all();
        if(!empty($data)){
            $account = Accounts::where('user_id',$data['user_id'])->get();
            $activities = Activity::all();
            if(!empty($account)){
                return response()->json(["success"=>true,"code"=>200,"message"=>"Accounts fetched successfully","data"=>$account,"activity"=>$activities]);
            }else{
                return response()->json(["success"=>false,"code"=>400,"message"=>"Accounts not found"]);
            }
        }else{
            return response()->json(["success"=>false,"code"=>400,"message"=>"Accounts not found. Data missing"]);
        }
    }
}
