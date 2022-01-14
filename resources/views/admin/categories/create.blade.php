<x-app-layout>
    <div class="flex justify-between content-center shadow-md py-5 p-4 bg-white rounded-xl">
        <div class="flex content-center gap-6">
            <div class="flex-shrink-0 w-24 h-24">
                <img class="w-full h-full rounded-full"
                     />
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl text-gray-900 ">
                    {{trans('users.actions.create')}}
                </h1>
                <h2 class="text-sm text-gray-700">

                </h2>
            </div>

        </div>
        <a href="{{route('categories.index')}}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
            <em class="fas fa-arrow-circle-left flex self-center"></em> {{trans('dashboard.back')}}
        </a>
    </div>
</x-app-layout>

