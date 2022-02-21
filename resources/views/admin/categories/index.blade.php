<x-app-layout>
    <div class=" flex items-center justify-between pb-2">
        <h1 class="text-gray-700 font-semibold text-2xl font-medium">{{trans('dashboard.categories')}}</h1>
        @can('create', \App\Models\Category::class)
        <a href="{{App\Models\Category::createRoute()}}"  class="flex self-center gap-2 font-semibold rounded-2xl px-4 py-1 shadow-md bg-green-500 hover:bg-green-400 ">
            <em class="fas fa-plus-circle self-center"></em> {{trans('users.actions.create')}}
        </a>
        @endcan
    </div>
    <div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                @if($categories)
                <table class="bg-white min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-200 border-b-2 border-gray-300 text-left text-xs text-gray-600 uppercase ">
                            <th scope="col" class="px-5 py-3">{{trans('register.name')}}</th>
                            <th scope="col" class="px-5 py-3">{{trans('users.info.status')}}</th>
                            <th scope="col" class="px-5 py-3 flex items-center justify-center">{{trans('categories.products')}}</th>
                            <th scope="col" class="px-5 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                 src="{{$category->image_route}}"
                                                 alt=" {{ $category->name }}" />
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $category->name }}
                                            </p>
                                        </div>
                                    </div>

                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    @if($category->disabled_at === null)
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">{{trans('users.actions.active')}}</span>
                                    @else
                                        <span aria-hidden class="absolute inset-0 bg-red-400 opacity-50 rounded-full"></span>
                                        <span class="relative">{{trans('users.actions.inactive')}}</span>
                                    @endif
									</span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex items-center justify-center">
                                         <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                            <span aria-hidden class="absolute inset-0 bg-gray-400 opacity-50 rounded-full"></span>
                                            <span class="relative"> {{ $category->products_count }} </span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex sm:items-center sm:ml-6 justify-end pr-2">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button class="flex items-center text-sm font-medium text-gray-800 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-600 focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <em class="fas fa-ellipsis-v"></em>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                @can('view', $category)
                                                    <x-dropdown-link :href="$category->showRoute()">
                                                        {{trans('users.actions.more')}}
                                                    </x-dropdown-link>
                                                @endcan
                                                @can('update', $category)
                                                    <x-dropdown-link :href="$category->editRoute()">
                                                        {{trans('users.actions.update')}}
                                                    </x-dropdown-link>
                                                @endcan
                                                @can('toggle', $category)
                                                    <x-dropdown-link>
                                                        <form action="{{ $category->toggleRoute() }}" method="POST">
                                                            @csrf
                                                            <button type='submit'>{{$category->disabled_at ? trans('users.actions.enable') : trans('users.actions.disable')}}</button>
                                                        </form>
                                                    </x-dropdown-link>
                                                @endcan
                                                @can('delete', $category)
                                                    <x-dropdown-link>
                                                        <button @if($category->products_count) disabled class="text-gray-400 cursor-default" @endif @click="$root.$emit('open-modal', {'route': '{{$category->deleteRoute()}}'})">
                                                            {{trans('users.actions.delete')}}
                                                        </button>
                                                    </x-dropdown-link>
                                                @endcan
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->onEachSide(5)->links() }}
                @else
                    <div class="bg-white shadow-md rounded-2xl p-14  ">
                        <h2 class="text-gray-600 flex self-center justify-center font-bold text-2xl col-span-2">{{trans('categories.void.voidCategory')}}</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-delete-modal description="{{trans('categories.sure_delete_description')}}" />
</x-app-layout>


