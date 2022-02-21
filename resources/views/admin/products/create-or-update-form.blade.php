<div class="flex justify-between content-center shadow-md py-5 p-4 bg-white rounded-xl">
    <div class="flex content-center m-4">
        <h1 class="text-2xl text-gray-900 ">
            {{$title}}
        </h1>
    </div>
    <a href="{{ \App\Models\Product::indexRoute() }}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
        <em class="fas fa-arrow-circle-left flex self-center"></em> {{ trans('dashboard.back') }}
    </a>
</div>

@if($isEdit)
    <div class="flex justify-between content-center shadow-md py-5 p-4 bg-white rounded-xl mt-4">
        <div class="flex content-center gap-6">
            <div class="flex-shrink-0 w-24 h-24">
                <img class="w-full h-full rounded-full"
                     src="{{ $product->image_route }}"
                     alt="{{ $product->name }}" />
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl text-gray-900 ">
                    {{ $product->name }}
                </h1>
            </div>
        </div>
    </div>
@endif
<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="p-5 shadow-md  bg-white rounded-xl mt-4">
    @csrf
    @if($isEdit)
        @method('PATCH')
    @endif
    <div class="grid grid-cols-2 gap-6 gap-y-8 h-full">
        <div>
            <x-label for="category" :value="trans('categories.category')" />

            <v-select name="category"  label="name" :initial="{{ json_encode(['name' => optional($product->category)->name, 'id' => $product->category_id]) }}" :options='@json($categories, true)'/>
            @error('category')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror

        </div>
        <div>
            <x-label for="name" :value="trans('register.name')" />
            <x-input id="name" value="{{ $product->name }}" class="block w-full" type="text" name="name" required />
            @error('name')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror

        </div>
        <div>
            <x-label for="price" :value="trans('products.price')" />
            <x-input id="price" value="{{ $product->price }}" class="block w-full" type="number" min="0" name="price" required />
            @error('price')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror
        </div>
        <div>
            <x-label for="stock" :value="trans('products.stock')" />
            <x-input id="stock" value="{{ $product->stock }}" class="block w-full" type="number" min="0" name="stock" required />
            @error('stock')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror
        </div>
        <div>
            <x-label for="description" :value="trans('products.description')" />
            <textarea id="description" maxlength="255" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" name="description" rows="4" required>{{ $product->description }}</textarea>
            @error('description')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror
        </div>
        <div class="w-full flex justify-center flex-col">
            <x-label for="image" :value="trans('products.image')" />
            <input type="file" name="image" id="image">
            @error('image')
                <span class="text-red-600">
                    <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-button type="submit" class="ml-4">
            {{$title}}
        </x-button>
    </div>
</form>
