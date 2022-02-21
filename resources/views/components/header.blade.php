<div class="w-full z-20 top-0 fixed">
    <header class="bg-white">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center justify-between">
                <div class=" flex gap-5 justify-center items-center w-full text-gray-700 md:text-center text-xl font-semibold">
                    @svg('logo', 'w-16 h-16 ') {{config('app.name')}}
                </div>
                <div class="flex items-center justify-end w-full">
                    <div class="flex sm:hidden">
                        <button @click="isOpen = !isOpen" type="button" class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-label="toggle menu">
                            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @include('layouts.navigation')
    </header>
</div>
