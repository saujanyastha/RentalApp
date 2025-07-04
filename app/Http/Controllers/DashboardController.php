<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle; // Make sure to import your Vehicle model

class DashboardController extends Controller
{
    /**
     * Display the dashboard view with vehicle counts.
     */
    public function index()
    {
        // Get vehicle counts by status
        $totalVehicles = Vehicle::count();
        $availableVehicles = Vehicle::where('status', 'available')->count();
        $rentedVehicles = Vehicle::where('status', 'rented')->count();
        $maintenanceVehicles = Vehicle::where('status', 'maintenance')->count();
        $unavailableVehicles = Vehicle::where('status', 'unavailable')->count();

        return view('dashboard', compact(
            'totalVehicles',
            'availableVehicles',
            'rentedVehicles',
            'maintenanceVehicles',
            'unavailableVehicles'
        ));
    }
}