<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the payment methods.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::orderBy('method_name')->paginate(10);
        return view('payment_methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new payment method.
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created payment method in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'method_name' => 'required|string|max:255|unique:payment_methods,method_name',
            'description' => 'nullable|string',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('payment_methods.index')->with('success', 'Payment method created successfully!');
    }

    /**
     * Display the specified payment method.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return view('payment_methods.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified payment method.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment_methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified payment method in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'method_name' => 'required|string|max:255|unique:payment_methods,method_name,' . $paymentMethod->id,
            'description' => 'nullable|string',
        ]);

        $paymentMethod->update($request->all());

        return redirect()->route('payment_methods.index')->with('success', 'Payment method updated successfully!');
    }

    /**
     * Remove the specified payment method from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        // Optional: Add a check here if payment method is associated with any payments
        // If it is, you might want to prevent deletion or soft delete it.
        // For now, simple delete.
        $paymentMethod->delete();

        return redirect()->route('payment_methods.index')->with('success', 'Payment method deleted successfully!');
    }
}