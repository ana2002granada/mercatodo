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
                                    <button @click="$root.$emit('open-modal-error-{{$import->id}}')">
                                        {{ trans('users.actions.delete') }}
                                    </button>
                                    @if($import->errors)
                                        <modal name-modal="error-{{$import->id}}" inline-template v-cloak>
            <div v-if="showModal">
        <transition  enter-class="transition ease-out duration-200"
                     enter-active-class="transform opacity-0 scale-95"
                     enter-to-class="transform opacity-100 scale-100"
                     leave-class="transition ease-in duration-75"
                     leave-active-class="transform opacity-100 scale-100"
                     leave-to-class="transform opacity-0 scale-95"
                     name="modal" >
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">

                            <div class="text-center p-5 flex-auto justify-center">
                                <div class="flex gap-3 mb-5">
                                    <em class="fas fa-exclamation-circle self-center text-red-600 fa-3x"></em>
                                    <h2 class="text-xl font-bold py-4 ">{{trans('validation.import.errors')}}</h2>
                                </div>
                                <div class="mockup-code text-left">
                                    @foreach($import->errors as $row => $error)
                                        @if(!is_array($error))
                                        <pre class="w-full" data-prefix="~"><code>{{ $error }}</code></pre>
                                        @else
                                            @foreach($error as $value)
                                                <pre class="w-full" data-prefix="~"><code><span class="text-danger">{{ $row }}: </span>{{ $value }}</code></pre>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!--footer-->
                            <div class="p-3  mt-2 text-center space-x-4 md:block">
                                <button class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100" @click="showModal=false">
                                    Close
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</modal>
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


