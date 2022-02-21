<nav class="sm:flex sm:justify-center sm:items-center mt-4 bg-white">
    <div class="flex flex-col sm:flex-row">
        @auth()
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')||request()->routeIs('guest.*')">
                {{ trans('dashboard.home') }}
            </x-nav-link>
            @can('viewAny', App\Models\User::class)
                <x-nav-link :href="App\Models\User::indexRoute()" :active="request()->routeIs('admin.users.*')">
                    {{ trans('dashboard.users') }}
                </x-nav-link>
            @endcan
            @can('viewAny', App\Models\Category::class)
                <x-nav-link :href="App\Models\Category::indexRoute()" :active="request()->routeIs('admin.categories.*')">
                    {{ trans('dashboard.categories') }}
                </x-nav-link>
            @endcan
            @can('viewAny', App\Models\Product::class)
                <x-nav-link :href="App\Models\Product::indexRoute()" :active="request()->routeIs('admin.products.*')">
                    {{ trans('categories.products') }}
                </x-nav-link>
            @endcan
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">

                    <button class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0 flex items-center focus:outline-none  transition duration-150 ease-in-out">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content" class="z-50">
                    <div >
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ trans('auth.logout') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>
        @else
            @if (Route::has('login'))
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ trans('dashboard.login') }}
                    </x-nav-link>
                    @if (Route::has('register'))
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ trans('dashboard.btnRegister') }}
                        </x-nav-link>
                    @endif
            @endif
        @endauth
    </div>
</nav>
