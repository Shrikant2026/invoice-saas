@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-semibold">Clients</h2>

    <a href="{{ route('clients.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Client
    </a>
</div>

<div class="grid gap-4">
@foreach($clients as $client)
    <div class="bg-white p-4 rounded shadow flex justify-between items-center">
        <div>
            <p class="font-semibold">{{ $client->name }}</p>
            <p class="text-gray-500 text-sm">{{ $client->email }}</p>
        </div>

        <form method="POST" action="{{ route('clients.destroy', $client->id) }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500 hover:underline">Delete</button>
        </form>
    </div>
@endforeach
</div>

@endsection