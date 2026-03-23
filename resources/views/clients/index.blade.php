@extends('layouts.app')

@section('title', 'Clients')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Clients</h2>

    <a href="{{ route('clients.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
        + Add Client
    </a>
</div>

<!-- Clients List -->
<div class="space-y-4">

    @forelse($clients as $client)

        <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition flex justify-between items-center">

            <!-- Left: Client Info -->
            <div class="flex items-center gap-4">

                <!-- Avatar -->
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                    {{ strtoupper(substr($client->name, 0, 1)) }}
                </div>

                <!-- Details -->
                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $client->name }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $client->email }}
                    </p>
                </div>

            </div>

            <!-- Right: Actions -->
            <div class="flex items-center gap-4">

                <!-- Edit -->
                <a href="{{ route('clients.edit', $client->id) }}"
                   class="text-blue-500 hover:underline text-sm">
                    Edit
                </a>

                <!-- Delete -->
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-500 hover:underline text-sm">
                        Delete
                    </button>
                </form>

            </div>

        </div>

    @empty

        <div class="bg-white p-6 rounded-xl text-center text-gray-500">
            No clients found. Add your first client 🚀
        </div>

    @endforelse

</div>

@endsection