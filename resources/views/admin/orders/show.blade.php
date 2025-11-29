<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-1">
                    <a href="{{ route('admin.orders.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        Pesanan
                    </a>
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span>Detail #{{ $order->id }}</span>
                </div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    Rincian Pesanan
                </h2>
            </div>
            <div class="flex items-center gap-3">
                @php
                    $statusConfig = [
                        'paid' => ['bg' => 'bg-emerald-100 text-emerald-700 border-emerald-200', 'label' => 'Terbayar'],
                        'approved' => ['bg' => 'bg-emerald-100 text-emerald-700 border-emerald-200', 'label' => 'Disetujui'],
                        'pending' => ['bg' => 'bg-amber-100 text-amber-700 border-amber-200', 'label' => 'Menunggu'],
                        'cancelled' => ['bg' => 'bg-slate-100 text-slate-700 border-slate-200', 'label' => 'Dibatalkan'],
                        'rejected' => ['bg' => 'bg-rose-100 text-rose-700 border-rose-200', 'label' => 'Ditolak'],
                        'failed' => ['bg' => 'bg-rose-100 text-rose-700 border-rose-200', 'label' => 'Gagal'],
                    ];
                    $config = $statusConfig[$order->status] ?? ['bg' => 'bg-slate-100 text-slate-700 border-slate-200', 'label' => ucfirst($order->status)];
                @endphp
                <span class="px-4 py-2 rounded-lg text-sm font-bold border {{ $config['bg'] }}">
                    {{ $config['label'] }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Details -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Client & Project Information -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-700/50">
                            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Informasi Klien & Project
                            </h3>
                        </div>
                        <div class="p-6 grid sm:grid-cols-2 gap-x-8 gap-y-6">
                            
                            <!-- User Info -->
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Pemesan</label>
                                <div class="flex items-start gap-3">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold shrink-0">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">{{ $order->user->name }}</p>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $order->user->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Kontak</label>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $order->email ?? $order->user->email }}
                                    </div>
                                    @if($order->whatsapp_number)
                                        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                            </svg>
                                            {{ $order->whatsapp_number }}
                                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->whatsapp_number)) }}" target="_blank" class="text-xs font-semibold text-indigo-600 hover:underline">(Chat)</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Domain -->
                            <div class="sm:col-span-2 border-t border-slate-100 dark:border-slate-700 pt-6 mt-2">
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Request Domain</label>
                                <div class="flex items-center gap-3">
                                    <div class="bg-slate-100 dark:bg-slate-700 px-4 py-2 rounded-lg font-mono text-lg font-bold text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-600">
                                        {{ $order->domain_name ?? 'Belum diset' }}<span class="text-slate-400">.zone.id</span>
                                    </div>
                                    <a href="https://{{ $order->domain_name ?? '' }}.zone.id" target="_blank" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="Cek URL">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Project Files -->
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">File Project</label>
                                @if($order->project)
                                    <div class="flex items-center justify-between p-4 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-white dark:bg-slate-800 rounded-lg text-indigo-600 dark:text-indigo-400 shadow-sm">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-800 dark:text-white">Source Code</p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">Ukuran: {{ number_format($order->project->file_size / 1024, 2) }} KB</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.orders.download-project', $order) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg transition-colors shadow-sm flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                @else
                                    <p class="text-slate-400 italic text-sm">Tidak ada file project terkait.</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <!-- Payment Proof -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-700/50">
                            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Bukti Pembayaran
                            </h3>
                        </div>
                        <div class="p-6">
                            @if($order->payment_proof)
                                <div class="grid md:grid-cols-2 gap-6 items-start">
                                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-900 group relative">
                                        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-auto object-contain max-h-[400px]">
                                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white font-bold gap-2">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                            Perbesar
                                        </a>
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nominal Transaksi</label>
                                            <p class="text-2xl font-bold text-slate-900 dark:text-white">Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Status Pembayaran</label>
                                            <p class="text-sm text-slate-600 dark:text-slate-300">
                                                Pastikan nominal sesuai dan bukti transfer valid sebelum menyetujui pesanan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-12 bg-slate-50 dark:bg-slate-700/30 rounded-xl border border-dashed border-slate-300 dark:border-slate-600">
                                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada bukti pembayaran yang diupload.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Right Column: Actions -->
                <div class="lg:col-span-1 space-y-8">
                    
                    <!-- Admin Actions -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden sticky top-6">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-700/50">
                            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Tindakan Admin
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            
                            <!-- Update Status Form -->
                            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="admin_notes" value="{{ $order->admin_notes }}">

                                <div>
                                    <label for="status" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Update Status</label>
                                    <select name="status" id="status" class="block w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $order->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                                    Simpan Perubahan
                                </button>
                            </form>

                            <hr class="border-slate-200 dark:border-slate-700">

                            <!-- Admin Notes -->
                            <div>
                                <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Catatan Internal</h4>
                                
                                @if($order->admin_notes)
                                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4 mb-4 relative group">
                                        <p class="text-sm text-amber-800 dark:text-amber-200 italic">"{{ $order->admin_notes }}"</p>
                                        
                                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus catatan ini?');">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="{{ $order->status }}">
                                            <input type="hidden" name="admin_notes" value="">
                                            <button type="submit" class="text-rose-500 hover:text-rose-700 bg-white dark:bg-slate-800 rounded-full p-1 shadow-sm">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ $order->status }}">
                                    
                                    <div class="relative">
                                        <textarea name="admin_notes" id="admin_notes" rows="3" class="block w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-slate-700 dark:text-slate-300 focus:border-amber-500 focus:ring-amber-500 sm:text-sm placeholder-slate-400" placeholder="{{ $order->admin_notes ? 'Perbarui catatan...' : 'Tambahkan catatan...' }}">{{ $order->admin_notes }}</textarea>
                                    </div>
                                    <button type="submit" class="mt-2 w-full flex justify-center py-2 px-4 border border-slate-300 dark:border-slate-600 rounded-xl shadow-sm text-sm font-semibold text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                                        {{ $order->admin_notes ? 'Perbarui Catatan' : 'Kirim Catatan' }}
                                    </button>
                                </form>
                            </div>

                            <hr class="border-slate-200 dark:border-slate-700">

                            <!-- Meta Info -->
                            <div>
                                <div class="flex justify-between text-xs text-slate-500 dark:text-slate-400 mb-1">
                                    <span>Created:</span>
                                    <span class="font-mono">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between text-xs text-slate-500 dark:text-slate-400">
                                    <span>Updated:</span>
                                    <span class="font-mono">{{ $order->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>