<x-app-layout>
    <div class="w-full overflow-hidden py-5 bg-white">
        <div class="flex gap-3 justify-end py-3">
            <a href="{{$payment->myPaymentsRoute()}}" class="bg-primary-500 rounded-2xl text-black font-semibold shadow-md px-4 py-1 flex self-center gap-2 hover:bg-primary-400">
                <em class="fas fa-arrow-circle-left flex self-center"></em> {{ trans('dashboard.back') }}
            </a>
            @if($payment->isRejected())
                <a href="{{ route('payment.reload', $payment) }}"  class="flex self-center gap-2 font-semibold rounded-2xl px-4 py-1 shadow-md bg-green-500 hover:bg-green-400 ">
                    <em class="fas fa-edit flex self-center"></em> Reintentar compra xD
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
                <p class="font-bold text-lg"> Invoice </p>
                <div class="pl-5">
                    <p class="font-medium text-sm text-gray-400"> Billed To </p>
                    <p> {{ $payment->user->fullName() }} </p>
                    <p> {{ $payment->user->email }} </p>
                    <p> {{ $payment->user->phone_number }} </p>
                    <p> {{ $payment->payer_address }} </p>
                </div>

                <div class="pt-9 border-b border-gray-200">
                <p class="font-medium text-sm text-gray-400"> Note </p>
                <p class="text-sm"> Thank you for your order. </p>
            </div>
            </div>
        </div>
            <div class="w-full align-bottom">
            <table class="w-full text-sm">
                        <thead>
                        <tr>
                            <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400"> Image</th>
                            <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400"> Item </th>
                            <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400"> precio unidad </th>
                            <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400"> cantidad </th>
                            <th scope="col" class="px-9 py-4 text-center font-semibold text-gray-400"> total </th>
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
            <div class="p-9 flex align-bottom">
                <div class="flex justify-between">
                    <p class="font-bold text-black text-lg"> Amount Due </p>
                    <p class="font-bold text-black text-lg"> {{ $payment->amount_format }} </p>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
