<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'activity_id','account_number','remarks','created_at','updated_at'];
    public $table = 'account_transaction';
}
