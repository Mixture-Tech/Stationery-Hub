<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Hub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    {{-- Navbar --}}
    @include('components.navbar')

    @include('components.header')
    
    {{-- Footer --}}
    @include('components.footer')
</body>
</html>


