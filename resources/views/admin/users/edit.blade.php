<x-app-layout>
    <div class="flex justify-between content-center shadow-md py-5 p-4 bg-white rounded-xl">
        <div class="flex content-center gap-6">
            <div class="flex-shrink-0 w-24 h-24">
                <img class="w-full h-full rounded-full"
                     src="{{ $user->image() }}"
                     alt="{{ $user->fullname() }}" />
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl text-gray-900 ">
                    {{ trans('users.actions.edit') }}
                </h1>
                <h2 class="text-sm text-gray-700">
                    {{ $user->fullname() }}
                </h2>
            </div>

        </div>
        <a href="{{\App\Models\User::indexRoute()}}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
            <em class="fas fa-arrow-circle-left flex self-center"></em> {{ trans('dashboard.back') }}
        </a>
    </div>
    <form action="{{ $user->updateRoute() }}" method="POST" class="p-5 shadow-md  bg-white rounded-xl mt-4">
    @csrf
        @method('PATCH')
        <div class="grid grid-cols-2 gap-6 gap-y-8">
            <div>
                <x-label for="name" :value="trans('register.name')" />

                <x-input id="name" class="block w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />

            </div>

            <div>
                <x-label for="last_name" :value="trans('register.lastname')" />

                <x-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autofocus />

            </div>

            <div>
                <x-label for="email" :value="trans('register.email')" />

                <x-input id="email" class="block w-full" type="email" name="email" :value="old('email', $user->email)" required />

            </div>
            <div>
                <x-label for="phone_number" :value="trans('register.phone')" />

                <x-input id="phone_number" class="block w-full" type="text" name="phone_number" :value="old('phone_number', $user->phone_number)" required />

            </div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button type="submit" class="ml-4">
                {{ trans('dashboard.btnUpdate') }}
            </x-button>
        </div>
    </form>
</x-app-layout>
