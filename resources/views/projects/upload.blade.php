<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-white leading-tight">
                    {{ __('Deploy Project') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Langkah 1: Unggah aset website statis Anda.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="$dispatch('open-tutorial')"
                    class="flex items-center gap-2 px-3 py-1.5 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tutorial Upload
                </button>
                <div
                    class="hidden sm:flex items-center gap-2 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-xs font-bold uppercase tracking-wider border border-indigo-100 dark:border-indigo-800">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    Upload Phase
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ tutorialOpen: false }" @open-tutorial.window="tutorialOpen = true">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div id="js-error-alert"
                class="hidden mb-8 bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400 px-4 py-4 rounded-xl flex items-start gap-3 shadow-sm animate-fade-in-down">
                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <h4 class="font-bold">Upload Gagal</h4>
                    <ul id="js-error-list" class="list-disc list-inside text-sm mt-1 opacity-90">
                    </ul>
                </div>
            </div>

            @if($errors->any())
                <div
                    class="mb-8 bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400 px-4 py-4 rounded-xl flex items-start gap-3 shadow-sm animate-fade-in-down">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="font-bold">Upload Gagal</h4>
                        <ul class="list-disc list-inside text-sm mt-1 opacity-90">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div
                class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 overflow-hidden">
                <div class="h-1 w-full bg-slate-100 dark:bg-slate-700">
                    <div class="h-full w-1/3 bg-indigo-600 rounded-r-full"></div>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data"
                        id="uploadForm">
                        @csrf

                        <div class="mb-8">
                            <label
                                class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 uppercase tracking-wide">
                                Metode Upload
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="upload_method" value="files" checked class="peer sr-only"
                                        onchange="toggleUploadMethod()">
                                    <div
                                        class="p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 hover:border-indigo-400 dark:hover:border-indigo-500 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 dark:peer-checked:bg-indigo-900/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg text-indigo-600 dark:text-indigo-400">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="block font-bold text-slate-900 dark:text-white">Individual
                                                    Files</span>
                                                <span class="text-xs text-slate-500 dark:text-slate-400">Upload file
                                                    terpisah (HTML, CSS, JS)</span>
                                            </div>
                                        </div>
                                        <div
                                            class="absolute top-4 right-4 text-indigo-600 opacity-0 peer-checked:opacity-100 transition-opacity">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="upload_method" value="zip" class="peer sr-only"
                                        onchange="toggleUploadMethod()">
                                    <div
                                        class="p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 hover:border-indigo-400 dark:hover:border-indigo-500 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 dark:peer-checked:bg-indigo-900/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg text-indigo-600 dark:text-indigo-400">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="block font-bold text-slate-900 dark:text-white">ZIP
                                                    Archive</span>
                                                <span class="text-xs text-slate-500 dark:text-slate-400">Upload satu
                                                    file .zip berisi project</span>
                                            </div>
                                        </div>
                                        <div
                                            class="absolute top-4 right-4 text-indigo-600 opacity-0 peer-checked:opacity-100 transition-opacity">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div id="files-upload" class="transition-all duration-300">
                                <label
                                    class="group flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-2xl cursor-pointer bg-slate-50 dark:bg-slate-800/50 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-all relative overflow-hidden">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 relative z-10">
                                        <div
                                            class="mb-4 p-4 bg-white dark:bg-slate-700 rounded-full shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="mb-2 text-sm text-slate-600 dark:text-slate-300 font-medium">Click to
                                            upload or drag and drop</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">HTML, CSS, JS, Images,
                                            Fonts (Max 10MB)</p>
                                    </div>
                                    <input type="file" name="files[]" id="files-input" multiple class="hidden"
                                        accept=".html,.css,.js,.jpg,.jpeg,.png,.gif,.svg,.webp,.ico,.woff,.woff2,.ttf,.otf,.json" />
                                    <div
                                        class="absolute inset-0 opacity-0 group-hover:opacity-10 dark:opacity-5 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] transition-opacity pointer-events-none">
                                    </div>
                                </label>
                                <div id="files-list" class="mt-4 space-y-2 max-h-40 overflow-y-auto custom-scrollbar">
                                </div>
                            </div>

                            <div id="zip-upload" class="hidden transition-all duration-300">
                                <label
                                    class="group flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-2xl cursor-pointer bg-slate-50 dark:bg-slate-800/50 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-all">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <div
                                            class="mb-4 p-4 bg-white dark:bg-slate-700 rounded-full shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="mb-2 text-sm text-slate-600 dark:text-slate-300 font-medium">Select
                                            ZIP Archive</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Pastikan file index.html
                                            ada di root arsip</p>
                                    </div>
                                    <input type="file" name="zip_file" id="zip-input" class="hidden" accept=".zip" />
                                </label>
                                <div id="zip-info" class="mt-4"></div>
                            </div>
                        </div>

                        <div
                            class="mb-8 p-5 bg-slate-50 dark:bg-slate-700/30 rounded-xl border border-slate-200 dark:border-slate-700">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Pre-flight Checklist
                            </h4>
                            <div class="grid sm:grid-cols-2 gap-3 text-sm text-slate-600 dark:text-slate-400">
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    File utama wajib bernama <code
                                        class="text-xs font-mono bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 px-1.5 py-0.5 rounded text-indigo-600">index.html</code>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Hanya file statis (HTML, CSS, JS, Assets)
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Maksimal ukuran total 10MB
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Tidak ada script server-side (PHP/Python)
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex flex-col-reverse sm:flex-row sm:justify-end gap-4 pt-4 border-t border-slate-100 dark:border-slate-700">
                            <a href="{{ route('dashboard') }}"
                                class="px-6 py-3 text-center text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-slate-700 rounded-xl transition-colors">
                                Batalkan
                            </a>
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-violet-700 focus:ring-4 focus:ring-indigo-500/20 shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5">
                                Upload & Preview
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tutorial Modal -->
        <div x-show="tutorialOpen" class="relative z-50" role="dialog" aria-modal="true" style="display: none;">
            <div x-show="tutorialOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div x-show="tutorialOpen" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-slate-200 dark:border-slate-700">

                        <div class="bg-white dark:bg-slate-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-900/50 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-lg font-bold leading-6 text-slate-900 dark:text-white"
                                        id="modal-title">Panduan Upload Project</h3>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex gap-3">
                                            <div
                                                class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs font-bold">
                                                1</div>
                                            <div class="text-sm text-slate-600 dark:text-slate-300">
                                                <strong class="block text-slate-800 dark:text-white">Siapkan
                                                    File</strong>
                                                Pastikan project Anda memiliki file <code
                                                    class="text-xs bg-slate-100 dark:bg-slate-700 px-1 rounded">index.html</code>
                                                di folder utama.
                                            </div>
                                        </div>
                                        <div class="flex gap-3">
                                            <div
                                                class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs font-bold">
                                                2</div>
                                            <div class="text-sm text-slate-600 dark:text-slate-300">
                                                <strong class="block text-slate-800 dark:text-white">Pilih
                                                    Metode</strong>
                                                Gunakan <strong>Individual Files</strong> untuk project kecil, atau
                                                <strong>ZIP Archive</strong> untuk project besar dengan banyak folder.
                                            </div>
                                        </div>
                                        <div class="flex gap-3">
                                            <div
                                                class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs font-bold">
                                                3</div>
                                            <div class="text-sm text-slate-600 dark:text-slate-300">
                                                <strong class="block text-slate-800 dark:text-white">Upload &
                                                    Preview</strong>
                                                Klik tombol upload, tunggu proses selesai, dan Anda akan diarahkan ke
                                                halaman preview.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-700/30 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button @click="tutorialOpen = false" type="button"
                                class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition-colors">
                                Mengerti
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Upload Method Logic
        function toggleUploadMethod() {
            const method = document.querySelector('input[name="upload_method"]:checked').value;
            const filesDiv = document.getElementById('files-upload');
            const zipDiv = document.getElementById('zip-upload');
            const filesInput = document.getElementById('files-input');
            const zipInput = document.getElementById('zip-input');

            // Reset inputs
            filesInput.value = '';
            zipInput.value = '';
            document.getElementById('files-list').innerHTML = '';
            document.getElementById('zip-info').innerHTML = '';

            // Reset global transfer
            if (window.fileTransfer) {
                window.fileTransfer.items.clear();
            }

            if (method === 'files') {
                filesDiv.classList.remove('hidden');
                setTimeout(() => { filesDiv.classList.remove('opacity-0', 'scale-95'); }, 10);
                zipDiv.classList.add('hidden', 'opacity-0', 'scale-95');
            } else {
                filesDiv.classList.add('hidden', 'opacity-0', 'scale-95');
                zipDiv.classList.remove('hidden');
                setTimeout(() => { zipDiv.classList.remove('opacity-0', 'scale-95'); }, 10);
            }
        }

        // File List Formatting
        function formatBytes(bytes, decimals = 2) {
            if (!+bytes) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
        }

        // Global DataTransfer object to store files
        const fileTransfer = new DataTransfer();

        // Individual Files Listener
        document.getElementById('files-input')?.addEventListener('change', function (e) {
            // Add new files to the DataTransfer object
            Array.from(this.files).forEach(file => {
                // Check for duplicates based on name
                let exists = false;
                for (let i = 0; i < fileTransfer.items.length; i++) {
                    if (fileTransfer.items[i].getAsFile().name === file.name) {
                        exists = true;
                        break;
                    }
                }
                if (!exists) {
                    fileTransfer.items.add(file);
                }
            });

            // Update the input's files property
            this.files = fileTransfer.files;

            // Render the list
            renderFilesList();
        });

        function renderFilesList() {
            const filesList = document.getElementById('files-list');
            filesList.innerHTML = '';

            if (fileTransfer.files.length > 0) {
                let html = '';
                Array.from(fileTransfer.files).forEach((file, index) => {
                    html += `
                        <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-200 dark:border-slate-700">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <svg class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm text-slate-700 dark:text-slate-300 truncate font-medium">${file.name}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-slate-500 dark:text-slate-400 font-mono whitespace-nowrap">${formatBytes(file.size)}</span>
                                <button type="button" onclick="removeFile(${index})" class="text-slate-400 hover:text-rose-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;
                });
                filesList.innerHTML = html;
            }
        }

        // Make removeFile available globally
        window.removeFile = function (index) {
            const newTransfer = new DataTransfer();
            Array.from(fileTransfer.files).forEach((file, i) => {
                if (i !== index) {
                    newTransfer.items.add(file);
                }
            });

            // Clear and update global transfer
            fileTransfer.items.clear();
            Array.from(newTransfer.files).forEach(file => fileTransfer.items.add(file));

            // Update input and UI
            document.getElementById('files-input').files = fileTransfer.files;
            renderFilesList();
        }

        // ZIP File Listener
        document.getElementById('zip-input')?.addEventListener('change', function (e) {
            const zipInfo = document.getElementById('zip-info');
            zipInfo.innerHTML = '';

            if (this.files.length > 0) {
                const file = this.files[0];
                zipInfo.innerHTML = `
                    <div class="flex items-center justify-between p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-200 dark:border-indigo-800">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-100 dark:bg-indigo-800 rounded text-indigo-600 dark:text-indigo-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">${file.name}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Siap untuk diupload</p>
                            </div>
                        </div>
                        <span class="text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400">${formatBytes(file.size)}</span>
                    </div>
                `;
            }
        });

        // AJAX Form Submission
        document.getElementById('uploadForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            const errorAlert = document.getElementById('js-error-alert');
            const errorList = document.getElementById('js-error-list');

            // Reset error
            if (errorAlert) errorAlert.classList.add('hidden');

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Uploading...';

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.status === 413) {
                    throw new Error('File terlalu besar. Server menolak permintaan (Error 413). Mohon periksa konfigurasi "client_max_body_size" pada Nginx atau upload file yang lebih kecil.');
                }

                if (!response.ok) {
                    let errorMsg = 'Upload gagal';
                    try {
                        const data = await response.json();
                        if (data.errors) {
                            errorMsg = Object.values(data.errors).flat().join('<br>');
                        } else if (data.message) {
                            errorMsg = data.message;
                        }
                    } catch (e) {
                        errorMsg = `Upload gagal dengan status: ${response.status}`;
                    }
                    throw new Error(errorMsg);
                }

                // Success - Redirect
                // If response is JSON (Laravel might return JSON if we asked for it and it was successful? 
                // Actually Laravel redirect response is 302, fetch follows it and returns 200 with new page content)
                // We can check response.url
                if (response.url && response.url !== this.action) {
                    window.location.href = response.url;
                } else {
                    // If we got JSON response with redirect url
                    try {
                        const data = await response.json();
                        if (data.redirect) {
                            window.location.href = data.redirect;
                            return;
                        }
                    } catch (e) { }

                    // Fallback
                    window.location.reload();
                }

            } catch (error) {
                if (errorAlert && errorList) {
                    errorList.innerHTML = `<li>${error.message}</li>`;
                    errorAlert.classList.remove('hidden');
                    // Scroll to error
                    errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    alert(error.message);
                }
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    </script>
</x-app-layout>