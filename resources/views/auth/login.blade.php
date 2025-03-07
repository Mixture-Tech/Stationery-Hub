<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Stationery Hub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-soft-gray flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-96">
        <h2 class="text-navy text-3xl font-bold text-center mb-6">Đăng nhập</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email -->
            <x-auth.textfield id="email" name="email" label="Email" type="email" />

            <!-- Mật khẩu -->
            <x-auth.textfield id="password" name="password" label="Mật khẩu" type="password" />

            <!-- Ghi nhớ -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-navy-blue">
                    <input type="checkbox" name="remember" class="mr-2">
                    Ghi nhớ tôi
                </label>
                <a href="{{ route('forgotpassword') }}" class="text-medium-blue hover:text-dark-blue">Quên mật khẩu?</a>
            </div>

            <!-- Nút đăng nhập -->
            <x-auth.button text="Đăng nhập" />

        </form>

        <!-- Đăng ký -->
        <p class="text-center text-gray-600 mt-4">
            Chưa có tài khoản? 
            <a href="{{ route('register') }}" class="text-medium-blue hover:underline">Đăng ký</a>
        </p>
    </div>

</body>
</html>
