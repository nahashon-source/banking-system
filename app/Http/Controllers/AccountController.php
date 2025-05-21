<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //Return all accounts as JSON
    public function index()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }
}
