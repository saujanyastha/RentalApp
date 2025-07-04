<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method Details</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        h1 { margin-bottom: 20px; }
        .detail-row { margin-bottom: 10px; }
        .detail-row strong { display: inline-block; width: 120px; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-secondary { background-color: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Method Details: {{ $paymentMethod->method_name }}</h1>

        <div class="detail-row">
            <strong>ID:</strong> {{ $paymentMethod->id }}
        </div>
        <div class="detail-row">
            <strong>Method Name:</strong> {{ $paymentMethod->method_name }}
        </div>
        <div class="detail-row">
            <strong>Description:</strong> {{ $paymentMethod->description ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Created At:</strong> {{ $paymentMethod->created_at }}
        </div>
        <div class="detail-row">
            <strong>Last Updated:</strong> {{ $paymentMethod->updated_at }}
        </div>

        <a href="{{ route('payment_methods.edit', $paymentMethod->id) }}" class="btn btn-warning">Edit Method</a>
        <a href="{{ route('payment_methods.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</body>
</html>