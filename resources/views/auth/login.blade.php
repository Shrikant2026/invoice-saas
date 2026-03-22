@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

    @if ($errors->any())
        <div class="text-red-500 mb-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <input type="email" name="email" placeholder="Email"
            class="w-full border p-2 rounded" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full border p-2 rounded" required>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Login
        </button>
    </form>

    <p class="mt-4 text-center text-sm">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-blue-500">Register</a>
    </p>
</div>

@endsection