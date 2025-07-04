<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicles List') }}
        </h2>
    </x-slot>

    {{-- Custom styles for this page --}}
    <style>
        /* These styles will apply globally for this page when loaded */
        body { font-family: sans-serif; margin: 20px; } /* Note: body styles might be affected by app.blade.php's body styles */
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

    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <br>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Add New Vehicle</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Vehicle No.</th>
                    <th>Owner</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->id }}</td>
                        <td>{{ $vehicle->name ?? 'N/A' }}</td>
                        <td>{{ $vehicle->brand ?? 'N/A' }}</td>
                        <td>{{ $vehicle->vehicle_no }}</td>
                        <td>{{ $vehicle->owner->name ?? 'N/A' }}</td>
                        <td>{{ $vehicle->vehicleType->type_name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($vehicle->status) }}</td>
                        <td>
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No vehicles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $vehicles->links() }} {{-- Pagination links --}}
    </div>
</x-app-layout>