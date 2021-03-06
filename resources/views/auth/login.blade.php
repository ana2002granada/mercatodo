
<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-7">
                <x-label for="email" :value="trans('register.email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mb-7">
                <x-label for="password" :value="trans('register.password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ trans('register.remember') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-center mt-12 mb-10">
                <x-button >
                   {{ trans('dashboard.login') }}
                </x-button>
            </div>
        </form>
            <div class="flex items-end m-3 mt-5 mb-10">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 mr-14" href="{{ route('password.request') }}">
                        {{ trans('dashboard.recoverPassword') }}
                    </a>
                @endif

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ trans('dashboard.noRegister') }}
                </a>
            </div>
    </x-auth-card>
</x-guest-layout>
