<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Rental</title>
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
        input[type="checkbox"] { width: auto; margin-top: 5px; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; cursor: pointer; }
        .btn-primary { background-color: #007bff; color: white; border: none; }
        .btn-secondary { background-color: #6c757d; color: white; border: none; margin-left: 10px; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
        .form-row { display: flex; flex-wrap: wrap; gap: 15px; }
        .form-row > div { flex: 1 1 calc(50% - 15px); }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const advanceCheckbox = document.getElementById('advance');
            const advanceAmountGroup = document.getElementById('advance_amount_group');

            function toggleAdvanceAmount() {
                if (advanceCheckbox.checked) {
                    advanceAmountGroup.style.display = 'block';
                } else {
                    advanceAmountGroup.style.display = 'none';
                    document.getElementById('advance_amount').value = ''; // Clear value when hidden
                }
            }

            advanceCheckbox.addEventListener('change', toggleAdvanceAmount);

            // Initial state
            toggleAdvanceAmount();
        });
    </script>
</head>

<body>
    <div class="container">
        <h1>Create New Rental</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rentals.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="vehicle_id">Vehicle (Available):</label>
                <select id="vehicle_id" name="vehicle_id" required>
                    <option value="">Select a Vehicle</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->name ?? 'N/A' }} ({{ $vehicle->vehicle_no }}) - {{ $vehicle->vehicleType->type_name ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="renter_id">Renter:</label>
                <select id="renter_id" name="renter_id" required>
                    <option value="">Select a Renter</option>
                    @foreach ($renters as $renter)
                        <option value="{{ $renter->id }}" {{ old('renter_id') == $renter->id ? 'selected' : '' }}>
                            {{ $renter->name }} ({{ $renter->email }})
                        </option>
                    @endforeach
                </select>
                @error('renter_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="rental_start_date">Rental Start Date:</label>
                    <input type="date" id="rental_start_date" name="rental_start_date" value="{{ old('rental_start_date') }}" required>
                    @error('rental_start_date') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="rental_end_date">Rental End Date (Optional):</label>
                    <input type="date" id="rental_end_date" name="rental_end_date" value="{{ old('rental_end_date') }}">
                    @error('rental_end_date') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="payment_start_date">Payment Start Date:</label>
                    <input type="date" id="payment_start_date" name="payment_start_date" value="{{ old('payment_start_date') }}" required>
                    @error('payment_start_date') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="daily_amount">Daily Amount:</label>
                    <input type="number" step="0.01" id="daily_amount" name="daily_amount" value="{{ old('daily_amount') }}" required>
                    @error('daily_amount') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="advance">
                    <input type="checkbox" id="advance" name="advance" value="1" {{ old('advance') ? 'checked' : '' }}>
                    Advance Payment
                </label>
                @error('advance') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group" id="advance_amount_group" style="display: none;">
                <label for="advance_amount">Advance Amount:</label>
                <input type="number" step="0.01" id="advance_amount" name="advance_amount" value="{{ old('advance_amount') }}">
                @error('advance_amount') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="estimated_rent_end_date">Estimated Rent End Date (Optional):</label>
                <input type="date" id="estimated_rent_end_date" name="estimated_rent_end_date" value="{{ old('estimated_rent_end_date') }}">
                @error('estimated_rent_end_date') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="note">Note (Optional):</label>
                <textarea id="note" name="note" rows="4">{{ old('note') }}</textarea>
                @error('note') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Rental</button>
            <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>