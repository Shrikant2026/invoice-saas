<!DOCTYPE html>
<html>
<head>
    <title>Invoice SaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

<nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">Invoice SaaS</h1>

    <div class="flex items-center gap-4">
        <a href="/dashboard" class="hover:text-blue-500">Dashboard</a>
        <a href="/clients" class="hover:text-blue-500">Clients</a>
        <a href="/invoices" class="hover:text-blue-500">Invoices</a>

        <form method="POST" action="/logout">
            @csrf
            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="max-w-6xl mx-auto mt-6 p-4">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</div>

</body>
</html>