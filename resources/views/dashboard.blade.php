<x-app-layout>
    <x-slot name="search">
        <v-search-bar search-text="{{ trans('dashboard.search') }}">
            <form action="{{ route('home') }}" method="GET" class="p-2 gap-4 flex flex-col justify-between">
                <div class="grid grid-cols-5  grid-rows-2 gap-4">
                    <input name="search" value="{{ old('search',  request()->input('search')) }}" class="grid col-span-2 w-full border border-gray-300 rounded-md pl-10 pr-4 py-2 focus:border-gray-500 focus:outline-none focus:shadow-outline" type="text" placeholder="{{trans('dashboard.search')}}">
                    <div class="w-full self-center flex justify-end">
                        <h3> {{ trans('products.price') }} </h3>
                    </div>
                        <div>
                            <input name="start_price" value="{{ request()->start_price }}" class="w-full col-end-6 col-span-2 border border-gray-300 rounded-md pl-10 pr-4 py-2 focus:border-gray-500 focus:outline-none focus:shadow-outline" type="text" placeholder="{{ trans('products.start_price') }}">
                            @error('start_price')
                            <span class="text-red-600">
                            <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                        </span>
                            @enderror
                        </div>
                        <div>
                            <input name="end_price" value="{{ request()->end_price }}" class="w-full col-end-6 col-span-2 border border-gray-300 rounded-md pl-10 pr-4 py-2 focus:border-gray-500 focus:outline-none focus:shadow-outline" type="text" placeholder="{{ trans('products.end_price') }}">
                            @error('end_price')
                            <span class="text-red-600">
                            <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                        </span>
                            @enderror
                        </div>
                    <div class="row-start-2 col-span-2 gap-4 flex flex-row">
                        <h3 class="w-1/2"> {{ trans('dashboard.categories') }} </h3>
                        <v-select name="category" label="name" @if(request()->category) :initial="{{ json_encode(['id' => request()->category, 'name' => optional($categorySelect->find(request()->category, 'id'))->name])}}" @endif :options='@json($categorySelect, true)'/>
                    </div>
                    <button type="submit" class="col-end-6 bg-gray-600 py-3 px-5 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                        {{ trans('dashboard.search') }}
                    </button>
                </div>
            </form>
        </v-search-bar>
    </x-slot>
    @if(!request()->get('category') && $categories->count())
        <div class="container mx-auto pt-3 pl-6 mt-20">
        <h2 class="text-gray-700 font-semibold text-2xl font-medium">{{ trans('dashboard.categories') }}</h2>
        <span class="mt-3 text-sm text-gray-500">{{ $categories->count() . ' ' . trans('dashboard.categories') }}</span>
        <carousel :items="{{ $categories }}">
            <template v-slot:card="props">
                <div class="inline-block bg-white w-64 h-56 p-1 relative align-middle justify-center rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-xl transition-shadow ease-in p-2">
                    <div class="gap-2 flex px-2 self-center w-full items-end justify-end h-40 rounded-xl w-11/12 bg-cover" :style="'background-image: url('+props.item.image_route+')'">
                        <a :href="props.item.show_route" :title="props.item.products_count + ' PRODUCTS'" class="flex items-center justify-center p-2 rounded-full bg-gray-500 text-white h-10 w-10 -mb-4 hover:bg-gray-700 focus:outline-none text-white focus:bg-gray-700">
                            <em class="fas fa-eye"></em>
                        </a>
                    </div>
                    <div class="px-4 mt-4">
                        <p class="text-lg font-semibold text-gray-900 mb-0 truncate">
                            @{{ props.item.name }}
                        </p>
                    </div>
                </div>
                </template>
        </carousel>
    </div>
    @endif
    <div class="container mx-auto pt-3 pl-6 mb-10">
        <h2 class="text-gray-700 font-semibold text-2xl font-medium">{{ trans('categories.products') }}</h2>
        <span class="mt-3 text-sm text-gray-500">{{ $products->count() . ' ' . trans('categories.products') }}</span>

        <div class="relative m-3 flex flex-wrap gap-4 mx-auto justify-center align-middle">
            @forelse($products as $product)
                <div class="inline-block bg-white w-64 h-64 p-1 relative align-middle justify-center rounded-lg shadow-md overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-xl transition-shadow ease-in p-2">
                    <div class="gap-2 flex px-2 self-center w-full items-end justify-end h-40 rounded-xl w-11/12 bg-cover" style="background-image: url('{{$product->image_route}}')">
                        <button class="flex items-center justify-center p-2 rounded-full bg-green-500 text-white h-10 w-10 -mb-4 hover:bg-green-700 focus:outline-none focus:bg-green-700">
                            <em class="fas fa-cart-plus"></em>
                        </button>
                        <a href="{{ route('guest.products.show', $product) }}" class="flex items-center justify-center p-2 rounded-full bg-gray-500 text-white h-10 w-10 -mb-4 hover:bg-gray-700 focus:outline-none text-white focus:bg-gray-700">
                            <em class="fas fa-eye"></em>
                        </a>
                    </div>
                    <div class="px-4 mt-4">
                        <p class="text-lg font-semibold text-gray-900 mb-0 truncate">
                            {{ $product->name }}
                        </p>
                        <p class="text-md font-semibold text-gray-500 mb-0 truncate">
                            {{ $product->amount }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="relative min-w-[340px] bg-white rounded-2xl p-14 my-3 grid grid-cols-3 max-w-max">
                    <svg xmlns="http://www.w3.org/2000/svg" id="currentIllo" data-name="Layer 1" width="400" height="320" viewBox="0 0 647.63626 632.17383" class="h-48 w-48 injected-svg DownloadModal__ImageFile-sc-p17csy-5 iIfSkb grid_media" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M687.3279,276.08691H512.81813a15.01828,15.01828,0,0,0-15,15v387.85l-2,.61005-42.81006,13.11a8.00676,8.00676,0,0,1-9.98974-5.31L315.678,271.39691a8.00313,8.00313,0,0,1,5.31006-9.99l65.97022-20.2,191.25-58.54,65.96972-20.2a7.98927,7.98927,0,0,1,9.99024,5.3l32.5498,106.32Z" transform="translate(-276.18187 -133.91309)" fill="#f2f2f2"></path><path d="M725.408,274.08691l-39.23-128.14a16.99368,16.99368,0,0,0-21.23-11.28l-92.75,28.39L380.95827,221.60693l-92.75,28.4a17.0152,17.0152,0,0,0-11.28028,21.23l134.08008,437.93a17.02661,17.02661,0,0,0,16.26026,12.03,16.78926,16.78926,0,0,0,4.96972-.75l63.58008-19.46,2-.62v-2.09l-2,.61-64.16992,19.65a15.01489,15.01489,0,0,1-18.73-9.95l-134.06983-437.94a14.97935,14.97935,0,0,1,9.94971-18.73l92.75-28.4,191.24024-58.54,92.75-28.4a15.15551,15.15551,0,0,1,4.40966-.66,15.01461,15.01461,0,0,1,14.32032,10.61l39.0498,127.56.62012,2h2.08008Z" transform="translate(-276.18187 -133.91309)" fill="#3f3d56"></path><path d="M398.86279,261.73389a9.0157,9.0157,0,0,1-8.61133-6.3667l-12.88037-42.07178a8.99884,8.99884,0,0,1,5.9712-11.24023l175.939-53.86377a9.00867,9.00867,0,0,1,11.24072,5.9707l12.88037,42.07227a9.01029,9.01029,0,0,1-5.9707,11.24072L401.49219,261.33887A8.976,8.976,0,0,1,398.86279,261.73389Z" transform="translate(-276.18187 -133.91309)" fill="#f8ff01"></path><circle cx="190.15351" cy="24.95465" r="20" fill="#f8ff01"></circle><circle cx="190.15351" cy="24.95465" r="12.66462" fill="#fff"></circle><path d="M878.81836,716.08691h-338a8.50981,8.50981,0,0,1-8.5-8.5v-405a8.50951,8.50951,0,0,1,8.5-8.5h338a8.50982,8.50982,0,0,1,8.5,8.5v405A8.51013,8.51013,0,0,1,878.81836,716.08691Z" transform="translate(-276.18187 -133.91309)" fill="#e6e6e6"></path><path d="M723.31813,274.08691h-210.5a17.02411,17.02411,0,0,0-17,17v407.8l2-.61v-407.19a15.01828,15.01828,0,0,1,15-15H723.93825Zm183.5,0h-394a17.02411,17.02411,0,0,0-17,17v458a17.0241,17.0241,0,0,0,17,17h394a17.0241,17.0241,0,0,0,17-17v-458A17.02411,17.02411,0,0,0,906.81813,274.08691Zm15,475a15.01828,15.01828,0,0,1-15,15h-394a15.01828,15.01828,0,0,1-15-15v-458a15.01828,15.01828,0,0,1,15-15h394a15.01828,15.01828,0,0,1,15,15Z" transform="translate(-276.18187 -133.91309)" fill="#3f3d56"></path><path d="M801.81836,318.08691h-184a9.01015,9.01015,0,0,1-9-9v-44a9.01016,9.01016,0,0,1,9-9h184a9.01016,9.01016,0,0,1,9,9v44A9.01015,9.01015,0,0,1,801.81836,318.08691Z" transform="translate(-276.18187 -133.91309)" fill="#f8ff01"></path><circle cx="433.63626" cy="105.17383" r="20" fill="#f8ff01"></circle><circle cx="433.63626" cy="105.17383" r="12.18187" fill="#fff"></circle></svg>
                    <h2 class="text-gray-600 flex self-center justify-center font-bold text-2xl col-span-2">{{ trans('categories.void.void') }}</h2>
                </div>
            @endforelse
        </div>
        {{ $products->onEachSide(8)->links() }}
    </div>

</x-app-layout>

