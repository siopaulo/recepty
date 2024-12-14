<nav x-data="{ open: false }" class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <img src="/images/home.png" alt="Domov" class="h-10 w-10">
                    </a>
                </div>

                <div class="hidden space-x-8 sm:ms-10 sm:flex">
                    <a href="/recepty" class="px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        Recepty
                    </a>
                    <a href="/alergeny" class="px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        Alergeny
                    </a>

                    <a href="/pridat-recept" class="px-6 py-2 rounded-full bg-green-600 text-white hover:bg-green-700 transition duration-300">
                        Přidat recept
                    </a>
                </div>
            </div>

            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                             this.closest('form').submit();">
                                    {{ __('Odhlásit se') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        Přihlásit se
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        Registrovat
                    </a>
                </div>
            @endauth

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/recepty" class="block px-4 py-2 text-sm text-white bg-black rounded-lg hover:bg-gray-700 transition">
                Recepty
            </a>
            @auth
                <a href="/pridat-recept" class="block px-4 py-2 text-sm text-white bg-black rounded-lg hover:bg-gray-700 transition">
                    Přidat recept
                </a>
            @endauth
            <a href="/alergeny" class="block px-4 py-2 text-sm text-white bg-black rounded-lg hover:bg-gray-700 transition">
                Alergeny
            </a>

            @guest
                <a href="/login" class="block px-4 py-2 text-sm text-white bg-black rounded-lg hover:bg-gray-700 transition">
                    Přihlásit se
                </a>
                <a href="/register" class="block px-4 py-2 text-sm text-white bg-black rounded-lg hover:bg-gray-700 transition">
                    Registrovat
                </a>
            @endguest
        </div>
    </div>
</nav>
