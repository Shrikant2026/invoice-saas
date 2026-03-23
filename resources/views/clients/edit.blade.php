@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-semibold mb-6 text-gray-800">Edit Client</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $client->name) }}"
                class="w-full border rounded-lg px-4 py-2 @error('name') border-red-500 @enderror">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $client->email) }}"
                class="w-full border rounded-lg px-4 py-2 @error('email') border-red-500 @enderror">
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $client->phone) }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Organization -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Organization</label>
            <input type="text" name="organization" value="{{ old('organization', $client->organization) }}"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Current Avatar -->
        @if($client->avatar)
            <div>
                <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                <img src="{{ asset('storage/' . $client->avatar) }}" class="w-16 h-16 rounded-full">
            </div>
        @endif

        <!-- Upload New Avatar -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Change Image</label>
            <input type="file" name="avatar" class="w-full border rounded-lg px-3 py-2">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('clients.index') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                Cancel
            </a>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Update Client
            </button>
        </div>

    </form>

</div>

@endsection