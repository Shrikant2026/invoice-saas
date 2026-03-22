@extends('layouts.guest')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Name"
            class="w-full border p-2 rounded" required>

        <input type="email" name="email" placeholder="Email"
            class="w-full border p-2 rounded" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full border p-2 rounded" required>

        <input type="password" name="password_confirmation" placeholder="Confirm Password"
            class="w-full border p-2 rounded" required>

        <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Register
        </button>
    </form>

    <p class="mt-4 text-center text-sm">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-500">Login</a>
    </p>
</div>

@endsection