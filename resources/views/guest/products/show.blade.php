<x-app-layout>
    <div class="flex justify-end content-center shadow-md py-5 p-4 bg-white rounded-xl">
        <a href="{{ route('home') }}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
            <em class="fas fa-arrow-circle-left flex self-center"></em> {{ trans('dashboard.back') }}
        </a>
    </div>
    <main class="my-8">
        <div class="container mx-auto">
            <div class="md:flex md:items-center bg-white rounded-xl py-4 ">
                <div class="w-full h-64 md:w-1/2 lg:h-96">
                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto"  src="{{ $product->image_route }}" alt="{{$product->name}}">
                </div>
                <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                    <h3 class="text-gray-700 uppercase text-lg">{{ $product->name }}</h3>
                    <span class="text-gray-500 mt-3">{{ $product->amount }}</span>
                    <hr class="my-3">
                    <p class="text-gray-700 mt-3">{{ $product->description }}</p>
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm" for="count">Count:</label>
                        <div class="flex items-center mt-1">
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 text-lg mx-2">0</span>
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 {{  $product->stock <= 5 ? 'text-red-500' : 'text-gray-500' }}">
                        Stock: {{ $product->stock }}
                    </div>
                    <div class="flex items-center mt-6">
                        <a class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
                            <em class="fas fa-cart-plus flex self-center"></em> {{ trans('products.shopping_cart') }}
                        </a>
                    </div>
                </div>
            </div>
            @if($similarProducts->count())
            <div class="mt-4 p-4">
                <h3 class="text-gray-600 text-2xl font-medium"> {{ trans('products.more') }} </h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    @foreach($similarProducts as $similar)
                        <div class="inline-block bg-white w-64 h-64 p-1 relative align-middle justify-center rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-xl transition-shadow ease-in p-2">
                            <div class="gap-2 flex px-2 self-center w-full items-end justify-end h-40 rounded-xl w-11/12 bg-cover" style="background-image: url('{{$similar->image_route}}')">
                                <button class="flex items-center justify-center p-2 rounded-full bg-green-500 text-white h-10 w-10 -mb-4 hover:bg-green-700 focus:outline-none focus:bg-green-700">
                                    <em class="fas fa-cart-plus"></em>
                                </button>
                                <a href="{{ route('guest.products.show', $similar) }}" class="flex items-center justify-center p-2 rounded-full bg-gray-500 text-white h-10 w-10 -mb-4 hover:bg-gray-700 focus:outline-none text-white focus:bg-gray-700">
                                    <em class="fas fa-eye"></em>
                                </a>
                            </div>
                            <div class="px-4 mt-4">
                                <p class="text-lg font-semibold text-gray-900 mb-0 truncate">
                                    {{ $similar->name }}
                                </p>
                                <p class="text-md font-semibold text-gray-500 mb-0 truncate">
                                    {{ $similar->amount }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </main>
</x-app-layout>
