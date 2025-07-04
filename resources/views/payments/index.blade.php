<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments List</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 1200px; margin: auto; }
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
        <h1>Payments List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('payments.create') }}" class="btn btn-primary">Record New Payment</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rental (Vehicle/Renter)</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>
                            @if($payment->rental)
                                Vehicle: {{ $payment->rental->vehicle->name ?? 'N/A' }} ({{ $payment->rental->vehicle->vehicle_no ?? 'N/A' }})<br>
                                Renter: {{ $payment->rental->renter->name ?? 'N/A' }}
                            @else
                                N/A (Rental Deleted)
                            @endif
                        </td>
                        <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                        <td>Rs. {{ number_format($payment->amount, 2) }}</td>
                        <td>{{ $payment->paymentMethod->method_name ?? 'N/A' }}</td>
                        <td>{{ $payment->paymentType->type_name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No payments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $payments->links() }}
    </div>
</body>
</html>