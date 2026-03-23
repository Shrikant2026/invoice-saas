@extends('layouts.app')

@section('title', 'Invoices')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Invoices</h2>

    <a href="{{ route('invoices.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
        + Create Invoice
    </a>
</div>

<div class="space-y-4">

@forelse($invoices as $invoice)

    <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition flex justify-between items-center">

        <!-- Left Section -->
        <div class="flex flex-col gap-1">

            <!-- Invoice Number -->
            <p class="font-semibold text-gray-800">
                {{ $invoice->invoice_number }}
            </p>

            <!-- Client Name -->
            <p class="text-sm text-gray-500">
                {{ $invoice->client->name }}
            </p>

            <!-- View Details -->
            <a href="{{ route('invoices.show', $invoice->id) }}" 
               class="text-blue-500 text-sm hover:underline mt-1">
                View Details →
            </a>

        </div>

        <!-- Right Section -->
        <div class="text-right">

            <!-- Amount -->
            <p class="text-lg font-bold text-green-600">
                ₹{{ number_format($invoice->total, 2) }}
            </p>

        </div>

    </div>

@empty

    <div class="bg-white p-6 rounded-xl text-center text-gray-500">
        No invoices found. Create your first invoice 🚀
    </div>

@endforelse

</div>

@endsection