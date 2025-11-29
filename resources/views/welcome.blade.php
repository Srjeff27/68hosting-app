<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="68Hosting - Platform hosting profesional untuk website statis.">
    <title>68Hosting - Academic & Professional Static Hosting</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="antialiased bg-slate-50 text-slate-600 dark:bg-slate-900 dark:text-slate-400">

    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-600 rounded-lg shadow-lg shadow-indigo-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">68<span class="text-indigo-600">Hosting</span></span>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-white transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hidden sm:block text-sm font-semibold text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-white transition-colors">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-slate-900 hover:bg-indigo-600 dark:bg-white dark:text-slate-900 dark:hover:bg-indigo-50 rounded-full transition-all duration-300 shadow-md hover:shadow-lg">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <main>
        <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
            <div class="absolute inset-0 -z-10">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-indigo-500/10 dark:bg-indigo-500/20 blur-[100px] rounded-full mix-blend-multiply"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 text-xs font-bold uppercase tracking-wider mb-6 border border-indigo-100 dark:border-indigo-800">
                            <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                            Academic Hosting Solution
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white leading-[1.15] mb-6 tracking-tight">
                            Publikasikan Karya <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">Digital Anda</span>
                        </h1>
                        <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            Platform hosting khusus website statis (HTML, CSS, JS) yang dirancang untuk mahasiswa dan akademisi. Preview instan, deployment aman, dan biaya terjangkau.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('register') }}" class="px-8 py-4 text-base font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/25 hover:-translate-y-1">
                                Mulai Deploy Gratis
                            </a>
                            <a href="#features" class="px-8 py-4 text-base font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:border-slate-300 dark:bg-slate-800 dark:text-white dark:border-slate-700 transition-all">
                                Pelajari Fitur
                            </a>
                        </div>
                        
                        <div class="mt-10 flex items-center justify-center lg:justify-start gap-6 text-sm text-slate-500 dark:text-slate-400 font-medium">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>HTML/CSS/JS</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>SSL Secure</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative lg:h-auto">
                        <div class="relative mx-auto w-full max-w-[500px] bg-slate-900 rounded-2xl shadow-2xl border border-slate-800 overflow-hidden transform rotate-2 hover:rotate-0 transition-transform duration-500">
                            <div class="flex items-center gap-2 px-4 py-3 bg-slate-800 border-b border-slate-700">
                                <div class="flex gap-1.5">
                                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                </div>
                                <div class="flex-1 text-center">
                                    <div class="inline-block px-3 py-1 rounded bg-slate-900 text-xs text-slate-400 font-mono">portfolio.zone.id</div>
                                </div>
                            </div>
                            <div class="p-6 space-y-4 bg-slate-900/95">
                                <div class="flex gap-4">
                                    <div class="w-1/3 space-y-3">
                                        <div class="h-2 w-12 bg-indigo-500 rounded-full"></div>
                                        <div class="h-20 w-full bg-slate-800 rounded-lg animate-pulse"></div>
                                        <div class="h-2 w-full bg-slate-800 rounded-full"></div>
                                    </div>
                                    <div class="w-2/3 space-y-3">
                                        <div class="h-32 w-full bg-gradient-to-br from-indigo-600 to-violet-600 rounded-lg flex items-center justify-center">
                                            <span class="font-mono text-white/50 text-4xl font-bold">&lt;/&gt;</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div class="h-2 w-full bg-slate-800 rounded-full"></div>
                                            <div class="h-2 w-full bg-slate-800 rounded-full"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-slate-800 flex justify-between items-center">
                                    <div class="h-2 w-24 bg-green-500/50 rounded-full"></div>
                                    <div class="px-3 py-1 bg-indigo-600 text-white text-xs rounded font-bold">Deploy Success</div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-amber-500 rounded-full blur-3xl opacity-20 -z-10"></div>
                        <div class="absolute -top-10 -left-10 w-40 h-40 bg-indigo-500 rounded-full blur-3xl opacity-20 -z-10"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-24 bg-white dark:bg-slate-900 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-20">
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white mb-4">Infrastruktur Standar Industri</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400">Kami menyediakan lingkungan hosting yang optimal untuk mendukung kebutuhan akademik dan portfolio profesional Anda.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                    $features = [
                        ['icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'title' => 'Live Preview', 'desc' => 'Validasi tampilan website Anda secara real-time sebelum dipublikasikan ke publik.'],
                        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'title' => 'High Performance', 'desc' => 'Server yang dioptimalkan untuk pengiriman konten statis dengan latency minimal.'],
                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Security Sandbox', 'desc' => 'Setiap file diverifikasi dan dijalankan dalam lingkungan terisolasi untuk keamanan maksimal.'],
                        ['icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9', 'title' => 'Custom Subdomain', 'desc' => 'Dapatkan identitas profesional dengan subdomain *.zone.id pilihan Anda.'],
                        ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Affordable Cost', 'desc' => 'Biaya berlangganan yang sangat terjangkau, khusus untuk kalangan pelajar dan mahasiswa.'],
                        ['icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636', 'title' => 'Manual Verification', 'desc' => 'Quality assurance oleh tim admin untuk memastikan konten sesuai standar akademik.']
                    ];
                    @endphp

                    @foreach($features as $feature)
                    <div class="group p-8 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="w-12 h-12 bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:border-indigo-600 transition-colors">
                            <svg class="w-6 h-6 text-slate-600 dark:text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">{{ $feature['title'] }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-24 bg-slate-50 dark:bg-slate-800/50 border-y border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white mb-4">Workflow Deployment</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400">Empat langkah mudah menuju publikasi online.</p>
                </div>

                <div class="relative grid md:grid-cols-4 gap-8">
                    <div class="hidden md:block absolute top-8 left-[10%] right-[10%] h-0.5 bg-slate-200 dark:bg-slate-700 -z-0"></div>

                    @foreach(['Upload Assets', 'Live Preview', 'Payment', 'Publication'] as $index => $step)
                    <div class="relative text-center z-10">
                        <div class="w-16 h-16 mx-auto bg-white dark:bg-slate-900 border-4 border-indigo-100 dark:border-slate-700 rounded-full flex items-center justify-center mb-6 shadow-sm">
                            <span class="text-xl font-bold text-indigo-600">{{ $index + 1 }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $step }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            {{ match($index) {
                                0 => 'Unggah file HTML/CSS/JS atau arsip ZIP.',
                                1 => 'Cek fungsionalitas website sebelum membayar.',
                                2 => 'Proses administrasi yang aman dan cepat.',
                                3 => 'Website Anda dapat diakses dari seluruh dunia.',
                            } }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-24 bg-slate-900 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48ZyBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9IkQwIDQwaDQwVjBIMHY0MHptMzktMUgxVjFoMzh2Mzh6IiBmaWxsPSIjMzMzIiBmaWxsLW9wYWNpdHk9IjAuMSIvPjwvZz48L3N2Zz4=')] opacity-20"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600 rounded-full blur-[100px] opacity-30"></div>
            
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Mulai Perjalanan Digital Anda</h2>
                <p class="text-xl text-slate-300 mb-10 font-light">
                    Bergabunglah dengan mahasiswa lainnya yang telah mempublikasikan portofolio dan tugas akhir mereka secara profesional.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-xl shadow-indigo-900/50 transition-all transform hover:-translate-y-1">
                        Daftar Gratis Sekarang
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="p-1.5 bg-indigo-600 rounded">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                        </div>
                        <span class="text-xl font-bold text-slate-900 dark:text-white">68Hosting</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed max-w-sm">
                        Platform hosting statis modern yang didedikasikan untuk mendukung ekosistem akademik dan pengembangan talenta digital.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-4">Navigasi</h4>
                    <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="#" class="hover:text-indigo-600 transition">Beranda</a></li>
                        <li><a href="#features" class="hover:text-indigo-600 transition">Fitur & Layanan</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Login Member</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            support@68hosting.zone.id
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Bengkulu, Indonesia
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-100 dark:border-slate-800 pt-8 text-center">
                <p class="text-xs text-slate-400">&copy; {{ date('Y') }} 68Hosting. All rights reserved. Designed with Academic Standards.</p>
            </div>
        </div>
    </footer>
</body>
</html>