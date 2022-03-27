<x-guest-layout>
    {{ $search ?? '' }}
    <div class="min-h-full flex flex-col justify-between">
        <main class="bg-gray-100 shadow min-h-full">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 min-h-full mb-3">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-guest-layout>
