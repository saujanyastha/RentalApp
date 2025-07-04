<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
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
        <h1>Payment Details: #{{ $payment->id }}</h1>

        <div class="detail-row">
            <strong>ID:</strong> {{ $payment->id }}
        </div>
        <div class="detail-row">
            <strong>Rental ID:</strong> {{ $payment->rental->id ?? 'N/A' }}
            @if($payment->rental)
                (Vehicle: {{ $payment->rental->vehicle->name ?? 'N/A' }} | Renter: {{ $payment->rental->renter->name ?? 'N/A' }})
            @endif
        </div>
        <div class="detail-row">
            <strong>Payment Date:</strong> {{ $payment->payment_date->format('Y-m-d') }}
        </div>
        <div class="detail-row">
            <strong>Amount:</strong> Rs. {{ number_format($payment->amount, 2) }}
        </div>
        <div class="detail-row">
            <strong>Payment Method:</strong> {{ $payment->paymentMethod->method_name ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Payment Type:</strong> {{ $payment->paymentType->type_name ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Note:</strong> {{ $payment->note ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Created At:</strong> {{ $payment->created_at }}
        </div>
        <div class="detail-row">
            <strong>Last Updated:</strong> {{ $payment->updated_at }}
        </div>

        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning">Edit Payment</a>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back to Payments List</a>
    </div>
</body>

</html>