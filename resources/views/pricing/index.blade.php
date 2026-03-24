@extends('layouts.app')

@section('title', 'Pricing')

@section('content')


<div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Choose Your Plan</h2>
    <p class="text-gray-500 text-sm">Upgrade your account to unlock more features</p>
</div>

@php
$currentPlan = auth()->user()->subscription?->plan?->id;
@endphp
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($plans as $plan)

<div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-6">

    <!-- Plan Name -->
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-lg font-semibold text-gray-800">
            {{ $plan->name }}
        </h3>

        @if($plan->name == 'Pro')
            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                Popular
            </span>
        @endif
    </div>

    <!-- Price -->
    <div class="mb-4">
        <span class="text-3xl font-bold text-gray-900">
            ₹{{ $plan->price }}
        </span>
        <span class="text-gray-500 text-sm">
            / {{ $plan->billing_cycle }}
        </span>
    </div>

    <!-- Features -->
    <ul class="text-sm text-gray-600 space-y-2 mb-6">

        @if($plan->invoice_limit)
            <li>✔ {{ $plan->invoice_limit }} invoices</li>
        @else
            <li>✔ Unlimited invoices</li>
        @endif

        @if($plan->client_limit)
            <li>✔ {{ $plan->client_limit }} clients</li>
        @else
            <li>✔ Unlimited clients</li>
        @endif

        <li>✔ Priority Support</li>

    </ul>

    <!-- Button -->
    @if($currentPlan == $plan->id)

    <button 
    class="block w-full text-center bg-gray-300 text-gray-600 py-2 rounded-lg cursor-not-allowed">
        Current Plan
    </button>

    @else

    <form method="GET" action="{{ route('payment.page', $plan->id) }}">
        <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
        Upgrade
        </button>
    </form>

    @endif

</div>

@endforeach

</div>

@endsection