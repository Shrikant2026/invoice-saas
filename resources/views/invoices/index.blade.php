@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-semibold">Invoices</h2>

    <a href="{{ route('invoices.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Create Invoice
    </a>
</div>

<div class="grid gap-4">
@foreach($invoices as $invoice)
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between">
            <div>
                <p class="font-semibold">{{ $invoice->invoice_number }}</p>
                <p class="text-sm text-gray-500">
                    {{ $invoice->client->name }}
                </p>
            </div>

            <p class="font-bold text-green-600">₹{{ $invoice->total }}</p>
        </div>

        <div class="mt-2">
            <a href="{{ route('invoices.show', $invoice->id) }}" 
               class="text-blue-500 hover:underline text-sm">
                View Details
            </a>
        </div>
    </div>
@endforeach
</div>

@endsection