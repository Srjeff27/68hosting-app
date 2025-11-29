<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-400">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen">

        <!-- Sidebar Component -->
        @include('layouts.navigation')

        <!-- Main Content Wrapper -->
        <div class="lg:pl-72 flex flex-col min-h-screen transition-all duration-300">

            <!-- Mobile Header -->
            <div
                class="lg:hidden sticky top-0 z-40 flex items-center justify-between bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 px-4 py-3 shadow-sm">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" type="button"
                        class="-m-2.5 p-2.5 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <span class="font-bold text-lg text-slate-900 dark:text-white">68<span
                            class="text-indigo-600">Hosting</span></span>
                </div>

                <!-- Mobile Profile Icon -->
                <div class="flex items-center">
                    <div
                        class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-xs">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-slate-800 shadow-sm border-b border-slate-200 dark:border-slate-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>