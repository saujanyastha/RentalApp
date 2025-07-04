<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], input[type="date"], textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; border: none; }
        .btn-secondary { background-color: #6c757d; color: white; border: none; margin-left: 10px; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
        .form-row { display: flex; flex-wrap: wrap; gap: 15px; }
        .form-row > div { flex: 1 1 calc(50% - 15px); }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Payment: #{{ $payment->id }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payments.update', $payment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="rental_id">Associated Rental:</label>
                <select id="rental_id" name="rental_id" required>
                    <option value="">Select a Rental</option>
                    @foreach ($rentals as $rental)
                        <option value="{{ $rental->id }}" {{ old('rental_id', $payment->rental_id) == $rental->id ? 'selected' : '' }}>
                            Rental #{{ $rental->id }} - Vehicle: {{ $rental->vehicle->name ?? 'N/A' }} ({{ $rental->vehicle->vehicle_no ?? 'N/A' }}) - Renter: {{ $rental->renter->name ?? 'N/A' }}
                            (Start: {{ $rental->rental_start_date->format('Y-m-d') }})
                        </option>
                    @endforeach
                </select>
                @error('rental_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="payment_date">Payment Date:</label>
                    <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" required>
                    @error('payment_date') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount', $payment->amount) }}" required>
                    @error('amount') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="payment_method_id">Payment Method:</label>
                    <select id="payment_method_id" name="payment_method_id" required>
                        <option value="">Select a Method</option>
                        @foreach ($paymentMethods as $method)
                            <option value="{{ $method->id }}" {{ old('payment_method_id', $payment->payment_method_id) == $method->id ? 'selected' : '' }}>
                                {{ $method->method_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('payment_method_id') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="payment_type_id">Payment Type:</label>
                    <select id="payment_type_id" name="payment_type_id" required>
                        <option value="">Select a Type</option>
                        @foreach ($paymentTypes as $type)
                            <option value="{{ $type->id }}" {{ old('payment_type_id', $payment->payment_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->type_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('payment_type_id') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="note">Note (Optional):</label>
                <textarea id="note" name="note" rows="4">{{ old('note', $payment->note) }}</textarea>
                @error('note') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Payment</button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>