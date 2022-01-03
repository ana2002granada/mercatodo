<x-app-layout>
    <div class="flex justify-between content-center py-5 border-b-2">
        <div class="flex content-center gap-6">
            <div class="flex-shrink-0 w-24 h-24">
                <img class="w-full h-full rounded-full"
                     src="{{$user->image()}}"
                     alt="{{ $user->fullname() }}" />
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl text-gray-900 ">
                    {{trans('users.actions.edit')}}
                </h1>
                <h2 class="text-sm text-gray-700">
                    {{ $user->fullname() }}
                </h2>
            </div>

        </div>
    </div>
    <form action="{{route('users.update', $user)}}" method="POST" class="p-5">
    @csrf
        @method('PATCH')
        <div class="grid grid-cols-2 gap-6 gap-y-8">
            <div>
                <x-label for="name" :value="trans('register.name')" />

                <x-input id="name" class="block w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                @error('name'){{$mesage}}@enderror
            </div>

            <div>
                <x-label for="last_name" :value="trans('register.lastname')" />

                <x-input id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autofocus />
                @error('last_name'){{$mesage}}@enderror
            </div>

            <div>
                <x-label for="email" :value="trans('register.email')" />

                <x-input id="email" class="block w-full" type="email" name="email" :value="old('email', $user->email)" required />
                @error('email'){{$mesage}}@enderror
            </div>
            <div>
                <x-label for="phone_number" :value="trans('register.phone')" />

                <x-input id="phone_number" class="block w-full" type="text" name="phone_number" :value="old('phone_number', $user->phone_number)" required />
                @error('phone_number'){{$mesage}}@enderror
            </div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button type="submit" class="ml-4">
                {{trans('dashboard.btnUpdate')}}
            </x-button>
        </div>
    </form>
</x-app-layout>