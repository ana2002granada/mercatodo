<x-app-layout>
    <div class="flex justify-between content-center py-5 shadow-md bg-white p-4 rounded-xl">
        <div class="flex content-center gap-6">
            <div class="flex-shrink-0 w-24 h-24">
                <img class="w-full h-full rounded-full"
                     src="{{$user->image()}}"
                     alt="{{ $user->fullname() }}" />
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl text-gray-900 ">
                    {{ $user->fullname() }}
                </h1>
                <h2 class="text-sm text-gray-700">
                    {{ $user->email }}
                </h2>
                <h2 class="text-sm text-gray-700">
                    {{ $user->phone_number }}
                </h2>
            </div>
        </div>
        <div class="flex gap-3">
            @can('viewAny',$user)
                <a href="{{route('users.index')}}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
                    <em class="fas fa-arrow-circle-left flex self-center"></em> {{trans('dashboard.back')}}
                </a>
            @endcan
            @can('update',$user)
                <a href="{{route('users.edit',$user)}}"  class="flex self-center gap-2 font-semibold rounded-2xl px-4 py-1 shadow-md bg-green-500 hover:bg-green-400 ">
                    <em class="fas fa-edit flex self-center"></em> {{trans('users.actions.edit')}}
                </a>
            @endcan
        </div>
    </div>
    <div class="shadow-md flex py-5 justify-between grid grid-cols-2 gap-3 bg-white p-4 rounded-xl mt-4">
        <h3 class="text-xl text-gray-700">
            <b>{{trans('users.info.verified_at')}}:</b> {{ $user->email_verified_at }}
        </h3>
        <h3 class="text-xl text-gray-700">
            <b>{{trans('users.info.updated_at')}}:</b> {{ $user->updated_at }}
        </h3>
        <h3 class="text-xl text-gray-700">
            <b>{{trans('users.info.created_at')}}:</b> {{ $user->created_at }}
        </h3>

        @if($user->disabled_at !== null)
            <h3 class="text-xl text-gray-700">
                <b class="text-red-800">{{trans('users.info.disabled_at')}}:</b> {{ $user->disabled_at }}
            </h3>
        @endif
    </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal bg-white">
                    <thead>
                    <tr class="bg-gray-200 border-b-2 border-gray-300 text-left text-xs text-gray-600 uppercase ">
                        <th scope="col" class="px-5 py-3">
                            <h2 class="text-gray-600 font-bold">{{trans('users.info.roles')}}</h2>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->roles as $role)
                        <tr class="hover:bg-gray-200">
                            <td class="px-5 py-5 border-b border-gray-300 text-sm">{{ $role->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</x-app-layout>
