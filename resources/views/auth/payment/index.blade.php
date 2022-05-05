<x-app-layout>
    <div class="max-h-screen">
        <div class="flex items-center flex-row mx-10 -mt-40">
            <div class="w-full max-h-screen h-full overflow-y-auto">
                <div class="px-8 mt-24 py-14 bg-white">
                    <p class="lg:text-4xl text-3xl font-black leading-10 text-gray-800 dark:text-white pt-3"> {{ trans('payments.bag') }} </p>
                    @foreach($payment->products as $product)
                        <div class="py-8 py-8 border-t flex border-gray-50 hover:bg-gray-200 rounded-md p-4">
                        <div class="md:w-4/12 2xl:w-1/4 w-full">
                            <img src="{{ $product->image_route }}" alt="{{ $product->name }}" class="rounded-md h-40 w-40 object-center object-cover md:block hidden">
                        </div>

                        <div class="flex flex-col w-full justify-center">
                            <div class="flex items-center justify-between w-full pt-1">
                                <div class="font-black w-full flex-grow leading-none text-gray-800 dark:text-white">{{ $product->name }}</div>
                                <div class="flex items-center text-white justify-center gap-3 flex-grow bg-red-500 rounded-xl px-4">
                                    <p class="font-bold text-sm"> {{trans('payments.count')}}: </p>
                                    <p class="text-xs leading-3">{{ $product->pivot->count }}</p>
                                </div>
                            </div>
                            <p class="text-xs leading-3 text-gray-600 dark:text-white pt-2 w-1/2 h-full">{{ $product->description }}</p>

                            <div class="flex items-center justify-between pt-5">
                                <p class="text-base font-black leading-none text-gray-800 dark:text-white">{{ $product->pivot->amount_format }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-96 bg-black bg-opacity-90 h-screen p-5 flex flex-col justify-between pb-10">
                <div class="flex flex-col h-auto px-8 py-20 justify-between mt-20">
                    <p class="lg:text-4xl text-3xl font-black leading-9 text-gray-200">{{ trans('payments.purchase') }}</p>
                </div>
                <div>
                    <div class="flex items-center pb-6 justify-between lg:pt-5 pt-20 text-gray-200">
                        <p class="text-2xl leading-normal">{{ trans('payments.total') }}</p>
                        <p class="text-2xl font-bold leading-normal text-right">{{ $payment->amount_format }}</p>
                    </div>
                    <button class="text-base leading-none w-full py-5 bg-gray-800 border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700" @click="$root.$emit('open-modal', {'route': '{{ route('payment.process', $payment) }}'})">
                        {{ trans('payments.continuous') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <x-payment-modal :payment='$payment' />
</x-app-layout>
