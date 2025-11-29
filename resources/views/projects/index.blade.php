<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Portfolio Project') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Kelola semua website statis yang telah Anda upload.
                </p>
            </div>
            <a href="{{ route('projects.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-500/30 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Upload Project Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div
                    class="mb-8 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-4 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in-down">
                    <div class="bg-emerald-100 dark:bg-emerald-800 p-1.5 rounded-full">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div
                            class="group bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:border-indigo-500/30 dark:hover:border-indigo-500/30 transition-all duration-300 relative flex flex-col h-full">

                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-50 to-slate-100 dark:from-slate-700 dark:to-slate-800 border border-slate-100 dark:border-slate-600 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div>

                                @php
                                    $statusConfig = [
                                        'active' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-100', 'label' => 'Live'],
                                        'approved' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-100', 'label' => 'Live'],
                                        'paid' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-100', 'label' => 'Live'],
                                        'waiting_payment' => ['bg' => 'bg-amber-50 text-amber-700 border-amber-100', 'label' => 'Sedang Diproses'],
                                        'temp' => ['bg' => 'bg-blue-50 text-blue-700 border-blue-100', 'label' => 'Draft'],
                                        'rejected' => ['bg' => 'bg-rose-50 text-rose-700 border-rose-100', 'label' => 'Rejected'],
                                        'expired' => ['bg' => 'bg-slate-50 text-slate-600 border-slate-100', 'label' => 'Expired'],
                                    ];

                                    $displayStatus = $project->status;
                                    if ($project->order && in_array($project->order->status, ['paid', 'approved'])) {
                                        $displayStatus = 'active';
                                    }

                                    $config = $statusConfig[$displayStatus] ?? $statusConfig['expired'];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $config['bg'] }}">
                                    {{ $config['label'] }}
                                </span>
                            </div>

                            <div class="mb-6 flex-grow">
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-1 truncate"
                                    title="{{ $project->domain_name }}">
                                    {{ $project->domain_name ? $project->domain_name . '.zone.id' : 'Draft Project #' . $project->id }}
                                </h3>

                                <div class="space-y-2 mt-4">
                                    <div class="flex items-center text-xs text-slate-500 dark:text-slate-400">
                                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $project->created_at->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center text-xs text-slate-500 dark:text-slate-400">
                                        <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                        </svg>
                                        {{ $project->file_size ? number_format($project->file_size / 1024, 2) . ' KB' : '0 KB' }}
                                    </div>
                                    @if($project->status === 'temp' && $project->expires_at)
                                        <div
                                            class="flex items-center text-xs text-amber-600 font-medium bg-amber-50 rounded px-2 py-1 w-fit mt-1">
                                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Exp: {{ $project->expires_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center gap-3">
                                @php
                                    $isLive = in_array($project->status, ['active', 'approved', 'paid']) ||
                                        ($project->order && in_array($project->order->status, ['paid', 'approved']));
                                @endphp

                                @if($isLive)
                                    <a href="https://{{ $project->domain_name }}.zone.id" target="_blank"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-semibold rounded-lg hover:bg-indigo-100 transition-colors">
                                        Visit Site
                                    </a>
                                @elseif($project->status === 'temp')
                                    <a href="{{ route('projects.preview', $project->preview_token) }}"
                                        class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-slate-50 rounded-lg transition-colors border border-slate-200"
                                        title="Preview">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('orders.create', $project) }}"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-200">
                                        Order Now
                                    </a>
                                @elseif($project->status === 'waiting_payment')
                                    <a href="{{ route('orders.show', $project->order) }}"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-amber-50 text-amber-700 border border-amber-200 text-sm font-semibold rounded-lg hover:bg-amber-100 transition-colors">
                                        View Invoice
                                    </a>
                                @else
                                    <div class="flex-1"></div>
                                @endif

                                @can('delete', $project)
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                        onsubmit="return confirm('Hapus project ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                            title="Delete Project">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="bg-white dark:bg-slate-800 rounded-3xl p-10 text-center border-2 border-dashed border-slate-200 dark:border-slate-700">
                    <div
                        class="w-20 h-20 bg-slate-50 dark:bg-slate-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada project</h3>
                    <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto leading-relaxed">
                        Anda belum mengupload website apapun. Mulai langkah awal Anda dengan mengupload file HTML, CSS, dan
                        JS.
                    </p>
                    <a href="{{ route('projects.create') }}"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-xl shadow-indigo-500/20 hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Upload Project Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>