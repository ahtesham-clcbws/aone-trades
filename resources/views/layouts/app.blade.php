<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) && $title ? ($title . ' | Aone Trades') : 'Aone Trades - Trade Became Easy' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-200">
    <x-banner />

    {{-- The navbar with `sticky` and `full-width` --}}
    <x-mary-nav sticky full-width>

        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <div>
                <img src="/img/w-logo.png" alt="logo" width="190">
            </div>
            <!-- Saturday 26th of October 2024 01:18:26 PM -->

            <div class="ms-5 hidden lg:block text-center w-full text-xl font-semibold">
                <livewire:panel.current-date />
            </div>
        </x-slot:brand>
        {{-- Right side actions --}}
        <x-slot:actions>
            {{--<div class="ms-1 relative">
                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <x-mary-button icon="o-bell" class="btn-circle btn-sm indicator">
                            <span class="indicator-item badge badge-success badge-xs"></span>
                        </x-mary-button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs font-semibold border-b">
                            {{ __('Notifications') }}
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>--}}
            <div class="ms-1 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('user.account.profile') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}"
                                @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                    </x-mary-dropdown>
            </div>
        </x-slot:actions>
    </x-mary-nav>

    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-slate-50">

            {{-- User --}}
            @if($user = auth()->user())
            <x-mary-list-item :item="$user" value="name" avatar="profile_photo_url" no-separator no-hover class="pt-2">
                <x-slot:sub-value>
                    <x-mary-badge value="{{$user->getKycStatusBadgeData()['value']}}" class="{{$user->getKycStatusBadgeData()['class']}}" />
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                </x-slot:actions>
            </x-mary-list-item>

            <x-mary-menu-separator />
            @endif

            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-mary-menu activate-by-route>
                <x-mary-menu-item title="Home" icon="o-home" link="{{ route('user.dashboard') }}" />

                <x-mary-menu-sub title="Manage Funds" icon="o-circle-stack">
                    <x-mary-menu-item title="Deposit" link="{{ route('user.fund.deposit') }}" />
                    <x-mary-menu-item title="Withdraw" link="{{ route('user.fund.withdraw') }}" />
                </x-mary-menu-sub>

                <x-mary-menu-sub title="Transactions" icon="o-currency-dollar">
                    <x-mary-menu-item title="Deposit" link="{{ route('user.history.deposit') }}" />
                    <x-mary-menu-item title="Withdraw" link="{{ route('user.history.withdraw') }}" />
                </x-mary-menu-sub>

                <x-mary-menu-item title="Manage Account" icon="o-users" link="{{ route('user.account.profile') }}" />
                <x-mary-menu-item title="Compliance" icon="o-check-badge" link="{{ route('user.account.kyc') }}" />
                <x-mary-menu-item title="Downloads" icon="o-arrow-down-tray" link="{{ route('user.downloads') }}" />
                <x-mary-menu-item title="Help" icon="o-question-mark-circle" link="{{ route('user.help') }}" />
            </x-mary-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />

    @stack('modals')

    @livewireScripts
</body>

</html>
