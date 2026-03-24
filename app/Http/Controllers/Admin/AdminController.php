<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalInvoices = Invoice::count();
        $totalSubscriptions = Subscription::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalInvoices',
            'totalSubscriptions'
        ));
    }

    public function users()
    {
        $users = User::with('subscription.plan')->latest()->get();
        $plans = Plan::all();

        return view('admin.users', compact('users','plans'));
    }

    public function invoices()
    {
        $invoices = Invoice::latest()->get();
        return view('admin.invoices', compact('invoices'));
    }

    public function payments()
    {
        $payments = Payment::latest()->get();
        return view('admin.payments', compact('payments'));
    }

    public function updateUserPlan(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $plan = Plan::findOrFail($request->plan_id);

        Subscription::updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan_id' => $plan->id,
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'is_active' => true
            ]
        );

        return back()->with('success', 'Plan updated successfully');
    }
}