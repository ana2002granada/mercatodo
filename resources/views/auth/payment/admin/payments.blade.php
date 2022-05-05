<x-app-layout>

    <div class=" flex items-center justify-between pb-2">
        <h1 class="text-gray-700 font-semibold text-2xl font-medium">Payments</h1>
    </div>
    <div class="flex grid grid grid-cols-2 w-full justify-between gap-2">
        <div class="w-full">
            <div class="bg-white rounded-2xl mx-10 py-7 shadow-md">
                <v-line-chart :information='@json($paymentsCharts)'/>
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    @if($payments)
                        <table class="bg-white min-w-full leading-normal">
                            <thead>
                            <tr class="bg-gray-200 border-b-2 border-gray-300 text-left text-xs text-gray-600 uppercase ">
                                <th scope="col" class="text-center px-5 py-3">user doc</th>
                                <th scope="col" class="text-center px-5 py-3">{{ trans('users.info.status') }}</th>
                                <th scope="col" class="text-center px-5 py-3">{{ trans('users.info.created_at') }}</th>
                                <th scope="col" class="text-center px-5 py-3"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr class="hover:bg-gray-200">
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="flex items-center justify-center">
                                             <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                <span class="relative"> {{ $payment->payer_document }} </span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm flex justify-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        @if($payment->status === \App\Constants\PaymentStatus::SUCCESSFUL)
                                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                            <span class="relative">{{ trans('payments.status.successful') }}</span>
                                        @elseif($payment->status === \App\Constants\PaymentStatus::REJECTED)
                                            <span aria-hidden class="absolute inset-0 bg-red-400 opacity-50 rounded-full"></span>
                                            <span class="relative">{{ trans('payments.status.rejected') }}</span>
                                        @else
                                            <span aria-hidden class="absolute inset-0 bg-yellow-400 opacity-50 rounded-full"></span>
                                            <span class="relative">{{ trans('payments.status.pending') }}</span>
                                        @endif
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="flex items-center justify-center">
                                             <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                <span class="relative"> {{ $payment->created_at }} </span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="flex sm:items-center sm:ml-6 justify-end pr-2">
                                            <x-dropdown align="right" width="48">
                                                <x-slot name="trigger">
                                                    <button class="flex items-center text-sm font-medium text-gray-800 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-600 focus:border-gray-300 transition duration-150 ease-in-out">
                                                        <em class="fas fa-ellipsis-v"></em>
                                                    </button>
                                                </x-slot>

                                                <x-slot name="content">
                                                    @can('view', $payment)
                                                        <x-dropdown-link href="{{ route('my-payments.payment', $payment) }}">
                                                            {{ $payment->isProcessing() ? trans('payments.continuousShopping') : trans('users.actions.more') }}
                                                        </x-dropdown-link>
                                                        @if($payment->isPending())
                                                            <x-dropdown-link :href="$payment->process_url">
                                                                {{ trans('payments.continue_payment') }}
                                                            </x-dropdown-link>
                                                        @endif
                                                    @endcan
                                                </x-slot>
                                            </x-dropdown>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $payments->onEachSide(5)->links() }}
                    @else
                        <div class="bg-white shadow-md rounded-2xl p-14  ">
                            <h2 class="text-gray-600 flex self-center justify-center font-bold text-2xl col-span-2">{{ trans('payments.no_transactions') }}</h2>
                        </div>
                    @endif
                </div>
        </div>
    </div>

</x-app-layout>
