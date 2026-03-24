<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user','plan')
        ->latest()
        ->get();

        return view('admin.payments', compact('payments'));
    }

    public function approve($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'approved'
        ]);

        Subscription::updateOrCreate(
            ['user_id' => $payment->user_id],
            [
                'plan_id' => $payment->plan_id,
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'is_active' => true
            ]
        );

        return back()->with('success','Payment approved and plan activated');
    }

    public function reject($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'rejected'
        ]);

        return back()->with('success','Payment rejected');
    }
}