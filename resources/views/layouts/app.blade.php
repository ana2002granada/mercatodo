<x-guest-layout>
    {{ $search ?? '' }}
    <div class="min-h-full flex flex-col justify-between">
        <main class="bg-gray-100 shadow min-h-full">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 min-h-full mb-3">
                {{ $slot }}
            </div>
        </main>
        <footer class="bg-gray-200 fixed inset-x-0 bottom-0 z-50">
            <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-500 hover:text-gray-400">{{ config('app.name') }}</a>
                <p class="py-2 text-gray-500 sm:py-0">Realizado por: <strong>Ana Maria Granada Rodas</strong></p>
            </div>
        </footer>
    </div>
</x-guest-layout>
