<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes = VehicleType::all(); // Fetch all vehicle types
        return view('vehicle_types.index', compact('vehicleTypes'));
    }

    // You can add create, store, show, edit, update, destroy methods later if needed
}