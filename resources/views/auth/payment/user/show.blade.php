<x-app-layout>
    <div class="w-full overflow-hidden py-5 bg-white">
        <div class="flex gap-3 justify-end py-3 p-10">
            <a href="{{$payment->myPaymentsRoute()}}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
                <em class="fas fa-arrow-circle-left flex self-center"></em> {{ trans('dashboard.back') }}
            </a>
            @if($payment->isRejected())
                <a href="{{ route('payment.reload', $payment) }}"  class="flex self-center gap-2 font-semibold rounded-2xl px-4 py-1 shadow-md bg-gray-300 hover:bg-gray-200 ">
                    <spam>{{ trans('payments.reload') }}</spam>
                </a>
            @endif
        </div>
        <div class="flex w-full">
            <div class="p-9 border-gray-200 w-1/2 items-top">
                <div class="pb-5">
                    <x-status :payment="$payment"/>
                    <hr class="mt-5 w-full bg-gray-300">
                </div>
                <div class="flex h-72 flex-col justify-between">
                    <p class="font-bold text-lg"> {{ trans('payments.invoice.invoice') }} </p>
                    <div class="pl-5">
                        <p class="font-medium text-sm text-gray-400"> {{ trans('payments.invoice.billed_to') }} </p>
                        <p> {{ $payment->user->fullName() }} </p>
                        <p> {{ $payment->user->email }} </p>
                        <p> {{ $payment->user->phone_number }} </p>
                        <p> {{ $payment->payer_address }} </p>
                    </div>
                    <div class="pt-9 border-b border-gray- items-start">
                        <p class="font-medium text-sm text-gray-400">{{ trans('payments.invoice.note') }}</p>
                        <p class="text-sm">{{ trans('payments.invoice.thanks') }}</p>
                    </div>
                </div>
            </div>
            <div class="w-full">
                <div class="ml-2 h-5/6 overflow-y-scroll">
                    <table class="w-full text-sm">
                        <thead>
                            <tr>
                                <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400">{{ trans('products.image') }}</th>
                                <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400">{{ trans('register.name') }}</th>
                                <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400">{{ trans('payments.invoice.price') }}</th>
                                <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400">{{ trans('payments.count') }}</th>
                                <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400">{{ trans('payments.total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payment->products as $product)
                                <tr>
                                    <td class="whitespace-nowrap text-gray-600 truncate">
                                        <img src="{{ $product->image_route }}" alt="{{ $product->name }}" class="rounded-md h-20 w-20 object-center object-cover md:block hidden">
                                    </td>
                                    <td class="px-9 py-4 border-b text-sm text-center whitespace-nowrap text-gray-600 truncate">{{ $product->name }}</td>
                                    <td class="px-9 py-4 border-b text-sm text-center whitespace-nowrap text-gray-600 truncate"> {{ $product->amount }} </td>
                                    <td class="px-9 py-4 border-b text-sm text-center whitespace-nowrap text-gray-600 truncate"> {{ $product->pivot->count }} </td>
                                    <td class="px-9 py-4 border-b text-sm text-center whitespace-nowrap text-gray-600 truncate"> {{$product->pivot->amount_format }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-2 p-8 ">
                    <div class="flex w-full justify-between">
                        <p class="font-bold text-black text-lg">{{ trans('payments.invoice.total_amount') }}</p>
                        <p class="font-bold text-black text-lg"> {{ $payment->amount_format }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
