@extends('layouts.guest')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600">

    <div class="w-full max-w-md p-8 rounded-2xl 
                bg-white/10 backdrop-blur-lg 
                shadow-2xl border border-white/20">

        <h2 class="text-2xl font-semibold text-white text-center mb-2">
            Welcome Back
        </h2>

        <p class="text-center text-gray-200 mb-6">
            Sign in to your account
        </p>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="bg-red-500/20 text-red-200 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

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

            <!-- Remember + Forgot -->
            <div class="flex justify-between items-center text-sm text-gray-200">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-blue-500">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-300 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full py-3 rounded-lg 
                       bg-gradient-to-r from-blue-500 to-teal-400
                       text-white font-semibold hover:opacity-90 transition">
                Sign In
            </button>
        </form>
        <!-- Divider -->
        <div class="text-center text-gray-300 my-5">
            or continue with
        </div>

        <!-- Social Buttons -->
        <div class="flex gap-4">

            <a href="{{ url('/auth/google') }}"
            class="w-1/2 py-2 rounded-lg bg-white/20 text-white flex items-center justify-center gap-2 hover:bg-white/30 transition">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
                Google
            </a>

            <a href="{{ url('/auth/github') }}"
            class="w-1/2 py-2 rounded-lg bg-white/20 text-white flex items-center justify-center gap-2 hover:bg-white/30 transition">
                <img src="https://www.svgrepo.com/show/512317/github-142.svg" class="w-5 h-5">
                GitHub
            </a>

        </div>
        <!-- Register -->
        <p class="text-center text-gray-300 mt-6 text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-300 hover:underline">
                Sign up
            </a>
        </p>

    </div>
</div>

@endsection