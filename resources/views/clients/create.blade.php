@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Add Client</h2>

@if ($errors->any())
    <div class="text-red-500 mb-3">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('clients.store') }}" class="space-y-4">
    @csrf

    <input type="text" name="name" placeholder="Name" class="w-full p-2 border rounded" required>
    <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded">

    <button class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
</form>

@endsection