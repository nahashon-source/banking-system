<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-4">

    <h1>Edit Account</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('accounts.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="account_number" class="form-label">Account Number</label>
            <input type="text" name="account_number" class="form-control" id="account_number" value="{{ old('account_number', $account->account_number) }}" required>
        </div>

        <div class="mb-3">
            <label for="holder_name" class="form-label">Holder Name</label>
            <input type="text" name="holder_name" class="form-control" id="holder_name" value="{{ old('holder_name', $account->holder_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="balance" class="form-label">Balance</label>
            <input type="number" step="0.01" name="balance" class="form-control" id="balance" value="{{ old('balance', $account->balance) }}" required>
        </div>

        <div class="mb-3">
            <label for="account_type" class="form-label">Account Type</label>
            <select name="account_type" id="account_type" class="form-select" required>
                <option value="">Select Type</option>
                <option value="savings" {{ (old('account_type', $account->account_type) == 'savings') ? 'selected' : '' }}>Savings</option>
                <option value="current" {{ (old('account_type', $account->account_type) == 'current') ? 'selected' : '' }}>Current</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Account</button>
        <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
