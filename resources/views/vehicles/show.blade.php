<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Details: ') }} {{ $vehicle->name ?? 'N/A' }} ({{ $vehicle->vehicle_no }})
        </h2>
    </x-slot>

    {{-- Custom styles for this page --}}
    <style>
        /* These styles will apply globally for this page when loaded */
        body { font-family: sans-serif; margin: 20px; } /* Note: body styles might be affected by app.blade.php's body styles */
        .container { max-width: 800px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        h1 { margin-bottom: 20px; } /* This h1 will now refer to the one inside the container, not the removed one */
        .detail-row { margin-bottom: 10px; }
        .detail-row strong { display: inline-block; width: 180px; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-secondary { background-color: #6c757d; color: white; }
    </style>

    <div class="py-12"> {{-- Add a py-12 div for consistent spacing with Breeze --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        {{-- The h1 is now within the x-slot header, so this one can be removed or kept as a sub-heading --}}
                        {{-- For consistency with previous files, the title is moved to the header slot. If you want a sub-heading inside the container, you can add another h3 or h2 here. --}}

                        <div class="detail-row">
                            <strong>ID:</strong> {{ $vehicle->id }}
                        </div>
                        <div class="detail-row">
                            <strong>Owner:</strong> {{ $vehicle->owner->name ?? 'N/A' }} ({{ $vehicle->owner->email ?? 'N/A' }})
                        </div>
                        <div class="detail-row">
                            <strong>Name:</strong> {{ $vehicle->name ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Brand:</strong> {{ $vehicle->brand ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Color:</strong> {{ $vehicle->color ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Make Year:</strong> {{ $vehicle->make_year ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Lot No.:</strong> {{ $vehicle->lot_no ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Engine No.:</strong> {{ $vehicle->engine_no }}
                        </div>
                        <div class="detail-row">
                            <strong>Vehicle No. (Plate):</strong> {{ $vehicle->vehicle_no }}
                        </div>
                        <div class="detail-row">
                            <strong>Vehicle Type:</strong> {{ $vehicle->vehicleType->type_name ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Chassis No.:</strong> {{ $vehicle->chassis_no }}
                        </div>
                        <div class="detail-row">
                            <strong>Status:</strong> {{ ucfirst($vehicle->status) }}
                        </div>
                        <div class="detail-row">
                            <strong>Purchased Price:</strong> {{ $vehicle->purchased_price ? 'Rs. ' . number_format($vehicle->purchased_price, 2) : 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Purchased Date:</strong> {{ $vehicle->purchased_date ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Note:</strong> {{ $vehicle->note ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Tax Renewal Date:</strong> {{ $vehicle->tax_renewal_date ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Insurance Renewal Date:</strong> {{ $vehicle->insurance_renewal_date ?? 'N/A' }}
                        </div>
                        <div class="detail-row">
                            <strong>Created At:</strong> {{ $vehicle->created_at }}
                        </div>
                        <div class="detail-row">
                            <strong>Last Updated:</strong> {{ $vehicle->updated_at }}
                        </div>

                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Edit Vehicle</a>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back to Vehicles List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>