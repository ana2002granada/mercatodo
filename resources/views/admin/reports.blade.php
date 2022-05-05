<x-app-layout>
    <div>
        <div class="flex grid grid-cols-1 md:grid-cols-2 w-full justify-between gap-4">
            <div class="h-full w-full">
                <div class="bg-white rounded-2xl mx-10 py-7 shadow-md">
                    <h1 class="text-gray-700 font-semibold text-2xl font-medium text-center border-b-2 border-gray-300 pb-3 mb-3 mx-5"> {{ trans('reports.productChart') }} </h1>
                    <v-charts name="products" :information='@json($products)'/>
                </div>
            </div>
            <div class="h-full w-full">
                <div class="bg-white rounded-2xl mx-10 py-7 shadow-md">
                <h1 class="text-gray-700 font-semibold text-2xl font-medium text-center border-b-2 border-gray-300 pb-3 mb-3 mx-5"> {{ trans('reports.paymentChart') }} </h1>
                <v-charts name="payments" :information='@json($payments)'/>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
