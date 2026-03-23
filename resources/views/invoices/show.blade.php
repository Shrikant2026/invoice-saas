@extends('layouts.app')

@section('title', 'Invoice Details')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Invoice {{ $invoice->invoice_number }}
            </h2>
            <p class="text-sm text-gray-500">
                Client: {{ $invoice->client->name }}
            </p>
        </div>

        <a href="{{ route('invoices.pdf', $invoice->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Download PDF
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">

            <thead>
                <tr class="bg-gray-100 text-left text-sm text-gray-600">
                    <th class="p-3">Item</th>
                    <th class="p-3">Qty</th>
                    <th class="p-3">Price</th>
                    <th class="p-3 text-right">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($invoice->items as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $item->item_name }}</td>
                    <td class="p-3">{{ $item->quantity }}</td>
                    <td class="p-3">₹{{ number_format($item->price, 2) }}</td>
                    <td class="p-3 text-right font-medium">
                        ₹{{ number_format($item->total, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!-- Total -->
    <div class="flex justify-end mt-6">
        <div class="bg-gray-100 px-6 py-4 rounded-lg text-right">
            <p class="text-sm text-gray-500">Total Amount</p>
            <p class="text-xl font-bold text-green-600">
                ₹{{ number_format($invoice->total, 2) }}
            </p>
        </div>
    </div>

</div>

@endsection