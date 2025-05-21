<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
   
    //The attributes that are mass assignable via create() or update()
    protected $fillable =[
        'account_number',
        'holder_name',
        'balance',
        'account_type',
    ];
}
