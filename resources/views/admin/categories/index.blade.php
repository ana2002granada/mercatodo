<x-app-layout>
    <div class=" flex items-center justify-between pb-2">
        <h1 class="text-gray-600 font-bold text-2xl">{{trans('dashboard.categories')}}</h1>
    </div>
            <div class="relative m-3 flex flex-wrap gap-4 mx-auto justify-center">
                @foreach($categories as $category)
                <div class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-2xl p-2 mx-1 my-3 cursor-pointer transform transition duration-500 hover:scale-105">
                    <div class="overflow-x-hidden rounded-2xl relative">
                        <img class="h-40 rounded-2xl w-full object-cover" src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg">
                        <p class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-50 opacity-70" fill="none" viewBox="0 0 24 24" stroke="black">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </p>
                    </div>
                    <div class="mt-4 pl-2 mb-2 flex justify-between ">
                        <div>
                            <p class="text-lg font-semibold text-gray-900 mb-0">{{$category->name}}</p>
                        </div>
                        <div class="flex flex-col-reverse mb-1 mr-4 group cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-70" fill="none" viewBox="0 0 24 24" stroke="gray">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $categories->onEachSide(5)->links() }}
</x-app-layout>
