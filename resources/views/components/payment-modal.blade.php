<modal inline-template v-cloak>
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
                        <form :action="data.route" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="relative py-8 px-5 flex flex-col gap-4">
                                <div class="flex gap-5 items-center">
                                    <div class="flex justify-start text-gray-600 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="52" height="52" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
                                            <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
                                        </svg>
                                    </div>
                                    <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Enter Billing Details</h1>
                                </div>
                                <div>
                                    <x-label class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Owner Name</x-label>
                                    <span class="capitalize">{{ auth()->user()->fullName() }}</span>
                                </div>
                                <div>
                                    <x-label class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Owner Name</x-label>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                <div>
                                    <x-label for="document" class="text-gray-800 text-sm font-bold leading-tight tracking-normal" value="Document" />

                                    <x-input id="document" class="block w-full" type="text" name="document" :value="$payment->payer_document" required autofocus />
                                    @error('document')
                                    <span class="text-red-600">
                                        <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="address" class="text-gray-800 text-sm font-bold leading-tight tracking-normal" value="Address" />

                                    <x-input id="address" class="block w-full" type="text" name="address" :value="$payment->payer_address" required autofocus />
                                    @error('address')
                                    <span class="text-red-600">
                                        <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <x-label for="description" class="text-gray-800 text-sm font-bold leading-tight tracking-normal" value="Description" />

                                    <textarea id="description" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full" name="description" autofocus>
                                        {{ $payment->description }}
                                    </textarea>
                                    @error('description')
                                    <span class="text-red-600">
                                        <em class="mr-2 fas fa-info-circle"></em>{{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-end mt-4 w-full">
                                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-gray-600 bg-gray-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                                    <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" @click="showModal=false">Cancel</button>
                                </div>
                                <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" @click="showModal=false" aria-label="close modal" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</modal>
