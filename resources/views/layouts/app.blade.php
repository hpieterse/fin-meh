<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YABT</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <meta charset="UTF-8" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @livewireStyles
</head>
<body class="bg-gray-50 text-primary">
    <div id="app">
        <x-menu>
            <x-slot name="brand">
                <a class="flex flex-row items-center space-x-3" href="@auth
                        {{ url('/budget') }}
                    @else
                        {{ url('/') }}
                    @endauth">
                    <x-icon-rabbit-fast-solid class="h-10 text-brand"/>
                    <span>YABT</span>
                </a>
            </x-slot>
            <x-menu-item :route-name="'budget.index'">
                {{ __('Budget') }}
            </x-menu-item>
            <x-menu-item :route-name="'budget_category.index'">
                {{ __('Budget Categories') }}
            </x-menu-item>
            <x-menu-item :route-name="'spend_item.index'">
                {{ __('Spend Items') }}
            </x-menu-item>
        </x-menu>

        <main class="container mx-auto">
            @yield('content') @if( isset($slot) ) {{ $slot }} @endif
        </main>

        @livewireScripts
    </div>
</body>
</html>
