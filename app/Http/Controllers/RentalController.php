<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Vehicle; // Needed for vehicle_id dropdown
use App\Models\User;    // Needed for renter_id dropdown (users with type 'Renter' would be ideal)
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the rentals.
     */
    public function index()
    {
        // Fetch all rentals with their associated vehicle and renter
        $rentals = Rental::with(['vehicle', 'renter'])->orderBy('rental_start_date', 'desc')->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new rental.
     */
    public function create()
    {
        // Fetch available vehicles (you might want to add logic to only show truly available ones)
        $vehicles = Vehicle::where('status', 'available')->get();
        // Fetch users who can be renters (e.g., users with UserType 'Renter')
        // For now, let's just get all users, you can refine this later
        $renters = User::all();

        return view('rentals.create', compact('vehicles', 'renters'));
    }

    /**
     * Store a newly created rental in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'renter_id' => 'required|exists:users,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'payment_start_date' => 'required|date|after_or_equal:rental_start_date', // Could be same day or after
            'daily_amount' => 'required|numeric|min:0',
            'advance' => 'boolean', // Checkbox value will be 0 or 1
            'advance_amount' => 'nullable|numeric|min:0|required_if:advance,1', // Required if advance is true
            'status' => 'required|string|in:pending,active,completed,cancelled', // Define possible statuses
            'estimated_rent_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'note' => 'nullable|string',
        ]);

        // Ensure advance_amount is null if advance is false
        if (!$request->boolean('advance')) {
            $validatedData['advance_amount'] = null;
        }

        // Create the rental
        $rental = Rental::create($validatedData);

        // Optionally, update the vehicle status to 'rented' if rental is active/pending
        if (in_array($rental->status, ['pending', 'active'])) {
            $rental->vehicle->update(['status' => 'rented']);
        }


        return redirect()->route('rentals.index')->with('success', 'Rental created successfully!');
    }

    /**
     * Display the specified rental.
     */
    public function show(Rental $rental)
    {
        // Eager load vehicle and renter for display
        $rental->load('vehicle', 'renter');
        return view('rentals.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified rental.
     */
    public function edit(Rental $rental)
    {
        $vehicles = Vehicle::all(); // Could be filtered based on current status and original rented vehicle
        $renters = User::all();
        return view('rentals.edit', compact('rental', 'vehicles', 'renters'));
    }

    /**
     * Update the specified rental in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'renter_id' => 'required|exists:users,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'payment_start_date' => 'required|date|after_or_equal:rental_start_date',
            'daily_amount' => 'required|numeric|min:0',
            'advance' => 'boolean',
            'advance_amount' => 'nullable|numeric|min:0|required_if:advance,1',
            'status' => 'required|string|in:pending,active,completed,cancelled',
            'estimated_rent_end_date' => 'nullable|date|after_or_equal:rental_start_date',
            'note' => 'nullable|string',
        ]);

        // Keep track of old vehicle status for potential change
        $oldVehicleStatus = $rental->vehicle->status;

        // Ensure advance_amount is null if advance is false
        if (!$request->boolean('advance')) {
            $validatedData['advance_amount'] = null;
        }

        $rental->update($validatedData);

        // Logic to update vehicle status based on rental status
        // If rental becomes 'completed' or 'cancelled', potentially mark vehicle as 'available'
        if ($rental->status === 'completed' || $rental->status === 'cancelled') {
            $rental->vehicle->update(['status' => 'available']);
        } elseif (in_array($rental->status, ['pending', 'active']) && $oldVehicleStatus === 'available') {
            // If rental is active/pending and vehicle was available, mark it as rented
            $rental->vehicle->update(['status' => 'rented']);
        } elseif (in_array($rental->status, ['pending', 'active']) && $oldVehicleStatus === 'rented' && $rental->vehicle_id != $rental->getOriginal('vehicle_id')) {
            // If vehicle was changed for an active rental, old vehicle might become available
            $oldVehicle = Vehicle::find($rental->getOriginal('vehicle_id'));
            if ($oldVehicle) {
                $oldVehicle->update(['status' => 'available']);
            }
            $rental->vehicle->update(['status' => 'rented']);
        }

        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully!');
    }

    /**
     * Remove the specified rental from storage.
     */
    public function destroy(Rental $rental)
    {
        // Before deleting, if the vehicle was marked as rented by this rental,
        // you might want to revert its status to 'available'
        $vehicle = $rental->vehicle; // Get the associated vehicle BEFORE deleting the rental

        $rental->delete();

        // If the deleted rental was the ONLY active/pending rental for this vehicle,
        // consider setting the vehicle status back to 'available'.
        // This logic can get complex if a vehicle can have multiple concurrent rentals (unlikely for a single vehicle).
        // For simplicity, let's assume if it was marked 'rented' by this specific rental, it becomes available.
        // A more robust check would be to see if ANY other active rentals exist for this vehicle.
        if ($vehicle && $vehicle->status === 'rented') {
             // Check if there are any other active/pending rentals for this vehicle
            $activeRentalsForVehicle = Rental::where('vehicle_id', $vehicle->id)
                                             ->whereIn('status', ['pending', 'active'])
                                             ->count();
            if ($activeRentalsForVehicle === 0) {
                $vehicle->update(['status' => 'available']);
            }
        }


        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully!');
    }
}