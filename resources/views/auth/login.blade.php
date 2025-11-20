<x-login-page-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />

            <x-text-input id="email"
                            class="block mt-1 w-full"
                            type="email"
                            name="email" :value="old('email')"
                            placeholder="example@example.com"
                            required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <div class="flex justify-between items-center">
                <x-input-label for="password" :value="__('Password')" />

                @if (Route::has('password.request'))
                    <a class="flex underline text-sm text-gray-600 hover:text-[#ff3c3c] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">

                <input id="remember_me"
                        type="checkbox"
                        class="rounded border-black text-[#357DFF] shadow-sm focus:ring-indigo-500"
                        name="remember">
                <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>

            </label>
        </div>

        <div class="mt-6">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="flex justify-center mt-4 text-sm text-black">
            <span>Don't have an account?</span>
            <a href="{{ route('register') }}" class="ms-1 underline text-[#357DFF] hover:text-[#ff3c3c]">
                {{ __('Join Now For Free') }}
            </a>
        </div>

    </form>
</x-login-page-layout>
