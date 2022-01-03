<x-guest-layout>
    <x-auth-card>


        <div class="mb-4 text-sm text-gray-600">
            {{trans('auth.secured')}}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="trans('passwords.password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ trans('dashboard.confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
