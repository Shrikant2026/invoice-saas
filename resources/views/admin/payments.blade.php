@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-semibold mb-6">
Payments
</h2>

<div class="space-y-4">

@foreach($payments as $payment)

<div class="bg-white p-5 rounded-xl shadow flex justify-between items-center">

<div>

<p class="font-semibold">
{{ $payment->user->name }}
</p>

<p class="text-sm text-gray-500">
{{ $payment->plan->name }} - ₹{{ $payment->amount }}
</p>

<p class="text-xs text-gray-400">
Transaction ID: {{ $payment->transaction_id ?? 'N/A' }}
</p>

</div>

<div class="flex items-center gap-2">

@if($payment->status == 'pending')

<form method="POST"
action="{{ route('admin.payments.approve',$payment->id) }}">
@csrf

<button class="bg-green-500 text-white px-3 py-1 rounded">
Approve
</button>

</form>

<form method="POST"
action="{{ route('admin.payments.reject',$payment->id) }}">
@csrf

<button class="bg-red-500 text-white px-3 py-1 rounded">
Reject
</button>

</form>

@else

<span class="text-sm px-3 py-1 rounded 
@if($payment->status == 'approved') bg-green-100 text-green-600
@else bg-red-100 text-red-600
@endif
">
{{ ucfirst($payment->status) }}
</span>

@endif

</div>

</div>

@endforeach

</div>

@endsection