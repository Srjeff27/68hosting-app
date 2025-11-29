<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Riwayat Order') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Kelola dan pantau status semua pesanan hosting Anda.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($orders->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($orders as $order)
                        <div
                            class="group bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:border-indigo-500/30 dark:hover:border-indigo-500/30 transition-all duration-300 relative flex flex-col h-full">

                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-50 to-slate-100 dark:from-slate-700 dark:to-slate-800 border border-slate-100 dark:border-slate-600 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>

                                @php
                                    $statusConfig = [
                                        'approved' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-100', 'label' => 'Active'],
                                        'paid' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-100', 'label' => 'Active'],
                                        'pending' => ['bg' => 'bg-amber-50 text-amber-700 border-amber-100', 'label' => 'Sedang Diproses'],
                                        'rejected' => ['bg' => 'bg-rose-50 text-rose-700 border-rose-100', 'label' => 'Rejected'],
                                        'cancelled' => ['bg' => 'bg-slate-50 text-slate-600 border-slate-100', 'label' => 'Cancelled'],
                                        'failed' => ['bg' => 'bg-rose-50 text-rose-700 border-rose-100', 'label' => 'Failed'],
                                    ];
                                    $config = $statusConfig[$order->status] ?? $statusConfig['pending'];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $config['bg'] }}">
                                    {{ $config['label'] }}
                                </span>
                            </div>

                            <div class="mb-6 flex-grow">
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-1 truncate"
                                    title="{{ $order->domain_name }}">
                                    {{ $order->domain_name }}.zone.id
                                </h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">
                                    Order #{{ $order->id }}
                                </p>

                                <div class="space-y-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Total</span>
                                        <span
                                            class="font-bold text-slate-800 dark:text-white">{{ $order->formatted_amount }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Tanggal</span>
                                        <span
                                            class="font-medium text-slate-800 dark:text-white">{{ $order->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100 dark:border-slate-700">
                                <a href="{{ route('orders.show', $order) }}"
                                    class="flex w-full justify-center items-center px-4 py-2 bg-indigo-50 text-indigo-700 border border-indigo-100 text-sm font-semibold rounded-lg hover:bg-indigo-100 transition-colors">
                                    Lihat Detail
                                </a>
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
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada riwayat order</h3>
                    <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto leading-relaxed">
                        Anda belum melakukan pemesanan layanan hosting apapun.
                    </p>
                    <a href="{{ route('projects.create') }}"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-xl shadow-indigo-500/20 hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Project Baru
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>