<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Market12')</title>

    {{-- Asset global --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @yield('content')

    {{-- JS khusus halaman --}}
    @stack('scripts')
</body>
</html>
