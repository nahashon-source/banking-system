<!-- resources/views/accounts/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Accounts List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-4">

    <h1>Bank Accounts</h1>
    <a href="{{ route('accounts.create') }}" class="btn btn-primary mb-3">Create New Account</a>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account Number</th>
                <th>Holder Name</th>
                <th>Balance</th>
                <th>Account Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($accounts as $account)
            <tr>
                <td>{{ $account->id }}</td>
                <td>{{ $account->account_number }}</td>
                <td>{{ $account->holder_name }}</td>
                <td>${{ number_format($account->balance, 2) }}</td>
                <td>{{ ucfirst($account->account_type) }}</td>
                <td>
                    <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this account?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No accounts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
