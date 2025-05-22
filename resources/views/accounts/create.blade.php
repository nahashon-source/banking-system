@extends('layouts.app')

@section('content')
    <h1>Create New Account</h1>

    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> There were some problems with your input:<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('accounts.store') }}" method="POST">
        @csrf

        <div>
            <label>Account Number:</label>
            <input type="text" name="account_number" required>
        </div>

        <div>
            <label>Holder Name:</label>
            <input type="text" name="holder_name" required>
        </div>

        <div>
            <label>Balance:</label>
            <input type="number" name="balance" step="0.01" min="0" required>
        </div>

        <div>
            <label>Account Type:</label>
            <select name="account_type" required>
                <option value="">--Select--</option>
                <option value="saving">Saving</option>
                <option value="current">Current</option>
            </select>
        </div>

        <button type="submit">Create Account</button>
    </form>
@endsection
