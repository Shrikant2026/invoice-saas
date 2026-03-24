<h2 class="text-2xl font-semibold mb-6">Choose Your Plan</h2>

<div class="grid grid-cols-3 gap-6">

@foreach($plans as $plan)

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="text-lg font-semibold">
{{ $plan->name }}
</h3>

<p class="text-2xl font-bold my-2">
₹{{ $plan->price }}
</p>

<p class="text-gray-500 mb-4">
{{ $plan->invoice_limit ?? 'Unlimited' }} invoices
</p>

@if(auth()->user()->subscription->plan_id == $plan->id)

<button 
class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg cursor-not-allowed">
Current Plan
</button>

@else

<form method="GET" action="{{ route('payment.page', $plan->id) }}">
    <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
    Upgrade
    </button>
</form>

</form>

@endif

</div>

@endforeach

</div>