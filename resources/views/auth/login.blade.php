<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mật khẩu')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ghi nhớ tôi') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-auth.primary-button>
                    {{ __('Đăng nhập') }}
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
                Đăng nhập bằng Google
            </a>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
            @endif

            <div>
                <p class="text-sm text-gray-600">
                    {{ __('Chưa có tài khoản?') }}
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Đăng ký') }}
                    </a>    
                </p>
            </div>
        </div>
    </form>
    
    
</x-guest-layout>
