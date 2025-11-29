<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Dashboard Admin') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Ringkasan Sistem & Kontrol Manajemen
                </p>
            </div>
            <div
                class="flex items-center gap-2 px-3 py-1 bg-slate-100 dark:bg-slate-700 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-600">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Sistem Online
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div
                class="relative overflow-hidden bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-8 shadow-xl">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-white opacity-5 blur-3xl">
                </div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold text-white mb-2">Selamat datang kembali, Administrator! 👋</h3>
                    <p class="text-slate-300 max-w-xl">
                        Berikut adalah laporan terkini platform hosting Anda hari ini. Terdapat pesanan yang memerlukan
                        verifikasi dan tindakan Anda.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 relative overflow-hidden group hover:border-indigo-500/50 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p
                                class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                Total Pesanan</p>
                            <h4 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">
                                {{ \App\Models\Order::count() }}
                            </h4>
                        </div>
                        <div
                            class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl text-indigo-600 dark:text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-slate-500">
                        <span class="text-indigo-600 font-medium flex items-center gap-1">
                            Total keseluruhan
                        </span>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 relative overflow-hidden group hover:border-amber-500/50 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p
                                class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                Menunggu Verifikasi</p>
                            <h4 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">
                                {{ \App\Models\Order::where('status', 'pending')->count() }}
                            </h4>
                        </div>
                        <div
                            class="p-3 bg-amber-50 dark:bg-amber-900/30 rounded-xl text-amber-600 dark:text-amber-400 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-slate-500">
                        @if(\App\Models\Order::where('status', 'pending')->count() > 0)
                            <span class="text-amber-600 font-medium flex items-center gap-1">
                                Perlu tindakan segera
                            </span>
                        @else
                            <span class="text-emerald-600 font-medium flex items-center gap-1">
                                Semua tugas selesai
                            </span>
                        @endif
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 relative overflow-hidden group hover:border-emerald-500/50 transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p
                                class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                Project Live</p>
                            <h4 class="text-3xl font-bold text-slate-900 dark:text-white mt-2">
                                {{ \App\Models\Project::where('status', 'active')->count() }}
                            </h4>
                        </div>
                        <div
                            class="p-3 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-slate-500">
                        <span class="text-emerald-600 font-medium flex items-center gap-1">
                            Sistem berjalan optimal
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Manajemen Cepat</h3>
                    <div class="space-y-4">
                        <a href="{{ route('admin.orders.index') }}"
                            class="group flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-100 dark:border-slate-600 hover:bg-white dark:hover:bg-slate-700 hover:border-indigo-300 dark:hover:border-indigo-500 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <div
                                    class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg text-indigo-600 dark:text-indigo-400">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <h4
                                        class="font-bold text-slate-800 dark:text-white group-hover:text-indigo-600 transition-colors">
                                        Kelola Pesanan</h4>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Verifikasi pembayaran dan
                                        setujui deployment</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <!-- User Management Module -->
                        <a href="{{ route('admin.users.index') }}"
                            class="group flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-100 dark:border-slate-600 hover:bg-white dark:hover:bg-slate-700 hover:border-indigo-300 dark:hover:border-indigo-500 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <div
                                    class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg text-indigo-600 dark:text-indigo-400">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4
                                        class="font-bold text-slate-800 dark:text-white group-hover:text-indigo-600 transition-colors">
                                        User Management</h4>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Manage users and roles</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:translate-x-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex flex-col justify-center items-center text-center">
                    <div
                        class="w-20 h-20 bg-slate-50 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">Performa Sistem</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 max-w-xs">
                        Semua sistem berjalan lancar. Penggunaan disk dan beban server dalam batas normal.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>