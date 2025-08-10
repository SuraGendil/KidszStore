<x-guest-layout>
    {{-- Logo dan container utama sekarang ada di guest.blade.php, jadi kita hanya perlu judul di sini. --}}
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white">Masuk ke Kidszstore</h2>
        <p class="text-sm text-gray-300 mt-1">Silakan login untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg bg-gray-900/50 border-blue-400/30 text-white focus:border-blue-400 focus:ring-blue-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300 font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg bg-gray-900/50 border-blue-400/30 text-white focus:border-blue-400 focus:ring-blue-400" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-500 shadow-sm focus:ring-blue-500 bg-gray-900/50" name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-400 hover:text-blue-300 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center text-sm text-gray-300">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 hover:underline font-semibold">Daftar</a>
    </div>
</x-guest-layout>
