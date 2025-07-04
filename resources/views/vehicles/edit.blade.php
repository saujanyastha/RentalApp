<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Vehicle: ') }} {{ $vehicle->name ?? 'N/A' }} ({{ $vehicle->vehicle_no }})
        </h2>
    </x-slot>

    {{-- Custom styles for this page --}}
    <style>
        /* These styles will apply globally for this page when loaded */
        body { font-family: sans-serif; margin: 20px; } /* Note: body styles might be affected by app.blade.php's body styles */
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

    <div class="container">
        {{-- The <h1> tag content is now handled by x-slot name="header" --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- This tells Laravel it's an update request --}}

            <div class="form-group">
                <label for="owner_id">Owner:</label>
                <select id="owner_id" name="owner_id" required>
                    <option value="">Select an Owner</option>
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" {{ old('owner_id', $vehicle->owner_id) == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }} ({{ $owner->email }})
                        </option>
                    @endforeach
                </select>
                @error('owner_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Vehicle Name (Optional):</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $vehicle->name) }}">
                    @error('name') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="brand">Brand (Optional):</label>
                    <input type="text" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}">
                    @error('brand') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="color">Color (Optional):</label>
                    <input type="text" id="color" name="color" value="{{ old('color', $vehicle->color) }}">
                    @error('color') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="make_year">Make Year (Optional):</label>
                    <input type="number" id="make_year" name="make_year" value="{{ old('make_year', $vehicle->make_year) }}">
                    @error('make_year') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="lot_no">Lot No. (Optional):</label>
                    <input type="text" id="lot_no" name="lot_no" value="{{ old('lot_no', $vehicle->lot_no) }}">
                    @error('lot_no') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="engine_no">Engine No. (Required):</label>
                    <input type="text" id="engine_no" name="engine_no" value="{{ old('engine_no', $vehicle->engine_no) }}" required>
                    @error('engine_no') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="vehicle_no">Vehicle No. (Required - License Plate):</label>
                    <input type="text" id="vehicle_no" name="vehicle_no" value="{{ old('vehicle_no', $vehicle->vehicle_no) }}" required>
                    @error('vehicle_no') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="type_id">Vehicle Type (Required):</label>
                    <select id="type_id" name="type_id" required>
                        <option value="">Select Vehicle Type</option>
                        @foreach ($vehicleTypes as $type)
                            <option value="{{ $type->id }}" {{ old('type_id', $vehicle->type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->type_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_id') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="chassis_no">Chassis No. (Required):</label>
                <input type="text" id="chassis_no" name="chassis_no" value="{{ old('chassis_no', $vehicle->chassis_no) }}" required>
                @error('chassis_no') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status (Required):</label>
                <select id="status" name="status" required>
                    <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="rented" {{ old('status', $vehicle->status) == 'rented' ? 'selected' : '' }}>Rented</option>
                    <option value="maintenance" {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="unavailable" {{ old('status', $vehicle->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('status') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="purchased_price">Purchased Price (Optional):</label>
                    <input type="number" step="0.01" id="purchased_price" name="purchased_price" value="{{ old('purchased_price', $vehicle->purchased_price) }}">
                    @error('purchased_price') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="purchased_date">Purchased Date (Optional):</label>
                    <input type="date" id="purchased_date" name="purchased_date" value="{{ old('purchased_date', $vehicle->purchased_date) }}">
                    @error('purchased_date') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="note">Note (Optional):</label>
                <textarea id="note" name="note" rows="4">{{ old('note', $vehicle->note) }}</textarea>
                @error('note') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tax_renewal_date">Tax Renewal Date (Optional):</label>
                    <input type="date" id="tax_renewal_date" name="tax_renewal_date" value="{{ old('tax_renewal_date', $vehicle->tax_renewal_date) }}">
                    @error('tax_renewal_date') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="insurance_renewal_date">Insurance Renewal Date (Optional):</label>
                    <input type="date" id="insurance_renewal_date" name="insurance_renewal_date" value="{{ old('insurance_renewal_date', $vehicle->insurance_renewal_date) }}">
                    @error('insurance_renewal_date') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Vehicle</button>
            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>