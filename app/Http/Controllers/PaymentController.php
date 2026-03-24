<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Show payment page
    public function request($planId)
    {
        $plan = Plan::findOrFail($planId);

        return view('payment.pay', compact('plan'));
    }

    // Confirm payment after user pays
    public function confirm(Request $request)
    {
        $plan = Plan::findOrFail($request->plan_id);

        Payment::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_method' => 'upi',
            'transaction_id' => $request->transaction_id,
            'status' => 'pending'
        ]);

        return redirect()->route('pricing')
        ->with('success','Payment submitted. Waiting for admin approval.');
    }
}