<x-app-layout>
    <form action="{{ route('admin.products.export') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex items-center justify-center">
        <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            <a href="{{App\Models\Product::indexRoute()}}" class="ml-4 mt-4 w-28 bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
                <em class="fas fa-arrow-circle-left flex self-center"></em> Atras
            </a>
            <div class="flex justify-center pb-4">
                <div class="flex bg-purple-200 rounded-full align-middle justify-center p-4 border-2 border-purple-300">
                    <em class="text-white fas fa-download fa-2x"></em>
                </div>
            </div>

            <div class="flex justify-center">
            <div class="flex">
                <h1 class="text-gray-600 font-bold md:text-2xl text-xl">{{ trans('products.export.products') }}</h1>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light col-span-2 font-semibold">{{ trans('products.price') }}</label>
            <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number" min="0" name="start_price" placeholder="{{ trans('products.start_price') }}">
            <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number" min="0" name="end_price" placeholder="{{ trans('products.end_price') }}">
        </div>
        <div class="grid grid-cols-2 gap-4 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light col-span-2 font-semibold">{{ trans('products.stock') }}</label>
            <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number" min="0" name="start_stock" placeholder="{{ trans('products.export.start_stock') }}">
            <input class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number" min="0" name="end_stock" placeholder="{{ trans('products.export.end_stock') }}">
        </div>
        <div class="grid grid-cols-1 mt-5 mx-7">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">{{ trans('categories.category') }}</label>
            <select class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" name="category_id">
                <option value="">{{ trans('products.export.all_categories') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                @endforeach
            </select>
        </div>

    <div class="flex items-center justify-end mt-4">
        <x-button type="submit" class="mr-4">
            {{ trans('products.export.export') }}
        </x-button>
    </div>
        </div>
    </div>

</form>
</x-app-layout>
