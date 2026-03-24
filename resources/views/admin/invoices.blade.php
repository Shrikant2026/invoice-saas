@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-semibold mb-6">
All Invoices
</h2>

<div class="space-y-4">

@foreach($invoices as $invoice)

<div class="bg-white p-4 rounded-xl shadow">

Invoice #{{ $invoice->id }}

</div>

@endforeach

</div>

@endsection