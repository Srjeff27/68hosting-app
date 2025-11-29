<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Finalisasi Deployment') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Langkah 3: Pilih identitas domain dan selesaikan pembayaran.
                </p>
            </div>
            <div
                class="flex items-center gap-2 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-xs font-bold uppercase tracking-wider border border-indigo-100 dark:border-indigo-800">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                Payment Phase
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($errors->any())
                <div
                    class="mb-8 bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400 px-4 py-4 rounded-xl flex items-start gap-3 shadow-sm animate-fade-in-down">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="font-bold">Terjadi Kesalahan</h4>
                        <ul class="list-disc list-inside text-sm mt-1 opacity-90">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('orders.store', $project) }}" enctype="multipart/form-data"
                class="grid lg:grid-cols-3 gap-8">
                @csrf

                <div class="lg:col-span-2 space-y-6">

                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg text-indigo-600 dark:text-indigo-400">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">Pilih Subdomain</h3>
                                    <button type="button" x-data @click="$dispatch('open-subdomain-info')"
                                        class="text-slate-400 hover:text-indigo-500 transition-colors"
                                        title="Apa itu subdomain?">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Tentukan alamat unik untuk website
                                    Anda.</p>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                Nama Domain <span class="text-rose-500">*</span>
                            </label>
                            <div
                                class="flex rounded-xl shadow-sm ring-1 ring-inset ring-slate-300 dark:ring-slate-700 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 bg-white dark:bg-slate-900 overflow-hidden">
                                <input type="text" name="domain_name" id="domain-input" value="{{ old('domain_name') }}"
                                    class="block flex-1 border-0 bg-transparent py-3.5 pl-4 text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-0 sm:text-sm sm:leading-6 font-medium"
                                    placeholder="nama-project-anda" required autocomplete="off">
                                <span
                                    class="flex select-none items-center bg-slate-50 dark:bg-slate-800 px-4 text-slate-500 dark:text-slate-400 border-l border-slate-200 dark:border-slate-700 font-mono text-sm">.zone.id</span>
                            </div>

                            <div id="domain-feedback" class="mt-3 min-h-[24px] text-sm flex items-center gap-2"></div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg text-blue-600 dark:text-blue-400">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Informasi Kontak</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Kami akan mengirimkan notifikasi
                                    ke kontak ini.</p>
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Nomor WhatsApp <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}"
                                    class="block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3.5"
                                    placeholder="081234567890" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    Email <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                    class="block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3.5"
                                    placeholder="email@example.com" required>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="p-2 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg text-emerald-600 dark:text-emerald-400">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Bukti Pembayaran</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Upload screenshot bukti pembayaran
                                    via QRIS.</p>
                            </div>
                        </div>

                        <div class="relative">
                            <label
                                class="group flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-2xl cursor-pointer bg-slate-50 dark:bg-slate-800/50 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-indigo-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="mb-2 text-sm text-slate-600 dark:text-slate-300"><span
                                            class="font-bold">Klik untuk upload</span> atau drag & drop</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">PNG, JPG, JPEG (Max. 5MB)</p>
                                    <p id="filename-display"
                                        class="mt-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400"></p>
                                </div>
                                <input type="file" name="payment_proof" id="payment-input" accept="image/*"
                                    class="hidden" required />
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('dashboard') }}"
                            class="px-6 py-3 text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                            Batalkan
                        </a>
                        <button type="submit" id="submit-btn" disabled
                            class="px-8 py-3 bg-slate-200 text-slate-400 font-bold rounded-xl cursor-not-allowed transition-all disabled:opacity-70 data-[ready=true]:bg-indigo-600 data-[ready=true]:text-white data-[ready=true]:cursor-pointer data-[ready=true]:shadow-lg data-[ready=true]:hover:bg-indigo-700">
                            Konfirmasi Order
                        </button>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">

                        <div
                            class="bg-indigo-600 rounded-2xl p-6 text-white shadow-xl shadow-indigo-200 dark:shadow-none relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl">
                            </div>

                            <h3 class="text-lg font-bold mb-6 border-b border-indigo-500 pb-4">Rincian Tagihan</h3>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-indigo-100 text-sm">
                                    <span>Hosting Plan (Lifetime)</span>
                                    <span>Rp 50.000</span>
                                </div>
                                <div class="flex justify-between text-indigo-100 text-sm">
                                    <span>Subdomain Setup</span>
                                    <span>Gratis</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-end border-t border-indigo-500 pt-4">
                                <span class="text-sm text-indigo-200">Total Bayar</span>
                                <span class="text-3xl font-bold">Rp 50.000</span>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
                            <h3 class="font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4h-4v-4H6v-4h6V9m6 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Metode Pembayaran
                            </h3>

                            <div
                                class="p-5 bg-slate-50 dark:bg-slate-700/30 rounded-xl border border-slate-100 dark:border-slate-700 text-center">
                                <div
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-bold mb-3">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Instant Verification
                                </div>

                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 mb-4">Scan QRIS (All
                                    E-Wallet)</p>

                                <div class="group relative bg-white p-3 rounded-xl inline-block shadow-sm border border-slate-200 dark:border-slate-600 mb-4 cursor-zoom-in transition-transform hover:scale-[1.02]"
                                    onclick="openQrisModal()">
                                    <img src="{{ asset('images/qris.png') }}" alt="QRIS Code"
                                        class="w-48 h-48 object-contain mx-auto">

                                    <div
                                        class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                        <div class="text-white text-xs font-bold flex flex-col items-center gap-1">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                            Perbesar
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <a href="{{ asset('images/qris.png') }}" download="QRIS-68Hosting.png"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        Download QRIS
                                    </a>
                                </div>

                                <p class="text-xs text-slate-400 mt-4 text-center leading-relaxed">
                                    Dukungan pembayaran:<br>
                                    GoPay, OVO, Dana, ShopeePay, LinkAja, Mobile Banking (BCA, Mandiri, dll)
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="qrisModal"
        class="hidden fixed inset-0 z-[100] bg-slate-900/90 backdrop-blur-sm flex items-center justify-center p-4"
        onclick="closeQrisModal()">
        <div class="relative max-w-lg w-full bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300"
            id="qrisModalContent" onclick="event.stopPropagation()">
            <button onclick="closeQrisModal()"
                class="absolute -top-12 right-0 text-white/80 hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <img src="{{ asset('images/qris.png') }}" alt="QRIS Fullscreen" class="w-full h-auto rounded-xl">

            <div class="p-4 text-center">
                <p class="text-sm font-semibold text-slate-800 dark:text-white mb-2">Scan QRIS untuk Membayar</p>
                <a href="{{ asset('images/qris.png') }}" download="QRIS-68Hosting.png"
                    class="text-indigo-600 hover:text-indigo-700 text-sm font-medium hover:underline">Download
                    Gambar</a>
            </div>
        </div>
    </div>

    <!-- Subdomain Info Modal -->
    <div x-data="{ open: false }" @open-subdomain-info.window="open = true" @keydown.escape.window="open = false">
        <div x-show="open" class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true"
            style="display: none;">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div x-show="open" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200 dark:border-slate-700"
                        @click.away="open = false">
                        <div class="bg-white dark:bg-slate-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/50 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-lg font-bold leading-6 text-slate-900 dark:text-white"
                                        id="modal-title">Panduan Subdomain</h3>
                                    <div class="mt-4 text-sm text-slate-600 dark:text-slate-300 space-y-4">
                                        <p>
                                            <strong>Subdomain</strong> adalah alamat unik website Anda di platform kami.
                                            Contoh: <code
                                                class="bg-slate-100 dark:bg-slate-700 px-1 py-0.5 rounded text-indigo-600 font-mono">project-saya.zone.id</code>.
                                        </p>

                                        <div
                                            class="bg-slate-50 dark:bg-slate-700/30 p-3 rounded-lg border border-slate-200 dark:border-slate-700">
                                            <p class="font-bold text-slate-800 dark:text-white mb-2">Aturan Penulisan:
                                            </p>
                                            <ul class="list-disc list-inside space-y-1 ml-1">
                                                <li>Hanya huruf kecil (a-z), angka (0-9), dan tanda hubung (-).</li>
                                                <li>Tidak boleh ada spasi.</li>
                                                <li>Minimal 3 karakter.</li>
                                                <li>Tidak boleh diawali atau diakhiri tanda hubung.</li>
                                            </ul>
                                        </div>

                                        <p>
                                            <span class="text-emerald-600 font-bold">Tips:</span> Gunakan nama yang
                                            singkat, mudah diingat, dan relevan dengan project Anda.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-700/30 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button"
                                class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition-colors"
                                @click="open = false">Mengerti</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let checkTimeout;
        const domainInput = document.getElementById('domain-input');
        const feedback = document.getElementById('domain-feedback');
        const submitBtn = document.getElementById('submit-btn');
        const paymentInput = document.getElementById('payment-input');
        const filenameDisplay = document.getElementById('filename-display');
        let isDomainValid = false;

        // --- QRIS Modal Logic ---
        function openQrisModal() {
            const modal = document.getElementById('qrisModal');
            const content = document.getElementById('qrisModalContent');

            modal.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeQrisModal() {
            const modal = document.getElementById('qrisModal');
            const content = document.getElementById('qrisModalContent');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Match transition duration
        }

        // Close on Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === "Escape") {
                closeQrisModal();
            }
        });

        // --- Form Logic ---
        // --- Form Logic ---
        paymentInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];

                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 5MB.');
                    this.value = ''; // Clear input
                    filenameDisplay.textContent = '';
                    checkFormValidity();
                    return;
                }

                // Show filename
                filenameDisplay.textContent = 'Selected: ' + file.name;

                // Show image preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Fix: Use closest label to find the container
                    const previewContainer = paymentInput.closest('label').querySelector('div');

                    // Backup original content if not already backed up
                    if (!previewContainer.getAttribute('data-original')) {
                        previewContainer.setAttribute('data-original', previewContainer.innerHTML);
                    }

                    previewContainer.innerHTML = `
                        <img src="${e.target.result}" class="h-32 object-contain mb-2 rounded-lg shadow-sm">
                        <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">File Terpilih</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate max-w-[200px]">${file.name}</p>
                        <p class="text-xs text-indigo-500 mt-1 hover:underline">Klik untuk ganti</p>
                    `;
                }
                reader.readAsDataURL(file);

                checkFormValidity();

                // Show hint if domain is missing
                if (!isDomainValid) {
                    const domainFeedback = document.getElementById('domain-feedback');
                    if (domainFeedback.innerHTML === '') {
                        domainFeedback.innerHTML = `
                            <span class="text-amber-600 flex items-center gap-1 animate-pulse">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Jangan lupa isi nama domain di atas!
                            </span>
                        `;
                        // Scroll to domain input smoothly
                        document.getElementById('domain-input').scrollIntoView({ behavior: 'smooth', block: 'center' });
                        document.getElementById('domain-input').focus();
                    }
                }
            } else {
                filenameDisplay.textContent = '';
                // Restore original upload UI if available
                const previewContainer = document.querySelector('label[for="payment-input"] div');
                if (previewContainer.getAttribute('data-original')) {
                    previewContainer.innerHTML = previewContainer.getAttribute('data-original');
                }
            }
        });

        function checkFormValidity() {
            if (isDomainValid && paymentInput.files.length > 0) {
                submitBtn.disabled = false;
                submitBtn.setAttribute('data-ready', 'true');
                submitBtn.classList.remove('bg-slate-200', 'text-slate-400', 'cursor-not-allowed');
                submitBtn.classList.add('bg-indigo-600', 'text-white', 'cursor-pointer', 'shadow-lg', 'hover:bg-indigo-700');
            } else {
                submitBtn.disabled = true;
                submitBtn.setAttribute('data-ready', 'false');
                submitBtn.classList.add('bg-slate-200', 'text-slate-400', 'cursor-not-allowed');
                submitBtn.classList.remove('bg-indigo-600', 'text-white', 'cursor-pointer', 'shadow-lg', 'hover:bg-indigo-700');
            }
        }

        domainInput.addEventListener('input', function () {
            clearTimeout(checkTimeout);
            const domain = this.value.trim();

            // Reset state
            submitBtn.disabled = true;
            submitBtn.setAttribute('data-ready', 'false');
            isDomainValid = false;
            checkFormValidity(); // Update button style immediately

            // Remove previous styling classes from input
            domainInput.classList.remove('ring-rose-500', 'ring-emerald-500', 'text-rose-600', 'text-emerald-600');

            if (domain.length < 3) {
                feedback.innerHTML = `
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-slate-500">Minimal 3 karakter</span>
                `;
                return;
            }

            feedback.innerHTML = `
                <svg class="animate-spin w-4 h-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span class="text-indigo-500 font-medium">Mengecek ketersediaan...</span>
            `;

            checkTimeout = setTimeout(() => {
                fetch('{{ route("orders.check-domain") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ domain_name: domain })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.available) {
                            feedback.innerHTML = `
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                <span class="text-emerald-600 font-bold">${data.message}</span>
                            `;
                            domainInput.classList.add('text-emerald-600');
                            isDomainValid = true;
                            checkFormValidity();
                        } else {
                            feedback.innerHTML = `
                                <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                <span class="text-rose-600 font-bold">${data.message}</span>
                            `;
                            domainInput.classList.add('text-rose-600');
                            isDomainValid = false;
                            checkFormValidity();
                        }
                    })
                    .catch(err => {
                        feedback.innerHTML = '<span class="text-rose-600">Gagal mengecek domain. Silakan coba lagi.</span>';
                        isDomainValid = false;
                        checkFormValidity();
                    });
            }, 500);
        });
    </script>
</x-app-layout>