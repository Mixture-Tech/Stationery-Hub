<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Thêm Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <style>
        .sidebar {
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }
        .menu-item.active {
            background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 100%);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .menu-item:hover {
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gray-200">
<div class="flex h-screen">
    <div class="w-64 text-white p-6 sidebar">
        <h1 class="text-2xl font-bold flex items-center space-x-2 border-b border-white border-opacity-20 pb-4">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.75H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25h4.5M15 3.75h4.5A2.25 2.25 0 0121.75 6v12a2.25 2.25 0 01-2.25 2.25H15m0-15v15m-5.25-15v15"></path>
            </svg>
            <span>Admin Panel</span>
        </h1>
        <ul class="mt-8 space-y-2">
            <li><a href="{{ route('admin.dashboard') }}" class="menu-item block py-3 px-4 flex items-center space-x-3 cursor-pointer rounded-lg transition-all duration-300">Dashboard</a></li>
            <li><a href="{{ route('admin.products') }}" class="menu-item block py-3 px-4 flex items-center space-x-3 cursor-pointer rounded-lg transition-all duration-300">Products</a></li>
            <li><a href="{{ route('admin.categories') }}" class="menu-item block py-3 px-4 flex items-center space-x-3 cursor-pointer rounded-lg transition-all duration-300">Category</a></li>
            <li><a href="{{ route('admin.categoryparents') }}" class="menu-item block py-3 px-4 flex items-center space-x-3 cursor-pointer rounded-lg transition-all duration-300">Category Parent</a></li>
            <li><a href="{{ route('admin.orders') }}" class="menu-item block py-3 px-4 flex items-center space-x-3 cursor-pointer rounded-lg transition-all duration-300">Orders</a></li>
            <li><a href="{{ route('admin.users') }}" class="menu-item block py-3 px-4 flex items-center space-x-3 cursor-pointer rounded-lg transition-all duration-300">Users</a></li>
        </ul>
    </div>

    <div class="flex-1 overflow-y-auto p-6 bg-gray-50 rounded-lg shadow-md">
        @yield('content')
    </div>
</div>
</body>
</html>