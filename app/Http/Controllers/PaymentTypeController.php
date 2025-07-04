<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the payment types.
     */
    public function index()
    {
        $paymentTypes = PaymentType::orderBy('type_name')->paginate(10);
        return view('payment_types.index', compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new payment type.
     */
    public function create()
    {
        return view('payment_types.create');
    }

    /**
     * Store a newly created payment type in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255|unique:payment_types,type_name',
            'description' => 'nullable|string',
        ]);

        PaymentType::create($request->all());

        return redirect()->route('payment_types.index')->with('success', 'Payment type created successfully!');
    }

    /**
     * Display the specified payment type.
     */
    public function show(PaymentType $paymentType)
    {
        return view('payment_types.show', compact('paymentType'));
    }

    /**
     * Show the form for editing the specified payment type.
     */
    public function edit(PaymentType $paymentType)
    {
        return view('payment_types.edit', compact('paymentType'));
    }

    /**
     * Update the specified payment type in storage.
     */
    public function update(Request $request, PaymentType $paymentType)
    {
        $request->validate([
            'type_name' => 'required|string|max:255|unique:payment_types,type_name,' . $paymentType->id,
            'description' => 'nullable|string',
        ]);

        $paymentType->update($request->all());

        return redirect()->route('payment_types.index')->with('success', 'Payment type updated successfully!');
    }

    /**
     * Remove the specified payment type from storage.
     */
    public function destroy(PaymentType $paymentType)
    {
        // Optional: Add a check here if payment type is associated with any payments
        // If it is, you might want to prevent deletion or soft delete it.
        // For now, simple delete.
        $paymentType->delete();

        return redirect()->route('payment_types.index')->with('success', 'Payment type deleted successfully!');
    }
}