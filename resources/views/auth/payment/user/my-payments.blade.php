<x-app-layout>
    <div class="bg-gray-100 grid grid-cols-1 lg:grid-cols-2 gap-6 -mt-2 mx-12 w-2xl container px-2 mx-auto">
        <aside class="">
            <div class="bg-white shadow rounded-lg p-10">
                <div class="flex flex-col gap-1 text-center items-center">
                    <img class="h-32 w-32 bg-white p-2 rounded-full shadow mb-4" src="{{ $user->image() }}" alt="{{ $user->fullname() }}">
                    <p class="font-semibold">{{$user->fullname()}}</p>
                    <div class="text-sm leading-normal text-gray-400 flex justify-center items-center">
                        <em class="far fa-at"></em>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="flex justify-center items-center gap-2 my-3">
                    <div class="font-semibold text-center mx-4">
                        <p class="text-black">{{ $payments->count() }}</p>
                        <span class="text-gray-400">Payments</span>
                    </div>
                    <div class="font-semibold text-center mx-4">
                        <p class="text-black">102</p>
                        <span class="text-gray-400">Role</span>
                    </div>
                </div>
            </div>
        </aside>
        <article class="">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    @if($payments)
                        <table class="bg-white min-w-full leading-normal">
                            <thead>
                            <tr class="bg-gray-200 border-b-2 border-gray-300 text-left text-xs text-gray-600 uppercase ">
                                <th scope="col" class="text-center px-5 py-3">{{ trans('users.info.status') }}</th>
                                <th scope="col" class="text-center px-5 py-3">Amount</th>
                                <th scope="col" class="text-center px-5 py-3">{{ trans('users.info.created_at') }}</th>
                                <th scope="col" class="text-center px-5 py-3"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr class="hover:bg-gray-200">
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
                                        <div class="flex items-center justify-center">
                                             <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                                                <span class="relative"> {{ $payment->amount_format }} </span>
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
        </article>
    </div>
</x-app-layout>
