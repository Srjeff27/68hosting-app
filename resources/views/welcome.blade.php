<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="68Hosting - Platform hosting profesional untuk website statis khusus akademisi.">
    <title>68Hosting - Academic & Professional Static Hosting</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'media',
                theme: {
                    extend: {
                        fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                        colors: {
                            indigo: { 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 900: '#312e81' }
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .dark .glass-nav { background: rgba(15, 23, 42, 0.8); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .blob { position: absolute; filter: blur(80px); opacity: 0.4; z-index: -1; animation: float 10s infinite alternate; }
        @keyframes float { 0% { transform: translate(0, 0) rotate(0deg); } 100% { transform: translate(30px, 50px) rotate(10deg); } }
    </style>
</head>

<body class="antialiased bg-slate-50 text-slate-600 dark:bg-slate-950 dark:text-slate-400 selection:bg-indigo-500 selection:text-white overflow-x-hidden">

    <nav x-data="{ mobileMenuOpen: false }" class="fixed w-full z-50 transition-all duration-300 glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="p-2 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-white">68<span class="text-indigo-600">Hosting</span></span>
                </div>

                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-white transition-colors">Fitur</a>
                    <a href="#workflow" class="text-sm font-medium text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-white transition-colors">Cara Kerja</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center gap-4 pl-4 border-l border-slate-200 dark:border-slate-700">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full transition-all shadow-md hover:shadow-lg shadow-indigo-500/25">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-700 hover:text-indigo-600 dark:text-slate-200 dark:hover:text-white transition-colors">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-slate-900 hover:bg-indigo-600 dark:bg-white dark:text-slate-900 dark:hover:bg-indigo-50 rounded-full transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 dark:text-slate-300 hover:text-indigo-600 transition p-2">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-collapse x-cloak class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="#features" class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-200 dark:hover:bg-slate-800">Fitur</a>
                <a href="#workflow" class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50 dark:text-slate-200 dark:hover:bg-slate-800">Cara Kerja</a>
                <div class="my-3 border-t border-slate-100 dark:border-slate-700"></div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="block w-full text-center px-5 py-3 rounded-lg bg-indigo-600 text-white font-bold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50 dark:text-slate-200 dark:hover:bg-slate-800">Masuk</a>
                    <a href="{{ route('register') }}" class="block w-full text-center mt-2 px-5 py-3 rounded-lg bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-500/30">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div class="blob bg-indigo-500/20 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
            <div class="blob bg-violet-500/20 w-[30rem] h-[30rem] rounded-full bottom-0 right-0 translate-x-1/3 translate-y-1/3 animation-delay-2000"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    
                    <div class="text-center lg:text-left z-10" data-aos="fade-up" data-aos-duration="1000">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50/80 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800 backdrop-blur-sm mb-8 transition-transform hover:scale-105">
                            <span class="flex h-2.5 w-2.5 rounded-full bg-indigo-600 animate-pulse"></span>
                            <span class="text-xs font-bold text-indigo-700 dark:text-indigo-300 uppercase tracking-wider">Academic Standard Hosting</span>
                        </div>
                        
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white leading-[1.1] mb-6 tracking-tight">
                            Publikasikan <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-violet-600 to-indigo-600 animate-gradient-x">Karya Akademik</span>
                            <br>Anda.
                        </h1>
                        
                        <p class="text-lg text-slate-600 dark:text-slate-400 mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            Hosting website statis (HTML, CSS, JS) yang dirancang khusus untuk mahasiswa. Deploy portfolio, tugas akhir, dan projek dosen dengan infrastruktur aman.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl overflow-hidden shadow-xl shadow-indigo-500/30 hover:shadow-indigo-600/40 transition-all hover:-translate-y-1">
                                <span class="relative z-10">Mulai Deploy Gratis</span>
                                <div class="absolute inset-0 h-full w-full scale-0 rounded-2xl transition-all duration-300 group-hover:scale-100 group-hover:bg-indigo-700"></div>
                            </a>
                            <a href="#features" class="px-8 py-4 text-slate-700 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 hover:border-slate-300 dark:bg-slate-800 dark:text-white dark:border-slate-700 font-semibold transition-all hover:-translate-y-1">
                                Pelajari Fitur
                            </a>
                        </div>
                        
                        <div class="mt-12 flex flex-wrap justify-center lg:justify-start gap-x-8 gap-y-4 text-sm font-semibold text-slate-500 dark:text-slate-400">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Free SSL</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>High Performance</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>No Ads</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative hidden lg:block" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-violet-600 rounded-2xl blur opacity-30 animate-pulse"></div>
                        <div class="relative bg-slate-900 rounded-2xl border border-slate-800 shadow-2xl overflow-hidden transform rotate-2 hover:rotate-0 transition-transform duration-500">
                            <div class="flex items-center justify-between px-4 py-3 bg-slate-800 border-b border-slate-700">
                                <div class="flex gap-2">
                                    <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                                </div>
                                <div class="text-xs text-slate-400 font-mono">index.html</div>
                            </div>
                            <div class="p-6 font-mono text-sm leading-relaxed text-slate-300">
                                <div class="flex"><span class="text-slate-600 mr-4">1</span><span class="text-violet-400">&lt;!DOCTYPE html&gt;</span></div>
                                <div class="flex"><span class="text-slate-600 mr-4">2</span><span>&lt;<span class="text-rose-400">html</span>&gt;</span></div>
                                <div class="flex"><span class="text-slate-600 mr-4">3</span><span class="pl-4">&lt;<span class="text-rose-400">body</span> <span class="text-amber-300">class</span>=<span class="text-emerald-300">"bg-academic"</span>&gt;</span></div>
                                <div class="flex"><span class="text-slate-600 mr-4">4</span><span class="pl-8">&lt;<span class="text-rose-400">h1</span>&gt;Hello World!&lt;/<span class="text-rose-400">h1</span>&gt;</span></div>
                                <div class="flex"><span class="text-slate-600 mr-4">5</span><span class="pl-8">&lt;<span class="text-rose-400">p</span>&gt;Hosted on 68Hosting&lt;/<span class="text-rose-400">p</span>&gt;</span></div>
                                <div class="flex"><span class="text-slate-600 mr-4">6</span><span class="pl-4">&lt;/<span class="text-rose-400">body</span>&gt;</span></div>
                                <div class="flex"><span class="text-slate-600 mr-4">7</span><span>&lt;/<span class="text-rose-400">html</span>&gt;</span></div>
                            </div>
                            <div class="px-4 py-2 bg-slate-800/50 border-t border-slate-700 flex justify-between items-center text-xs">
                                <span class="flex items-center gap-1.5 text-emerald-400"><span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Server Active</span>
                                <span class="text-slate-500">UTF-8</span>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-6 -left-6 bg-white dark:bg-slate-800 p-4 rounded-xl shadow-xl border border-slate-100 dark:border-slate-700 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                            <div class="bg-emerald-100 dark:bg-emerald-900/30 p-2 rounded-lg text-emerald-600 dark:text-emerald-400">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Status</p>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">Live in 0.4s</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-24 bg-white dark:bg-slate-900 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white mb-6">Infrastruktur Standar Industri</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400">Lingkungan hosting optimal yang mendukung kebutuhan akademik dengan teknologi terkini.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                    $features = [
                        ['delay' => '0', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'title' => 'Live Preview', 'desc' => 'Validasi tampilan website Anda secara real-time di server staging sebelum dipublikasikan.'],
                        ['delay' => '100', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'title' => 'High Performance', 'desc' => 'Server Nginx teroptimasi untuk pengiriman konten statis dengan latency ultra-rendah.'],
                        ['delay' => '200', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Security Sandbox', 'desc' => 'File diverifikasi dalam lingkungan terisolasi untuk mencegah injeksi script berbahaya.'],
                        ['delay' => '300', 'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9', 'title' => 'Custom Subdomain', 'desc' => 'Identitas profesional dengan subdomain *.zone.id pilihan Anda.'],
                        ['delay' => '400', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Student Pricing', 'desc' => 'Biaya berlangganan yang disesuaikan dengan kantong mahasiswa, sangat terjangkau.'],
                        ['delay' => '500', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Manual Verification', 'desc' => 'Quality assurance oleh tim admin untuk memastikan konten sesuai standar akademik.']
                    ];
                    @endphp

                    @foreach($features as $feature)
                    <div class="group relative p-8 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 hover:border-indigo-500/50 dark:hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $feature['delay'] }}">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:border-indigo-600 transition-all duration-300 shadow-sm">
                                <svg class="w-7 h-7 text-slate-600 dark:text-slate-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">{{ $feature['title'] }}</h3>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="workflow" class="py-24 bg-slate-50 dark:bg-slate-800/50 border-y border-slate-200 dark:border-slate-800 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-20" data-aos="zoom-in">
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white mb-4">Workflow Deployment</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400">Empat langkah mudah menuju publikasi online.</p>
                </div>

                <div class="relative grid md:grid-cols-4 gap-8">
                    <div class="hidden md:block absolute top-10 left-[10%] right-[10%] h-1 bg-gradient-to-r from-slate-200 via-indigo-200 to-slate-200 dark:from-slate-700 dark:via-indigo-900 dark:to-slate-700 rounded-full"></div>

                    @foreach(['Upload Assets', 'Live Preview', 'Secure Payment', 'Global Publication'] as $index => $step)
                    <div class="relative text-center group" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                        <div class="relative w-20 h-20 mx-auto bg-white dark:bg-slate-900 border-4 border-indigo-50 dark:border-slate-800 rounded-full flex items-center justify-center mb-6 shadow-lg group-hover:border-indigo-500 transition-colors duration-300 z-10">
                            <span class="text-2xl font-bold text-indigo-600">{{ $index + 1 }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">{{ $step }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 px-4 leading-relaxed">
                            {{ match($index) {
                                0 => 'Unggah file HTML/CSS/JS atau arsip ZIP langsung ke dashboard.',
                                1 => 'Sistem akan membuat link sementara untuk pengecekan fungsi.',
                                2 => 'Proses administrasi otomatis dengan QRIS atau Virtual Account.',
                                3 => 'Website Anda aktif permanen dan dapat diakses dari seluruh dunia.',
                            } }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-28 relative overflow-hidden">
            <div class="absolute inset-0 bg-slate-900">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/50 to-slate-900"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600 rounded-full blur-[120px] opacity-20"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-violet-600 rounded-full blur-[120px] opacity-20"></div>
            </div>
            
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="fade-up">
                <h2 class="text-4xl sm:text-5xl font-extrabold text-white mb-8 tracking-tight">Siap Membangun Portofolio?</h2>
                <p class="text-xl text-indigo-100 mb-10 font-light max-w-2xl mx-auto">
                    Bergabunglah dengan ekosistem akademik digital. Tunjukkan karya Anda kepada dunia dengan platform yang terpercaya.
                </p>
                <div class="flex flex-col sm:flex-row gap-5 justify-center">
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-indigo-700 font-bold text-lg rounded-xl shadow-2xl shadow-white/10 hover:bg-indigo-50 transition-all transform hover:-translate-y-1">
                        Daftar Gratis Sekarang
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-900 pt-16 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="p-1.5 bg-indigo-600 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                        </div>
                        <span class="text-2xl font-bold text-slate-900 dark:text-white">68Hosting</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed max-w-sm mb-6">
                        Platform hosting statis modern yang didedikasikan untuk mendukung ekosistem akademik dan pengembangan talenta digital di Indonesia.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 hover:bg-indigo-600 hover:text-white transition-all"><span class="sr-only">Twitter</span><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 hover:bg-indigo-600 hover:text-white transition-all"><span class="sr-only">GitHub</span><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg></a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-6">Produk</h4>
                    <ul class="space-y-4 text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="#" class="hover:text-indigo-600 transition">Static Hosting</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Custom Domain</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">SSL Certificates</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Student Program</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-6">Dukungan</h4>
                    <ul class="space-y-4 text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="#" class="hover:text-indigo-600 transition">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Status Server</a></li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            help@68hosting.zone.id
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-100 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-500 dark:text-slate-500">&copy; {{ date('Y') }} 68Hosting. Designed with Academic Standards in Bengkulu.</p>
                <div class="flex gap-6 text-xs text-slate-500 dark:text-slate-500">
                    <a href="#" class="hover:text-slate-900 dark:hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-900 dark:hover:text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-out-cubic',
        });
    </script>
</body>
</html>