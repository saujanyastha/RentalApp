<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentals List</title>
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
        <h1>Rentals List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('rentals.create') }}" class="btn btn-primary">Create New Rental</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehicle</th>
                    <th>Renter</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Daily Amount</th>
                    <th>Advance</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rentals as $rental)
                    <tr>
                        <td>{{ $rental->id }}</td>
                        <td>{{ $rental->vehicle->name ?? 'N/A' }} ({{ $rental->vehicle->vehicle_no ?? 'N/A' }})</td>
                        <td>{{ $rental->renter->name ?? 'N/A' }}</td>
                        <td>{{ $rental->rental_start_date->format('Y-m-d') }}</td>
                        <td>{{ $rental->rental_end_date ? $rental->rental_end_date->format('Y-m-d') : 'Ongoing' }}</td>
                        <td>Rs. {{ number_format($rental->daily_amount, 2) }}</td>
                        <td>{{ $rental->advance ? 'Yes (Rs. ' . number_format($rental->advance_amount, 2) . ')' : 'No' }}</td>
                        <td>{{ ucfirst($rental->status) }}</td>
                        <td>
                            <a href="{{ route('rentals.show', $rental->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this rental?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No rentals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $rentals->links() }} {{-- Pagination links --}}
    </div>
</body>
</html>