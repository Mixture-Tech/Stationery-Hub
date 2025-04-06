@extends('admin.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $totalProducts }}</h3>
                        <p class="text-gray-600">Tổng số Products</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18m-7 5h7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $totalCategories }}</h3>
                        <p class="text-gray-600">Tổng số Categories</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7h18M3 4h18M2 3h20v18H2V3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $totalCategoryParents }}</h3>
                        <p class="text-gray-600">Tổng số Category Parents</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $totalUsers }}</h3>
                        <p class="text-gray-600">Tổng số Users</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thêm biểu đồ -->
        <!-- <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Thống kê tổng quan</h2>
            <canvas id="overviewChart" height="100"></canvas>
        </div> -->
    </div>

    <!-- Script để vẽ biểu đồ -->
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('overviewChart').getContext('2d');
            const overviewChart = new Chart(ctx, {
                type: 'bar', // Loại biểu đồ: cột
                data: {
                    labels: ['Products', 'Categories', 'Category Parents', 'Users'], // Nhãn cho các cột
                    datasets: [{
                        label: 'Số lượng',
                        data: [
                            {{ $totalProducts }}, 
                            {{ $totalCategories }}, 
                            {{ $totalCategoryParents }}, 
                            {{ $totalUsers }}
                        ], // Dữ liệu từ controller
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)',  // Màu cho Products
                            'rgba(75, 192, 192, 0.6)',  // Màu cho Categories
                            'rgba(153, 102, 255, 0.6)', // Màu cho Category Parents
                            'rgba(255, 206, 86, 0.6)'   // Màu cho Users
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true, // Bắt đầu trục Y từ 0
                            title: {
                                display: true,
                                text: 'Số lượng'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Danh mục'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Ẩn chú thích (vì chỉ có 1 dataset)
                        }
                    }
                }
            });
        });
    </script> -->
@endsection