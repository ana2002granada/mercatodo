<x-app-layout>
    <form action="{{ route('users.update',$user) }}">
    @csrf

    <!-- Name -->
        <div>
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{__('dashboard.btnUpdate')}}
            </x-button>
        </div>
    </form>
</x-app-layout>
