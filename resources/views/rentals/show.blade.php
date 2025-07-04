<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Details</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        h1 { margin-bottom: 20px; }
        .detail-row { margin-bottom: 10px; }
        .detail-row strong { display: inline-block; width: 180px; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-secondary { background-color: #6c757d; color: white; }
    </style>
</head>

<body>
    <div class="container">
        <h1>Rental Details: #{{ $rental->id }}</h1>

        <div class="detail-row">
            <strong>ID:</strong> {{ $rental->id }}
        </div>
        <div class="detail-row">
            <strong>Vehicle:</strong> {{ $rental->vehicle->name ?? 'N/A' }} ({{ $rental->vehicle->vehicle_no ?? 'N/A' }})
        </div>
        <div class="detail-row">
            <strong>Renter:</strong> {{ $rental->renter->name ?? 'N/A' }} ({{ $rental->renter->email ?? 'N/A' }})
        </div>
        <div class="detail-row">
            <strong>Rental Start Date:</strong> {{ $rental->rental_start_date->format('Y-m-d') }}
        </div>
        <div class="detail-row">
            <strong>Rental End Date:</strong> {{ $rental->rental_end_date ? $rental->rental_end_date->format('Y-m-d') : 'Ongoing' }}
        </div>
        <div class="detail-row">
            <strong>Payment Start Date:</strong> {{ $rental->payment_start_date->format('Y-m-d') }}
        </div>
        <div class="detail-row">
            <strong>Daily Amount:</strong> Rs. {{ number_format($rental->daily_amount, 2) }}
        </div>
        <div class="detail-row">
            <strong>Advance Payment:</strong> {{ $rental->advance ? 'Yes' : 'No' }}
        </div>
        <div class="detail-row">
            <strong>Advance Amount:</strong> {{ $rental->advance_amount ? 'Rs. ' . number_format($rental->advance_amount, 2) : 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Status:</strong> {{ ucfirst($rental->status) }}
        </div>
        <div class="detail-row">
            <strong>Estimated Rent End Date:</strong> {{ $rental->estimated_rent_end_date ? $rental->estimated_rent_end_date->format('Y-m-d') : 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Note:</strong> {{ $rental->note ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Created At:</strong> {{ $rental->created_at }}
        </div>
        <div class="detail-row">
            <strong>Last Updated:</strong> {{ $rental->updated_at }}
        </div>

        <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-warning">Edit Rental</a>
        <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Back to Rentals List</a>
    </div>
</body>
</html>