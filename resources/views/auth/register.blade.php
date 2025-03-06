<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Stationery Hub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-soft-gray flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold text-navy text-center mb-6">Đăng ký tài khoản</h2>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Họ và tên -->
            <x-auth.textfield id="name" name="name" label="Họ và tên" type="text" />

            <!-- Email -->
            <x-auth.textfield id="email" name="email" label="Email" type="email" />

            <!-- Số điện thoại -->
            <x-auth.textfield id="phone" name="phone" label="Số điện thoại" type="tel" />

            <!-- Mật khẩu -->
            <x-auth.textfield id="password" name="password" label="Mật khẩu" type="password" />

            <!-- Nút đăng ký -->
            <x-auth.button text="Đăng ký" />

        </form>

        <!-- Chuyển hướng đến trang đăng nhập -->
        <p class="text-center text-gray-600 mt-4">
            Đã có tài khoản? 
            <a href="{{ route('login') }}" class="text-medium-blue hover:underline">Đăng nhập</a>
        </p>
    </div>

</body>
</html>
