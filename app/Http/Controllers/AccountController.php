<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        //return a Blade view instead of json
        return view('accounts.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'account_number' => 'required|unique:accounts,account_number|max:20',
            'holder_name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
            'account_type' => 'required|string|in:saving,current',
        ]);

        // Create new account using validated data
        $account = Account::create($validated);

        // Return JSON response with 201 created status code
        return redirect()->route('accounts.index')->with('success', 'Account created successfully!');
    }

    public function update(Request $request, $id)
    {

        //Find the account or fail with 404 error
        $account = Account::findorFail($id);

        // Validate incoming request data
        $validated = $request->validate([
            'account_number' => 'required|unique:accounts,account_number,' . $id . '|max:20',
            'holder_name' => 'required|string|max:255',
            'balance' => 'required|numeric|min:0',
            'account_type' => 'required|string|in:saving,current',
        ]);

        //update the account with validated data
        $account->update($validated);

        //Return the updated account JSON
        return response()->json($account);
    }


    public function destroy($id)
    {
        //Find the account or fail with 404 error
        $account = Account::findorFail($id);

        //Delete the account
        $account->delete();

        //Return the deleted account JSON
        return response()->json(['message' => 'Account deleted successfully']);
    }


    //show the account creation form
    public function create()
    {
        return view('accounts.create');
    }
}
