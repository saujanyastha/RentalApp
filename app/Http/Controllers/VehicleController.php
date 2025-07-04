<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\User; // Needed for owner_id dropdown
use App\Models\VehicleType; // Needed for type_id dropdown
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Needed for unique engine/vehicle/chassis no validation

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Check if a 'status' query parameter is present in the URL
        if ($request->has('status') && $request->status !== null) {
            $status = $request->input('status');

            // If the status contains a comma, it means multiple statuses are being requested
            if (str_contains($status, ',')) {
                $statuses = explode(',', $status);
                $query->whereIn('status', $statuses); // Filter by multiple statuses
            } else {
                $query->where('status', $status); // Filter by a single status
            }
        }

        // Add any other filtering, sorting, or searching logic here if you have it
        // ...

        // Paginate the results (e.g., 10 vehicles per page)
        $vehicles = $query->paginate(10); // Adjust pagination limit as needed

        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        // Fetch all users (potential owners) and vehicle types for dropdowns
        $owners = User::all();
        $vehicleTypes = VehicleType::all();
        return view('vehicles.create', compact('owners', 'vehicleTypes'));
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'make_year' => 'nullable|integer|digits:4|min:1900|max:' . (date('Y') + 1), // Max 1 year in future
            'lot_no' => 'nullable|string|max:255',
            'engine_no' => 'required|string|max:255|unique:vehicles,engine_no',
            'vehicle_no' => 'required|string|max:255|unique:vehicles,vehicle_no',
            'type_id' => 'required|exists:vehicle_types,id',
            'chassis_no' => 'required|string|max:255|unique:vehicles,chassis_no',
            'status' => 'required|string|in:available,rented,maintenance,unavailable', // Define possible statuses
            'purchased_price' => 'nullable|numeric|min:0',
            'purchased_date' => 'nullable|date',
            'note' => 'nullable|string',
            'tax_renewal_date' => 'nullable|date|after_or_equal:purchased_date',
            'insurance_renewal_date' => 'nullable|date|after_or_equal:purchased_date',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully!');
    }

    /**
     * Display the specified vehicle.
     */
    public function show(Vehicle $vehicle)
    {
        // Eager load owner and vehicleType for display
        $vehicle->load('owner', 'vehicleType');
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        $owners = User::all();
        $vehicleTypes = VehicleType::all();
        return view('vehicles.edit', compact('vehicle', 'owners', 'vehicleTypes'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'make_year' => 'nullable|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'lot_no' => 'nullable|string|max:255',
            'engine_no' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicles')->ignore($vehicle->id, 'id'), // Ignore current vehicle's engine_no
            ],
            'vehicle_no' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicles')->ignore($vehicle->id, 'id'), // Ignore current vehicle's vehicle_no
            ],
            'type_id' => 'required|exists:vehicle_types,id',
            'chassis_no' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vehicles')->ignore($vehicle->id, 'id'), // Ignore current vehicle's chassis_no
            ],
            'status' => 'required|string|in:available,rented,maintenance,unavailable',
            'purchased_price' => 'nullable|numeric|min:0',
            'purchased_date' => 'nullable|date',
            'note' => 'nullable|string',
            'tax_renewal_date' => 'nullable|date|after_or_equal:purchased_date',
            'insurance_renewal_date' => 'nullable|date|after_or_equal:purchased_date',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully!');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully!');
    }
}