<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-3" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-2 gap-6 gap-y-8">
                <div>
                    <x-label for="name" :value="trans('register.name')" />

                    <x-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>
                <div>
                    <x-label for="last_name" :value="trans('register.lastname')" />

                    <x-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                </div>

                <div>
                    <x-label for="email" :value="trans('register.email')" />

                    <x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <div>
                    <x-label for="phone_number" :value="trans('register.phone')" />

                    <x-input id="phone_number" class="block w-full" type="text" name="phone_number" :value="old('phone_number')" required />
                </div>

                <div >
                    <x-label for="password" :value="trans('register.password')" />

                    <x-input id="password" class="block w-full"
                             type="password"
                             name="password"
                             required autocomplete="new-password" />
                </div>

                <div >
                    <x-label for="password_confirmation" :value="trans('register.confirm_password')" />

                    <x-input id="password_confirmation" class="block w-full"
                             type="password"
                             name="password_confirmation" required />
                </div>
            </div>
            <div class="flex items-center justify-center mt-7">
                <x-button class="">
                    {{ trans('dashboard.btnRegister') }}
                </x-button>
                </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ trans('dashboard.register') }}
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
