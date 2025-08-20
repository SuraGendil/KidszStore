<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white">Daftar Akun Baru</h2>
        <p class="text-sm text-gray-300 mt-1">Buat akun untuk mulai berbelanja</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-300 font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg bg-gray-900/50 border-blue-400/30 text-white focus:border-blue-400 focus:ring-blue-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg bg-gray-900/50 border-blue-400/30 text-white focus:border-blue-400 focus:ring-blue-400" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone" value="Nomor Telepon" class="text-gray-300 font-semibold" />
            <x-text-input id="phone" class="block mt-1 w-full rounded-lg bg-gray-900/50 border-blue-400/30 text-white focus:border-blue-400 focus:ring-blue-400" type="text" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300 font-semibold" />

            <x-text-input id="password" class="block mt-1 w-full rounded-lg bg-gray-900/50 border-blue-400/30 text-white focus:border-blue-400 focus:ring-blue-400"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300 font-semibold" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg bg-gray-900/50 border-blue-400/30 text-white focus:border-blue-400 focus:ring-blue-400"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end pt-2">
            <a class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
