<x-app-layout>
    <div class=" flex items-center justify-between pb-2">
        <h1 class="text-gray-600 font-bold text-2xl">{{trans('dashboard.categories')}}</h1>
        @can('create', \App\Models\Category::class)
        <a href="{{route('categories.create')}}"  class="flex self-center gap-2 font-semibold rounded-2xl px-4 py-1 shadow-md bg-green-500 hover:bg-green-400 ">
            <em class="fas fa-plus-circle self-center"></em> {{trans('users.actions.create')}}
        </a>
        @endcan
    </div>
            <div class="relative m-3 flex flex-wrap gap-4 mx-auto justify-center">
                @foreach($categories as $category)
                <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-2xl p-2 mx-1 my-3 cursor-pointer transform transition duration-500 hover:scale-105">
                    <div class="overflow-x-hidden rounded-2xl relative">
                        <img class="h-40 rounded-2xl w-full object-cover" src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">
                        <div class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-800 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-600 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <em class="fas fa-ellipsis-v"></em>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @can('update', $category)
                                        <x-dropdown-link :href="route('categories.edit', $category)">
                                            {{trans('users.actions.update')}}
                                        </x-dropdown-link>
                                    @endcan
                                    @if(!$category->products->count())
                                        @can('delete', $category)
                                            <x-dropdown-link>
                                                <button @click="$root.$emit('open-modal', {'route': '{{route('categories.destroy', $category)}}'})">
                                                    {{trans('users.actions.delete')}}
                                                </button>
                                            </x-dropdown-link>
                                        @endcan
                                    @endif
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                    <div class="mt-4 pl-2 mb-2 flex justify-between ">
                        <div>
                            <p class="text-lg font-semibold text-gray-900 mb-0">{{$category->name}}</p>
                        </div>
                        <div class="flex mr-4 group cursor-pointer">
                            <a href="{{route('categories.show', $category)}}" class="flex self-center" title="{{trans('users.actions.show') . ' ' .$category->products->count() . ' ' . trans('categories.products')}}">
                                <em class="w-6 group-hover:opacity-70 far fa-eye text-gray-600"></em>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $categories->onEachSide(5)->links() }}
    <x-delete-modal description="{{trans('categories.sure_delete_description')}}" />
</x-app-layout>