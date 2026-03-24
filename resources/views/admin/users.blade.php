@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">
        Users
    </h2>
</div>

<div class="space-y-4">

@foreach($users as $user)

<div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition flex justify-between items-center">

<!-- User Info -->
<div>
<p class="font-semibold text-gray-800">
{{ $user->name }}
</p>

<p class="text-sm text-gray-500">
{{ $user->email }}
</p>
</div>

<!-- Plan Management -->
<div class="flex items-center gap-4">

<!-- Current Plan Badge -->
<span class="text-sm bg-gray-100 px-3 py-1 rounded font-medium">
{{ $user->subscription->plan->name ?? 'Free' }}
</span>

<!-- Plan Dropdown -->
<form 
action="{{ route('admin.user.plan', $user->id) }}" 
method="POST"
class="flex items-center gap-2"
>

@csrf

<select 
name="plan_id"
class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
>

@foreach($plans as $plan)

<option 
value="{{ $plan->id }}"
@if(optional($user->subscription)->plan_id == $plan->id) selected @endif
>
{{ $plan->name }}

</option>

@endforeach

</select>

<button 
class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm transition">
Update
</button>

</form>

</div>

</div>

@endforeach

</div>

@endsection