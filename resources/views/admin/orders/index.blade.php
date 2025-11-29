<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Manajemen Pesanan') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Daftar seluruh transaksi hosting yang masuk.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 bg-white dark:bg-slate-800 rounded-lg text-xs font-bold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 shadow-sm">
                    Total: {{ $orders->total() }} Data
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                
                <!-- Desktop Table View (Hidden on Mobile) -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold">
                                <th class="px-6 py-4">Order ID</th>
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Domain</th>
                                <th class="px-6 py-4">Nominal</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @forelse($orders as $order)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors group">
                                    <td class="px-6 py-4">
                                        <span class="font-mono text-sm font-bold text-indigo-600 dark:text-indigo-400">#{{ $order->id }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold text-xs">
                                                {{ substr($order->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $order->user->name }}</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $order->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                            <span class="text-sm text-slate-600 dark:text-slate-300 font-mono">{{ $order->domain }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-slate-900 dark:text-white font-mono">
                                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusConfig = [
                                                'paid' => ['bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'text' => 'text-emerald-700 dark:text-emerald-400', 'border' => 'border-emerald-100 dark:border-emerald-800', 'label' => 'Paid'],
                                                'approved' => ['bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'text' => 'text-emerald-700 dark:text-emerald-400', 'border' => 'border-emerald-100 dark:border-emerald-800', 'label' => 'Approved'],
                                                'pending' => ['bg' => 'bg-amber-50 dark:bg-amber-900/20', 'text' => 'text-amber-700 dark:text-amber-400', 'border' => 'border-amber-100 dark:border-amber-800', 'label' => 'Pending'],
                                                'cancelled' => ['bg' => 'bg-rose-50 dark:bg-rose-900/20', 'text' => 'text-rose-700 dark:text-rose-400', 'border' => 'border-rose-100 dark:border-rose-800', 'label' => 'Cancelled'],
                                                'rejected' => ['bg' => 'bg-rose-50 dark:bg-rose-900/20', 'text' => 'text-rose-700 dark:text-rose-400', 'border' => 'border-rose-100 dark:border-rose-800', 'label' => 'Rejected'],
                                            ];
                                            $config = $statusConfig[$order->status] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'border' => 'border-slate-100', 'label' => $order->status];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }}">
                                            @if($order->status === 'pending')
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse mr-1.5"></span>
                                            @endif
                                            {{ ucfirst($config['label']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-500 dark:text-slate-400">
                                            {{ $order->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500">
                                            {{ $order->created_at->format('H:i') }} WIB
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 dark:hover:bg-indigo-900/50 dark:hover:text-indigo-400 transition-all">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p>Belum ada data pesanan yang tersedia.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View (Visible on Mobile) -->
                <div class="md:hidden">
                    <div class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($orders as $order)
                            <div class="p-5 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold text-sm">
                                            {{ substr($order->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $order->user->name }}</div>
                                            <div class="text-xs font-mono text-indigo-600 dark:text-indigo-400">#{{ $order->id }}</div>
                                        </div>
                                    </div>
                                    
                                    @php
                                        // Re-use logic for mobile
                                        $statusConfig = [
                                            'paid' => ['bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'text' => 'text-emerald-700 dark:text-emerald-400', 'label' => 'Paid'],
                                            'approved' => ['bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'text' => 'text-emerald-700 dark:text-emerald-400', 'label' => 'Approved'],
                                            'pending' => ['bg' => 'bg-amber-50 dark:bg-amber-900/20', 'text' => 'text-amber-700 dark:text-amber-400', 'label' => 'Pending'],
                                            'cancelled' => ['bg' => 'bg-rose-50 dark:bg-rose-900/20', 'text' => 'text-rose-700 dark:text-rose-400', 'label' => 'Cancelled'],
                                            'rejected' => ['bg' => 'bg-rose-50 dark:bg-rose-900/20', 'text' => 'text-rose-700 dark:text-rose-400', 'label' => 'Rejected'],
                                        ];
                                        $config = $statusConfig[$order->status] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'label' => $order->status];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $config['bg'] }} {{ $config['text'] }}">
                                        {{ ucfirst($config['label']) }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Domain</p>
                                        <p class="font-medium text-slate-800 dark:text-slate-200 truncate">{{ $order->domain }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-1">Nominal</p>
                                        <p class="font-bold text-slate-800 dark:text-white">Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-700">
                                    <span class="text-xs text-slate-400">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </span>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-500 dark:text-slate-400">
                                Belum ada data pesanan.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                    {{ $orders->links() }}
                </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>