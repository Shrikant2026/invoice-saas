@extends('layouts.guest')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600">

    <div class="w-full max-w-md p-8 rounded-2xl 
                bg-white/10 backdrop-blur-lg 
                shadow-2xl border border-white/20">

        <h2 class="text-2xl font-semibold text-white text-center mb-2">
            Create Account
        </h2>

        <p class="text-center text-gray-200 mb-6">
            Sign up to get started
        </p>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="bg-red-500/20 text-red-200 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <input type="text" name="name" value="{{ old('name') }}"
                placeholder="Full Name"
                class="w-full px-4 py-3 rounded-lg 
                       bg-white/20 text-white placeholder-gray-300
                       focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <!-- Email -->
            <input type="email" name="email" value="{{ old('email') }}"
                placeholder="Email Address"
                class="w-full px-4 py-3 rounded-lg 
                       bg-white/20 text-white placeholder-gray-300
                       focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <!-- Password -->
            <input type="password" name="password"
                placeholder="Password"
                class="w-full px-4 py-3 rounded-lg 
                       bg-white/20 text-white placeholder-gray-300
                       focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <!-- Confirm Password -->
            <input type="password" name="password_confirmation"
                placeholder="Confirm Password"
                class="w-full px-4 py-3 rounded-lg 
                       bg-white/20 text-white placeholder-gray-300
                       focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <!-- Button -->
            <button type="submit"
                class="w-full py-3 rounded-lg 
                       bg-gradient-to-r from-green-500 to-emerald-400
                       text-white font-semibold hover:opacity-90 transition">
                Register
            </button>
        </form>

        <!-- Login -->
        <p class="text-center text-gray-300 mt-6 text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-300 hover:underline">
                Login
            </a>
        </p>

    </div>
</div>

@endsection