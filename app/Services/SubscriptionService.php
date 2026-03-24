<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Subscription;

class SubscriptionService
{
    public static function assignFreePlan($user)
    {
        $freePlan = Plan::where('name', 'Free')->first();

        Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $freePlan->id,
            'starts_at' => now(),
            'ends_at' => now()->addMonth(),
            'is_active' => true
        ]);
    }
}