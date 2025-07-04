<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Type Details</title>
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
        <h1>Payment Type Details: {{ $paymentType->type_name }}</h1>

        <div class="detail-row">
            <strong>ID:</strong> {{ $paymentType->id }}
        </div>
        <div class="detail-row">
            <strong>Type Name:</strong> {{ $paymentType->type_name }}
        </div>
        <div class="detail-row">
            <strong>Description:</strong> {{ $paymentType->description ?? 'N/A' }}
        </div>
        <div class="detail-row">
            <strong>Created At:</strong> {{ $paymentType->created_at }}
        </div>
        <div class="detail-row">
            <strong>Last Updated:</strong> {{ $paymentType->updated_at }}
        </div>

        <a href="{{ route('payment_types.edit', $paymentType->id) }}" class="btn btn-warning">Edit Type</a>
        <a href="{{ route('payment_types.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</body>
</html>