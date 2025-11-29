<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Live Preview') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Langkah 2: Verifikasi tampilan website sebelum deployment.
                </p>
            </div>
            <div class="flex items-center gap-2 px-3 py-1 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full text-xs font-bold uppercase tracking-wider border border-amber-100 dark:border-amber-800">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                Review Mode
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-4 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in-down">
                    <div class="bg-emerald-100 dark:bg-emerald-800 p-1.5 rounded-full">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col xl:flex-row justify-between items-center gap-6">
                    
                    <div class="flex items-center gap-4 w-full xl:w-auto">
                        <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl text-indigo-600 dark:text-indigo-400 flex-shrink-0">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Preview Session</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Expires {{ $project->expires_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap gap-3 w-full xl:w-auto">
                        <a href="{{ route('dashboard') }}" 
                           class="flex-1 sm:flex-none justify-center px-4 py-2.5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-300 dark:border-slate-600 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-white font-semibold transition-all flex items-center gap-2 group order-1 sm:order-none">
                            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>

                        <a href="{{ url('/preview/' . $project->preview_token . $indexPath) }}" target="_blank" 
                           class="flex-1 sm:flex-none justify-center px-4 py-2.5 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-600 font-semibold transition-colors flex items-center gap-2 order-2 sm:order-none">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            <span class="whitespace-nowrap">New Tab</span>
                        </a>

                        <a href="{{ route('orders.create', $project) }}" 
                           class="flex-1 sm:flex-none justify-center px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 flex items-center gap-2 min-w-[140px] order-3 sm:order-none">
                            Lanjut Order
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="bg-indigo-900 text-white rounded-2xl p-6 shadow-sm flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 rounded-full blur-3xl opacity-20 -mr-10 -mt-10"></div>
                    <h4 class="font-bold mb-3 relative z-10 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Next Steps
                    </h4>
                    <div class="space-y-3 relative z-10">
                        <div class="flex items-center gap-3 opacity-50">
                            <div class="w-6 h-6 rounded-full bg-indigo-800 flex items-center justify-center text-xs">1</div>
                            <span class="text-sm line-through">Upload Assets</span>
                        </div>
                        <div class="flex items-center gap-3 font-semibold">
                            <div class="w-6 h-6 rounded-full bg-white text-indigo-900 flex items-center justify-center text-xs">2</div>
                            <span class="text-sm">Preview & Verify</span>
                        </div>
                        <div class="flex items-center gap-3 opacity-70">
                            <div class="w-6 h-6 rounded-full bg-indigo-800 border border-indigo-700 flex items-center justify-center text-xs">3</div>
                            <span class="text-sm">Payment & Domain</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl overflow-hidden shadow-2xl shadow-slate-200/50 dark:shadow-black/30 border border-slate-200 dark:border-slate-700 bg-slate-900">
                <div class="bg-slate-100 dark:bg-slate-800 px-4 py-3 flex items-center gap-4 border-b border-slate-200 dark:border-slate-700">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-rose-500 hover:bg-rose-600 transition-colors"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500 hover:bg-amber-600 transition-colors"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500 hover:bg-emerald-600 transition-colors"></div>
                    </div>
                    
                    <div class="flex-1 bg-white dark:bg-slate-900 rounded-lg h-8 flex items-center px-3 text-xs sm:text-sm text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700 shadow-sm mx-2 sm:mx-0">
                        <svg class="w-3 h-3 mr-2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span class="truncate">https://preview.68hosting.zone.id/{{ $project->preview_token }}</span>
                    </div>

                    <div class="hidden sm:flex gap-3 text-slate-400">
                        <svg class="w-4 h-4 hover:text-slate-600 dark:hover:text-slate-200 transition-colors cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                </div>

                <div class="relative w-full h-[600px] sm:h-[700px] bg-white">
                    <iframe 
                        src="{{ url('/preview/' . $project->preview_token . $indexPath) }}" 
                        class="w-full h-full border-0"
                        sandbox="allow-scripts allow-same-origin allow-forms"
                        loading="lazy"
                        title="Website Preview">
                    </iframe>
                </div>
            </div>

            <div class="text-center">
                <p class="text-sm text-slate-400">
                    Preview tidak muncul? <a href="{{ url('/preview/' . $project->preview_token . $indexPath) }}" target="_blank" class="text-indigo-600 hover:underline">Klik di sini</a> untuk membuka langsung.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>