<nav>
    <!-- Primary Navigation Menu -->
    @auth()
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end gap-5 content-center">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ trans('dashboard.home') }}
                </x-nav-link>
            @can('viewAny', App\Models\User::class)
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ trans('dashboard.users') }}
                </x-nav-link>
            @endcan
            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                {{ trans('dashboard.categories') }}
            </x-nav-link>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        <button class="flex items-center text-sm font-medium text-gray-200 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-600 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ trans('auth.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
    </div>
    @else
        @if (Route::has('login'))
            <div class="hidden fixed right-0 px-14 sm:block ">
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ trans('dashboard.login') }}
                </x-nav-link>
                @if (Route::has('register'))
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ trans('dashboard.btnRegister') }}
                    </x-nav-link>
                @endif
            </div>
        @endif
    @endauth
</nav>
