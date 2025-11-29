<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Dashboard Overview') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Kelola project dan status deployment Anda.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="px-4 py-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                        {{ now()->format('d F Y') }}
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div
                    class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-4 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in-down">
                    <div class="bg-emerald-100 dark:bg-emerald-800 p-1.5 rounded-full">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div
                    class="bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400 px-4 py-4 rounded-xl shadow-sm">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-rose-100 dark:bg-rose-800 p-1.5 rounded-full">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <span class="font-bold">Terdapat kesalahan pada input Anda</span>
                    </div>
                    <ul class="list-disc list-inside text-sm space-y-1 ml-10 opacity-90">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div
                class="relative overflow-hidden bg-gradient-to-br from-indigo-600 to-violet-700 rounded-3xl shadow-xl shadow-indigo-200/50 dark:shadow-none p-8 sm:p-12">
                <div
                    class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 mix-blend-soft-light">
                </div>
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-white opacity-10 blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 rounded-full bg-indigo-400 opacity-20 blur-3xl">
                </div>

                <div class="relative flex flex-col md:flex-row items-center justify-between gap-8 z-10">
                    <div class="text-center md:text-left space-y-4 max-w-2xl">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-bold uppercase tracking-wider backdrop-blur-sm border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                            System Ready
                        </div>
                        <h3 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Publikasikan Karya <br /> Digital Anda
                        </h3>
                        <p class="text-indigo-100 text-lg leading-relaxed max-w-lg mx-auto md:mx-0">
                            Deploy website statis HTML, CSS, dan JS dengan infrastruktur akademik yang aman dan cepat.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('projects.create') }}"
                            class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-indigo-700 font-bold rounded-2xl hover:bg-indigo-50 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                            <span>Upload Project</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:shadow-none border border-slate-100 dark:border-slate-700 group hover:border-indigo-500/50 transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/40 transition-colors">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                        </div>
                        <span
                            class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">Active</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Project Berjalan</p>
                        <h4 class="text-3xl font-bold text-slate-800 dark:text-white mt-1">
                            {{ Auth::user()->projects()->where(function ($query) {
    $query->where('status', 'active')
        ->orWhereHas('order', function ($q) {
            $q->whereIn('status', ['paid', 'approved']);
        });
})->count() }}
                        </h4>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:shadow-none border border-slate-100 dark:border-slate-700 group hover:border-amber-500/50 transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-xl group-hover:bg-amber-100 dark:group-hover:bg-amber-900/40 transition-colors">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span
                            class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">Pending</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Sedang Diproses</p>
                        <h4 class="text-3xl font-bold text-slate-800 dark:text-white mt-1">
                            {{ Auth::user()->orders()->where('status', 'pending')->count() }}
                        </h4>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:shadow-none border border-slate-100 dark:border-slate-700 group hover:border-blue-500/50 transition-all duration-300">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl group-hover:bg-blue-100 dark:group-hover:bg-blue-900/40 transition-colors">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">Total</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Keseluruhan</p>
                        <h4 class="text-3xl font-bold text-slate-800 dark:text-white mt-1">
                            {{ Auth::user()->projects()->count() }}
                        </h4>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div
                    class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800">
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                        Project Terbaru
                    </h3>
                    <a href="{{ route('projects.index') }}"
                        class="group text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 flex items-center gap-1 transition-colors">
                        Lihat Semua
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                @php
                    $recentProjects = Auth::user()->projects()->latest()->take(5)->get();
                @endphp

                @if($recentProjects->count() > 0)
                    <div class="divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach($recentProjects as $project)
                            <div class="p-4 sm:p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-all duration-200">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 flex items-center justify-center flex-shrink-0 text-slate-500 dark:text-slate-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4
                                                class="font-bold text-slate-900 dark:text-white text-base hover:text-indigo-600 transition-colors">
                                                {{ $project->domain_name ?? 'Draft Project #' . $project->id }}
                                            </h4>
                                            <div
                                                class="flex items-center gap-3 mt-1.5 text-xs font-medium text-slate-500 dark:text-slate-400">
                                                <span
                                                    class="flex items-center gap-1 bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded text-slate-600 dark:text-slate-300">
                                                    {{ $project->created_at->format('d M Y') }}
                                                </span>
                                                <span>{{ $project->file_size ? number_format($project->file_size / 1024, 2) . ' KB' : '0 KB' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto">
                                        @php
                                            $statusConfig = [
                                                'active' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'label' => 'Active'],
                                                'approved' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'label' => 'Active'],
                                                'paid' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200', 'label' => 'Active'],
                                                'waiting_payment' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'border' => 'border-amber-200', 'label' => 'Sedang Diproses'],
                                                'temp' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'label' => 'Preview Mode'],
                                                'rejected' => ['bg' => 'bg-rose-100', 'text' => 'text-rose-700', 'border' => 'border-rose-200', 'label' => 'Rejected'],
                                                'expired' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-700', 'border' => 'border-slate-200', 'label' => 'Expired'],
                                            ];

                                            $displayStatus = $project->status;
                                            if ($project->order && in_array($project->order->status, ['paid', 'approved'])) {
                                                $displayStatus = 'active';
                                            }

                                            $config = $statusConfig[$displayStatus] ?? $statusConfig['expired'];
                                        @endphp

                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $config['bg'] }} {{ $config['text'] }} border {{ $config['border'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5 opacity-60"></span>
                                            {{ $config['label'] }}
                                        </span>

                                        <div class="flex items-center gap-1">
                                            @php
                                                $isLive = in_array($project->status, ['active', 'approved', 'paid']) ||
                                                    ($project->order && in_array($project->order->status, ['paid', 'approved']));
                                            @endphp

                                            @if($isLive)
                                                <a href="https://{{ $project->domain_name }}.zone.id" target="_blank"
                                                    class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                                    title="Visit Website">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </a>
                                            @elseif($project->status === 'temp')
                                                <a href="{{ route('projects.preview', $project->preview_token) }}"
                                                    class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                                    title="Preview Website">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 px-4">
                        <div
                            class="w-20 h-20 bg-slate-50 dark:bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6 border border-slate-100 dark:border-slate-600">
                            <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada project</h4>
                        <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-sm mx-auto">Mulai perjalanan digital Anda
                            dengan mengupload website pertama Anda hari ini.</p>
                        <a href="{{ route('projects.create') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all hover:-translate-y-0.5 shadow-md shadow-indigo-200 dark:shadow-none">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Project Baru
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>