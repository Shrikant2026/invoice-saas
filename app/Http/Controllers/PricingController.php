<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PricingController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('pricing.index', compact('plans'));
    }
}
