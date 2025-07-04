<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        // Eager load related models for better performance
        $payments = Payment::with(['rental.vehicle', 'rental.renter', 'paymentMethod', 'paymentType'])
                            ->orderBy('payment_date', 'desc')
                            ->paginate(10);

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $rentals = Rental::whereIn('status', ['active', 'pending'])->get(); // Only active/pending rentals
        $paymentMethods = PaymentMethod::all();
        $paymentTypes = PaymentType::all();

        return view('payments.create', compact('rentals', 'paymentMethods', 'paymentTypes'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'note' => 'nullable|string',
        ]);

        Payment::create($validatedData);

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load(['rental.vehicle', 'rental.renter', 'paymentMethod', 'paymentType']);
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payment $payment)
    {
        $rentals = Rental::all(); // Fetch all rentals for selection
        $paymentMethods = PaymentMethod::all();
        $paymentTypes = PaymentType::all();

        return view('payments.edit', compact('payment', 'rentals', 'paymentMethods', 'paymentTypes'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'note' => 'nullable|string',
        ]);

        $payment->update($validatedData);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    }
}