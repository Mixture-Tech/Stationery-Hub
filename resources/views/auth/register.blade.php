<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Họ và tên')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mật khẩu')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Nhập lại mật khẩu')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-end mt-4">
            <x-auth.primary-button class="mb-4">
                {{ __('Đăng ký') }}
            </x-auth.primary-button>
        </div>

        <div class="relative flex items-center justify-center mt-4">
            <div class="absolute border-t border-gray-300 w-1/2"></div>
            <div class="px-4 bg-white relative text-sm text-gray-500">
                Or
            </div>
        </div>

        <div class="flex items-center justify-center mt-4">
            <a href="{{ route('auth.google') }}" class="inline-flex items-center px-4 py-2 bg-white border
             border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest
             focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500
               transition ease-in-out duration-150 hover:bg-indigo-300">
                <img src="https://www.google.com/favicon.ico" alt="Google Logo" class="w-4 h-4 mr-2">
                Đăng ký bằng Google
            </a>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Đã có tài khoản?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
