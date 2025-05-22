<!-- resources/views/accounts/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Accounts List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Accounts List</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('accounts.create') }}" class="btn btn-primary mb-3">Add New Account</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account Number</th>
                <th>Holder Name</th>
                <th>Balance</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($accounts as $account)
            <tr>
                <td>{{ $account->id }}</td>
                <td>{{ $account->account_number }}</td>
                <td>{{ $account->holder_name }}</td>
                <td>{{ $account->balance }}</td>
                <td>{{ $account->account_type }}</td>
                <td>
                    <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this account?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
