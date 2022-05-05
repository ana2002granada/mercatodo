<x-app-layout>
    <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex items-center justify-center">
        <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            <a href="{{ \App\Models\Import::indexRoute() }}" class="ml-4 mt-4 w-28 bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
                <em class="fas fa-arrow-circle-left flex self-center"></em> {{ trans('dashboard.back') }}
            </a>
            <div class="flex justify-center pb-4">
                <div class="flex bg-purple-200 rounded-full align-middle justify-center p-4 border-2 border-purple-300">
                    <em class="text-white fas fa-download fa-2x"></em>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">{{ trans('products.import.products') }}</h1>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">{{ trans('products.import.file') }}</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group">
                        <div class="flex flex-col items-center justify-center pt-7">
                            <label class="flex flex-col items-center text-gray-400 cursor-pointer hover:text-gray-600">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"></path>
                                </svg>
                            </label>
                            <p class="lowercase text-sm text-gray-400 group-hover:text-gray-600 pt-1 tracking-wider">
                                {{ trans('products.import.select_file') }}</p>
                        </div>
                        <input type="file" accept=".xlsx" name="products" class="hidden">
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button type="submit" class="mr-4">
                    {{trans('products.import.import')}}
                </x-button>
            </div>
        </div>
    </div>
</form>
</x-app-layout>
