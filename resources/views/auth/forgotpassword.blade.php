<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - Stationery Hub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-soft-gray flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-96">
        <h2 class="text-navy text-3xl font-bold text-center mb-6">Quên Mật Khẩu</h2>
        <p class="text-gray-600 text-center mb-6">
            Vui lòng nhập email đã đăng ký để nhận hướng dẫn đặt lại mật khẩu.
        </p>

        <!-- Form nhập email -->
        <form action="{{ route('forgotpassword') }}" method="POST">
            @csrf

            <!-- Email -->
            <x-auth.textfield id="email" name="email" label="Email" type="email" />

            <!-- Nút gửi yêu cầu -->
            <x-auth.button text="Gửi Yêu Cầu" />

        </form>

        <!-- Quay lại đăng nhập -->
        <p class="text-center text-gray-600 mt-4">
            Nhớ mật khẩu? 
            <a href="{{ route('login') }}" class="text-medium-blue hover:underline">Đăng nhập</a>
        </p>
    </div>

</body>
</html>
