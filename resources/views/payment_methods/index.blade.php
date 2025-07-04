<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Methods List</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        .btn-primary { background-color: #007bff; color: white; }
        .btn-success { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; color: white; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border-color: #c3e6cb; }
        .pagination { margin-top: 20px; display: flex; list-style: none; padding: 0; }
        .pagination li { margin-right: 5px; }
        .pagination li a, .pagination li span {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #007bff;
            border-radius: 4px;
        }
        .pagination li span.current {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Methods List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('payment_methods.create') }}" class="btn btn-primary">Add New Payment Method</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Method Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($paymentMethods as $method)
                    <tr>
                        <td>{{ $method->id }}</td>
                        <td>{{ $method->method_name }}</td>
                        <td>{{ $method->description ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('payment_methods.show', $method->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('payment_methods.edit', $method->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('payment_methods.destroy', $method->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment method?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No payment methods found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $paymentMethods->links() }}
    </div>
</body>
</html>