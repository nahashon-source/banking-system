<?php

namespace App\Http\Controllers;

use App\Models\BankingRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BankingRecordController extends Controller
{
    /**
     * Ensure all routes require authenticated users.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's banking records.
     */
    public function index()
    {
        // Get the authenticated user's banking records, newest first
        $records = Auth::user()->bankingRecords()->latest()->get();

        return view('banking_records.index', compact('records'));
    }

    /**
     * Show the form for creating a new banking record.
     */
    public function create()
    {
        return view('banking_records.create');
    }

    /**
     * Store a newly created banking record in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'transaction_type' => 'required|in:Deposit,Withdrawal',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:500',
        ]);

        // Create banking record linked to authenticated user
        Auth::user()->bankingRecords()->create($validated);

        return redirect()->route('banking-records.index')
            ->with('success', 'Transaction recorded successfully!');
    }

    /**
     * Display the specified banking record.
     */
    public function show(BankingRecord $bankingRecord)
    {
        $this->authorizeAccess($bankingRecord);

        return view('banking_records.show', compact('bankingRecord'));
    }

    /**
     * Show the form for editing the specified banking record.
     */
    public function edit(BankingRecord $bankingRecord)
    {
        $this->authorizeAccess($bankingRecord);

        return view('banking_records.edit', compact('bankingRecord'));
    }

    /**
     * Update the specified banking record in storage.
     */
    public function update(Request $request, BankingRecord $bankingRecord)
    {
        $this->authorizeAccess($bankingRecord);

        // Validate incoming request data
        $validated = $request->validate([
            'transaction_type' => 'required|in:Deposit,Withdrawal',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:500',
        ]);

        // Update the record
        $bankingRecord->update($validated);

        return redirect()->route('banking-records.index')
            ->with('success', 'Transaction updated successfully!');
    }

    /**
     * Remove the specified banking record from storage.
     */
    public function destroy(BankingRecord $bankingRecord)
    {
        $this->authorizeAccess($bankingRecord);

        $bankingRecord->delete();

        return redirect()->route('banking-records.index')
            ->with('success', 'Transaction deleted successfully!');
    }

    /**
     * Check if the authenticated user owns the record.
     * Abort with 403 if not authorized.
     *
     * @param BankingRecord $record
     */
    protected function authorizeAccess(BankingRecord $record)
    {
        if ($record->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
