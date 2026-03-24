@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<h2 class="text-2xl font-semibold mb-6">
Admin Dashboard
</h2>

<div class="grid grid-cols-3 gap-6">

<div class="bg-white p-6 rounded-xl shadow-sm">
    <p class="text-gray-500">Total Users</p>
    <h3 class="text-2xl font-bold">
        {{ $totalUsers }}
    </h3>
</div>

<div class="bg-white p-6 rounded-xl shadow-sm">
    <p class="text-gray-500">Total Invoices</p>
    <h3 class="text-2xl font-bold">
        {{ $totalInvoices }}
    </h3>
</div>

<div class="bg-white p-6 rounded-xl shadow-sm">
    <p class="text-gray-500">Subscriptions</p>
    <h3 class="text-2xl font-bold">
        {{ $totalSubscriptions }}
    </h3>
</div>

</div>

@endsection