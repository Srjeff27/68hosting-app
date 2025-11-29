<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-slate-50 text-slate-600 dark:bg-slate-900 dark:text-slate-400">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        <div class="absolute inset-0 -z-10">
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-indigo-500/10 dark:bg-indigo-500/20 blur-[100px] rounded-full mix-blend-multiply">
            </div>
            <div
                class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150">
            </div>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white dark:bg-slate-900/95 border border-slate-200 dark:border-slate-800 shadow-2xl shadow-indigo-500/10 sm:rounded-2xl relative z-10 backdrop-blur-sm transition-all duration-300">
            <div class="flex justify-center mb-8">
                <a href="/" class="flex items-center gap-3 group">
                    <div
                        class="p-2.5 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">68<span
                            class="text-indigo-600">Hosting</span></span>
                </a>
            </div>

            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-xs text-slate-400 dark:text-slate-500">
            &copy; {{ date('Y') }} 68Hosting. Academic Standard Platform.
        </div>
    </div>
</body>

</html>