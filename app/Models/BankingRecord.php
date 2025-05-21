<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankingRecord extends Model
{
    //Define the relationship: each banking record belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
