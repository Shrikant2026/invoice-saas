<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Invoice SaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

@auth
<!-- Mobile Header -->
<div class="md:hidden bg-gray-900 text-white p-4 flex justify-between items-center">
    <h1 class="text-lg font-bold">Invoice SaaS</h1>

    <button onclick="toggleSidebar()" class="text-2xl">
        ☰
    </button>
</div>

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="w-64 bg-gray-900 text-white flex flex-col justify-between
        h-screen fixed md:relative md:translate-x-0
        transform -translate-x-full md:transform-none
        transition-transform duration-200 z-50 overflow-y-auto">

        <!-- Top Section -->
        <div>

            <h1 class="text-xl font-bold text-blue-400 p-6">Invoice SaaS</h1>

            @php
            $user = auth()->user();
            $subscription = $user->subscription;
            @endphp

            <!-- Profile Box -->
            <div class="px-4 pb-4">
                <div class="bg-gray-800 p-4 rounded-xl">

                    <!-- Avatar -->
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="text-sm font-semibold">
                                {{ $user->name }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ ucfirst($user->role) }}
                            </p>
                        </div>
                    </div>

                    <!-- Plan Info -->
                    @if($subscription && $subscription->plan)

                    <div class="text-xs text-gray-300 space-y-1">
                        <p>
                            Plan: 
                            <span class="text-blue-400 font-medium">
                                {{ $subscription->plan->name }}
                            </span>
                        </p>

                        @php
                        $invoiceCount = $user->invoices()->count();

                        $remaining = $subscription->plan->invoice_limit
                            ? $subscription->plan->invoice_limit - $invoiceCount
                            : 'Unlimited';
                        @endphp

                        <p>
                            Invoices: {{ $remaining }}
                        </p>
                    </div>

                    @endif

                </div>
            </div>


            <nav class="flex flex-col gap-3 px-4">

                {{-- USER SECTION --}}
                <div class="px-2 text-xs text-gray-400 mt-2">
                    USER
                </div>

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

                <a href="{{ route('pricing') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    💰 <span>Pricing</span>
                </a>


                {{-- ADMIN SECTION --}}
                @if(auth()->user()->role == 'admin')

                <div class="px-2 text-xs text-gray-400 mt-6">
                    ADMIN PANEL
                </div>

                <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    ⚙️ <span>Admin Dashboard</span>
                </a>

                <a href="{{ route('admin.users') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    👤 <span>Users</span>
                </a>

                <a href="{{ route('admin.invoices') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    📊 <span>All Invoices</span>
                </a>

                <a href="{{ route('admin.payments') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    💳 <span>Payments</span>
                </a>

                @endif

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
    <div class="flex-1  md:ml-0">

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
<script>
function toggleSidebar() {
    document.getElementById('sidebar')
    .classList.toggle('-translate-x-full');
}
</script>
</body>
</html>