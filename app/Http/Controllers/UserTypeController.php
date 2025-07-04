<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userTypes = UserType::all(); // Fetch all user types
        return view('user_types.index', compact('userTypes'));
    }

    // You can add create, store, show, edit, update, destroy methods later if needed
}