<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Rincian Order') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Lacak status pembayaran dan aktivasi layanan.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-mono text-slate-400">Order ID</span>
                <span
                    class="px-3 py-1 bg-slate-100 dark:bg-slate-700 rounded-lg text-slate-700 dark:text-slate-200 font-mono font-bold">#{{ $order->id }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            Informasi Layanan
                        </h3>

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Target Domain</p>
                                @if($order->status === 'approved' || $order->status === 'paid')
                                    <p
                                        class="text-xl font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-2">
                                        {{ $order->domain_name }}.zone.id
                                        <a href="https://{{ $order->domain_name }}.zone.id" target="_blank"
                                            class="text-slate-400 hover:text-indigo-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </p>
                                @else
                                    <div class="flex flex-col items-start">
                                        <p
                                            class="text-xl font-bold text-rose-600 dark:text-rose-400 flex items-center gap-2">
                                            {{ $order->domain_name }}.zone.id
                                        </p>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-300 mt-1">
                                            <svg class="mr-1.5 h-2 w-2 text-rose-500" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Belum Aktif
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Total Pembayaran</p>
                                <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">
                                    {{ $order->formatted_amount }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Informasi Kontak</p>
                                <div class="flex flex-col gap-1">
                                    <p class="text-base font-medium text-slate-800 dark:text-slate-200 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $order->email ?? $order->user->email }}
                                    </p>
                                    @if($order->whatsapp_number)
                                        <p class="text-base font-medium text-slate-800 dark:text-slate-200 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                            </svg>
                                            {{ $order->whatsapp_number }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Tanggal Order</p>
                                <p class="text-base font-medium text-slate-800 dark:text-slate-200">
                                    {{ $order->created_at->format('d F Y, H:i') }}
                                </p>
                            </div>
                            @if($order->verified_at)
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Diverifikasi Pada</p>
                                    <p class="text-base font-medium text-slate-800 dark:text-slate-200">
                                        {{ $order->verified_at->format('d F Y, H:i') }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($order->payment_proof)
                        <div
                            class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Bukti Pembayaran
                            </h3>

                            <button onclick="openProofModal()"
                                class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors group">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Lihat Bukti Pembayaran
                            </button>
                        </div>
                    @endif

                    @if($order->admin_notes)
                        <div
                            class="bg-amber-50 dark:bg-amber-900/10 rounded-2xl p-6 border border-amber-100 dark:border-amber-800/50">
                            <h3 class="text-lg font-bold text-amber-800 dark:text-amber-400 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                Catatan Admin
                            </h3>
                            <p
                                class="text-amber-900 dark:text-amber-200 leading-relaxed bg-white dark:bg-slate-800 p-4 rounded-xl border border-amber-100 dark:border-amber-800 shadow-sm">
                                "{{ $order->admin_notes }}"
                            </p>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-1 space-y-6">

                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                        <h3 class="font-bold text-slate-800 dark:text-white mb-6">Status Deployment</h3>

                        <div class="relative pl-4 border-l-2 border-slate-200 dark:border-slate-700 space-y-8">

                            <div class="relative">
                                <div
                                    class="absolute -left-[21px] w-4 h-4 rounded-full bg-emerald-500 ring-4 ring-white dark:ring-slate-800">
                                </div>
                                <h4 class="text-sm font-bold text-slate-900 dark:text-white">Order Dibuat</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>

                            <div class="relative">
                                <div
                                    class="absolute -left-[21px] w-4 h-4 rounded-full bg-emerald-500 ring-4 ring-white dark:ring-slate-800">
                                </div>
                                <h4 class="text-sm font-bold text-slate-900 dark:text-white">Bukti Pembayaran Diupload
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Menunggu konfirmasi sistem
                                </p>
                            </div>

                            <div class="relative">
                                @if($order->status === 'approved' || $order->status === 'paid')
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full bg-emerald-500 ring-4 ring-white dark:ring-slate-800">
                                    </div>
                                    <h4 class="text-sm font-bold text-emerald-600 dark:text-emerald-400">Verifikasi Berhasil
                                    </h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Disetujui oleh Admin</p>
                                @elseif($order->status === 'rejected')
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full bg-rose-500 ring-4 ring-white dark:ring-slate-800">
                                    </div>
                                    <h4 class="text-sm font-bold text-rose-600 dark:text-rose-400">Ditolak</h4>
                                    <p class="text-xs text-rose-500 dark:text-rose-400 mt-1">Cek catatan admin</p>
                                @else
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full bg-amber-500 animate-pulse ring-4 ring-white dark:ring-slate-800">
                                    </div>
                                    <h4 class="text-sm font-bold text-amber-600 dark:text-amber-400">Sedang Diverifikasi
                                    </h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Estimasi 1x24 Jam</p>
                                @endif
                            </div>

                            <div class="relative">
                                @if($order->status === 'approved' || $order->status === 'paid')
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full bg-indigo-600 ring-4 ring-white dark:ring-slate-800">
                                    </div>
                                    <h4 class="text-sm font-bold text-indigo-600 dark:text-indigo-400">Website Live</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Dapat diakses publik</p>
                                @else
                                    <div
                                        class="absolute -left-[21px] w-4 h-4 rounded-full bg-slate-200 dark:bg-slate-600 ring-4 ring-white dark:ring-slate-800">
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-400">Website Live</h4>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($order->status === 'approved' || $order->status === 'paid')
                        <div
                            class="bg-gradient-to-br from-indigo-600 to-violet-600 rounded-2xl p-6 text-white shadow-xl shadow-indigo-200 dark:shadow-none text-center">
                            <div
                                class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold mb-2">Selamat! 🎉</h3>
                            <p class="text-indigo-100 text-sm mb-6">Website Anda sudah online dan dapat diakses dari seluruh
                                dunia.</p>
                            <a href="https://{{ $order->domain_name }}.zone.id" target="_blank"
                                class="inline-flex w-full justify-center items-center px-4 py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors">
                                Kunjungi Website
                            </a>
                        </div>
                    @else
                        <div
                            class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 text-center">
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Butuh bantuan terkait order ini?</p>
                            <a href="#"
                                class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 font-semibold hover:underline">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Hubungi Admin
                            </a>
                        </div>
                    @endif

                    <a href="{{ route('dashboard') }}"
                        class="flex w-full justify-center items-center px-4 py-3 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-bold rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                        Kembali ke Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>

    @if($order->payment_proof)
        <div id="proofModal"
            class="hidden fixed inset-0 z-[100] bg-slate-900/90 backdrop-blur-sm flex items-center justify-center p-4"
            onclick="closeProofModal()">
            <div class="relative max-w-lg w-full bg-transparent transform scale-95 opacity-0 transition-all duration-300"
                id="proofModalContent" onclick="event.stopPropagation()">
                <button onclick="closeProofModal()"
                    class="absolute -top-12 right-0 text-white/80 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img src="{{ Storage::url($order->payment_proof) }}" alt="Payment Proof Full"
                    class="w-full h-auto rounded-lg shadow-2xl max-h-[80vh] object-contain bg-white dark:bg-slate-800">
            </div>
        </div>
    @endif

    <script>
        function openProofModal() {
            const modal = document.getElementById('proofModal');
            const content = document.getElementById('proofModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeProofModal() {
            const modal = document.getElementById('proofModal');
            const content = document.getElementById('proofModalContent');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === "Escape") closeProofModal();
        });
    </script>
</x-app-layout>