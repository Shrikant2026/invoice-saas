<!DOCTYPE html>
<html>
<head>
    <title>Invoice SaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

@auth
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col justify-between h-screen fixed">

        <!-- Top Section -->
        <div>
            <h1 class="text-xl font-bold text-blue-400 p-6">Invoice SaaS</h1>

            <nav class="flex flex-col gap-3 px-4">

                <a href="/dashboard"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    🏠 <span>Dashboard</span>
                </a>

                <a href="/clients"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    👥 <span>Clients</span>
                </a>

                <a href="/invoices"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    📄 <span>Invoices</span>
                </a>

            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="p-4">
            <form method="POST" action="/logout">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64">

        <!-- Scrolling Banner -->
        <div class="bg-blue-600 text-white py-2 px-6 text-sm font-medium">

            <div id="banner-message" class="transition-all duration-500">
                🚀 Manage your clients efficiently
            </div>

        </div>

        <!-- Content -->
        <div class="p-6">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </div>
    </div>

</div>
@endauth

@guest
<div class="h-screen overflow-y-auto p-6">
    @yield('content')
</div>
@endguest

</body>
</html>