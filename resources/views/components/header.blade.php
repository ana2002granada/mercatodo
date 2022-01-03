<div class="bg-black shadow fixed max-w-screen h-28 z-10 mx-auto inset-x-0 top-0 flex justify-between items-center">
    <div class="w-1/2 min-w-32 justify-center content-center lg:flex hidden">
            @svg('logoXL')
    </div>
    <div class="h-full flex justify-center content-center lg:hidden bg-primary-500 rounded-r-full">
        @svg('logo')
    </div>
    <div class="justify-end flex content-center text-blue-50 pr-10">
        @include('layouts.navigation')
    </div>
</div>
