<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Stationery Hub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Toastify CSS and JS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-soft-gray">
        <div>
            @include('components.global.navbar')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            @include('components.global.footer')
        </div>

        <!-- Toastify Notifications -->
        @if(session('success'))
            <script>
                $(document).ready(function() {
                    Toastify({
                        text: '{{ session('success') }}',
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` hoặc `bottom`
                        position: "right", // `left`, `center` hoặc `right`
                        stopOnFocus: true, // Ngăn chặn đóng toast khi hover
                        style: {
                            background: "#D1F8EF", /* mint-green */
                            color: "#1B4B82", /* navy-blue */
                            border: "1px solid #1B4B82"
                        },
                        onClick: function(){} // Callback sau khi click
                    }).showToast();
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                $(document).ready(function() {
                    Toastify({
                        text: '{{ session('error') }}',
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` hoặc `bottom`
                        position: "right", // `left`, `center` hoặc `right`
                        stopOnFocus: true, // Ngăn chặn đóng toast khi hover
                        style: {
                            background: "#CC0000", /* mint-green */
                            color: "#white", /* navy-blue */
                            border: "1px solid #1B4B82"
                        },
                        onClick: function(){} // Callback sau khi click
                    }).showToast();
                });
            </script>
        @endif
    </body>
</html>