@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

<h2 class="text-xl font-semibold mb-4">
Complete Payment
</h2>

<p class="mb-2">
Plan: <strong>{{ $plan->name }}</strong>
</p>

<p class="mb-6">
Amount: <strong>₹{{ $plan->price }}</strong>
</p>

<div class="mb-4 text-sm text-gray-600">
Send payment to:

<div class="mt-2 p-3 bg-gray-100 rounded">
UPI ID: <strong>infinity26032000-1@okhdfcbank</strong>
</div>

</div>
<div class="text-center mb-4">

<img 
src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=infinity26032000-1@okhdfcbank&pn=InvoiceSaaS&am={{ $plan->price }}"
class="mx-auto"
/>

<p class="text-sm text-gray-500 mt-2">
Scan to Pay
</p>

</div>

<div class="space-y-4">

<a 
href="upi://pay?pa=infinity26032000-1@okhdfcbank&pn=InvoiceSaaS&am={{ $plan->price }}"
class="block w-full text-center bg-blue-600 text-white py-2 rounded"
>
Pay via UPI
</a>

<form method="POST" action="{{ route('payment.confirm') }}">
@csrf

<input type="hidden" name="plan_id" value="{{ $plan->id }}">

<input 
type="text" 
name="transaction_id"
placeholder="Enter Transaction ID"
class="w-full border rounded px-3 py-2"
required
>

<button class="w-full bg-green-500 text-white py-2 rounded mt-2">
I have paid
</button>

</form>

</div>

</div>

@endsection