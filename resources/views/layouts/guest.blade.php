<!DOCTYPE html>
<html>
<head>
    <title>Invoice SaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">
        @yield('content')
    </div>

</body>
</html>