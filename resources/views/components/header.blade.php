<div class="bg-black shadow fixed max-w-screen h-28 z-10 mx-auto inset-x-0 top-0 flex justify-between items-center">
    <div class="w-1/2 min-w-32 flex justify-center content-center">
        @svg('logoXL')
    </div>
    <div class="justify-end flex content-center text-blue-50 pr-10">
        @auth()
        @include('layouts.navigation')
        @endauth
    </div>
</div>
