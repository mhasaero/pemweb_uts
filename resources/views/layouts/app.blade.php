<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Left side -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="isOpen = !isOpen" type="button" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': isOpen, 'inline-flex': !isOpen}" 
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !isOpen, 'inline-flex': isOpen}" 
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop menu -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Authentication Links -->
                        @guest
                            <div class="flex space-x-4">
                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="px-3 py-2 text-gray-600 hover:text-gray-900">
                                        {{ __('Login') }}
                                    </a>
                                @endif

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-3 py-2 text-gray-600 hover:text-gray-900">
                                        {{ __('Register') }}
                                    </a>
                                @endif
                            </div>
                        @else
                        <div class="ml-3 relative" x-data="{ profileOpen: false }">
                            <!-- Tombol Trigger -->
                            <button @click="profileOpen = !profileOpen" 
                                class="flex items-center text-gray-600 hover:text-gray-900">
                                {{ Auth::user()->name }}
                                <svg class="h-5 w-5 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" 
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                                        clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="profileOpen" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                @click.away="profileOpen = false"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                                style="display: none;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="isOpen" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" 
                                class="block pl-3 pr-4 py-2 text-gray-600 hover:text-gray-900">
                                {{ __('Login') }}
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                                class="block pl-3 pr-4 py-2 text-gray-600 hover:text-gray-900">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @else
                        <form method="POST" action="{{ route('logout') }}" class="px-4">
                            @csrf
                            <button type="submit" 
                                class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</html>
