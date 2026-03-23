@extends('layouts.app')

@section('title', 'Add Client')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-semibold mb-6 text-gray-800">Add New Client</h2>

    {{-- Global Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none
                @error('name') border-red-500 @enderror"
                placeholder="Enter client name">

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none
                @error('email') border-red-500 @enderror"
                placeholder="Enter email">

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Phone Number</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none
                @error('phone') border-red-500 @enderror"
                placeholder="Enter phone number">

            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Organization -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Organization</label>
            <input type="text" name="organization" value="{{ old('organization') }}"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none
                @error('organization') border-red-500 @enderror"
                placeholder="Company name">

            @error('organization')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Avatar -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Profile Image</label>
            <input type="file" name="avatar"
                class="w-full border rounded-lg px-3 py-2 bg-gray-50
                @error('avatar') border-red-500 @enderror">

            @error('avatar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('clients.index') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                Cancel
            </a>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Save Client
            </button>
        </div>

    </form>

</div>

@endsection