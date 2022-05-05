<x-app-layout>

    <div class=" flex items-center justify-between pb-2">
        <h1 class="text-gray-700 font-semibold text-2xl font-medium">{{trans('products.import.imports')}}</h1>
        <div class="flex gap-4">
            <a href="{{App\Models\Product::indexRoute()}}" class="ml-4 mt-4 w-28 bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
                <em class="fas fa-arrow-circle-left flex self-center"></em> {{ trans('dashboard.back') }}
            </a>
            @can('import', \App\Models\Product::class)
                <a href="{{ \App\Models\Import::formRoute() }}"  class="flex self-center gap-2 font-semibold rounded-2xl px-4 py-1 shadow-md bg-gray-300 hover:bg-gray-400 ">
                    <em class="fas fa-file-import self-center"></em> {{trans('products.import.import')}}
                </a>
            @endcan
        </div>
    </div>
    <div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                @if($imports->count())
                <table class="bg-white min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-200 border-b-2 border-gray-300 text-left text-xs text-gray-600 uppercase ">
                            <th scope="col" class="px-5 py-3">Algo del user</th>
                            <th scope="col" class="px-5 py-3">{{ trans('users.info.status') }}</th>
                            <th scope="col" class="px-5 py-3">Errors</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($imports as $import)
                             <tr class="hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $import->user_id }}
                                            </p>
                                        </div>
                                    </div>

                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    @if($import->status === 'successful')
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative"> successful</span>
                                    @elseif($import->status === 'processing')
                                        <span aria-hidden class="absolute inset-0 bg-yellow-400 opacity-50 rounded-full"></span>
                                        <span class="relative">processing</span>
                                    @elseif($import->status === 'general error')
                                        <span aria-hidden class="absolute inset-0 bg-red-400 opacity-50 rounded-full"></span>
                                        <span class="relative"> General Error</span>
                                    @else
                                        <span aria-hidden class="absolute inset-0 bg-red-400 opacity-50 rounded-full"></span>
                                        <span class="relative"> Validation error</span>
                                    @endif
									</span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <button @click="$root.$emit('open-modal')">
                                        {{ trans('users.actions.delete') }}
                                    </button>
                                    @if($import->errors)
                                        @foreach( $import->errors as $error)
                                            <x-import-modal></x-import-modal>
                                            @if(is_array($error))
                                                {{ $error = implode(' ' , $error) }}

                                            @else
                                                <x-import-modal errors="{{ $error }}" />
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
                {{$imports->onEachSide(5)->links() }}
                @else
                    <div class="bg-white shadow-md rounded-2xl p-14  ">
                        <h2 class="text-gray-600 flex self-center justify-center font-bold text-2xl col-span-2">No imports</h2>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>


