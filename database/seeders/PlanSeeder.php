<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('plans')->delete();

        Plan::create([
            'name' => 'Free',
            'price' => 0,
            'billing_cycle' => 'monthly',
            'invoice_limit' => 5,
            'client_limit' => 5,
        ]);

        Plan::create([
            'name' => 'Starter',
            'price' => 50,
            'billing_cycle' => 'monthly',
            'invoice_limit' => 50,
            'client_limit' => 50,
        ]);

        Plan::create([
            'name' => 'Pro',
            'price' => 80,
            'billing_cycle' => 'monthly',
            'invoice_limit' => null,
            'client_limit' => null,
        ]);

    }
}