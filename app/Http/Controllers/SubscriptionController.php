<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscribe($planId)
    {
        $plan = Plan::findOrFail($planId);

        $start = Carbon::now();

        $end = $plan->billing_cycle === 'yearly'
            ? Carbon::now()->addYear()
            : Carbon::now()->addMonth();

        Subscription::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'plan_id' => $plan->id,
                'starts_at' => $start,
                'ends_at' => $end,
                'is_active' => true
            ]
        );

        return redirect()->back()->with('success', 'Plan activated successfully!');
    }
}