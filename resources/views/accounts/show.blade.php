@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Account Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Account Number: {{ $account->account_number }}</h5>
            <p class="card-text"><strong>Holder Name:</strong> {{ $account->holder_name }}</p>
            <p class="card-text"><strong>Balance:</strong> KES {{ number_format($account->balance, 2) }}</p>
            <p class="card-text"><strong>Account Type:</strong> {{ ucfirst($account->account_type) }}</p>

            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
