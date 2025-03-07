<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Hub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-soft-gray">
    @include('components.global.navbar')

    @include('components.home.header')

    @include('components.home.sections.categories')

    @include('components.home.sections.shopping-trend')

    @include('components.global.footer')
</body>
</html>


