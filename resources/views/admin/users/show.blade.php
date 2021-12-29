<x-app-layout>
    <div class="flex justify-between content-center">
        <div class="flex content-center gap-6">
            <em class="fas fa-user fa-3x flex self-center"></em>
            <div>
                <h1 class="text-2xl text-gray-900">
                    {{ $user->name }}
                </h1>
                <h2 class="text-sm text-gray-700">
                    {{ $user->email }}
                </h2>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{route('users.index')}}"  class="flex self-center gap-3 font-bold py-1 px-3 rounded text-white text-xs bg-gray-600 hover:bg-gray-400 hover:text-gray-700 ">
                <em class="fas fa-arrow-circle-left flex self-center"></em> Atrás
            </a>
            <a href="{{route('users.update',$user)}}"  class="flex self-center gap-3 font-bold py-1 px-3 rounded text-xs bg-green-500 hover:bg-green-400 ">
                <em class="fas fa-edit flex self-center"></em> Editar
            </a>
        </div>
    </div>
</x-app-layout>
