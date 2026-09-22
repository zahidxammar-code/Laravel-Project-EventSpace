<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventSpace — Plan. Connect. Celebrate.</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles (Menggunakan Alpine.js untuk interaksi teks secara clean) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-[#080B12] text-[#F8FAFC] min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white relative overflow-x-hidden font-sans">

    <!-- Subtle Ambient Background Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[350px] bg-blue-600/[0.04] rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Navbar Minimalis -->
    <header class="w-full max-w-7xl mx-auto px-6 py-6 flex items-center justify-between relative z-10">
        <div class="flex items-center gap-3 group cursor-pointer">
            <div class="w-9 h-9 rounded-lg bg-[#111722] border border-[#202938] group-hover:border-blue-500/50 flex items-center justify-center overflow-hidden p-1.5 transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg group-hover:shadow-blue-500/10">
                <img src="{{ asset('image/logo.png') }}" alt="EventSpace Logo" class="w-full h-full object-contain transition-transform duration-300 group-hover:-rotate-6">
            </div>
            <span class="font-semibold tracking-tight text-[#F8FAFC] text-base group-hover:text-blue-400 transition-colors duration-300">Event<span class="text-blue-500">Space</span></span>
        </div>

        @if (Route::has('login'))
        <div class="flex items-center gap-3">
            @auth
            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-lg bg-[#111722] hover:bg-[#151C29] border border-[#202938] text-xs font-medium text-[#F8FAFC] transition">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-xs font-medium text-[#94A3B8] hover:text-[#F8FAFC] transition">Masuk</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-medium shadow-sm transition">Daftar Akun</a>
            @endif
            @endauth
        </div>
        @endif
    </header>

    <!-- Main Content -->
    <main class="w-full max-w-7xl mx-auto px-6 py-16 md:py-28 relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

        <!-- Kolom Kiri: Teks & Aksi -->
        <div class="lg:col-span-7 space-y-8">

            <!-- Tagline Interaktif: Plan. Connect. Celebrate. -->
            <div
                x-data="{ 
        words: ['Plan events with precision.', 'Connect communities seamlessly.', 'Celebrate successful moments.'], 
        currentIndex: 0,
        init() {
            setInterval(() => {
                this.currentIndex = (this.currentIndex + 1) % this.words.length;
            }, 3000);
        }
    }"
                class="inline-flex items-center gap-3 px-3.5 py-1.5 rounded-md bg-[#0D111A] border border-[#202938] text-xs font-mono tracking-tight text-[#94A3B8]">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-[#F8FAFC] font-semibold">EventSpace OS</span>
                <span class="text-[#202938]">/</span>
                <span class="text-blue-400 font-medium transition-opacity duration-300" x-text="words[currentIndex]"></span>
            </div>

            <div class="space-y-4">
                <h1 class="text-4xl sm:text-6xl font-bold tracking-tight text-[#F8FAFC] leading-[1.1]">
                    Pengelolaan event jadi jauh lebih <span class="text-blue-500">terstruktur.</span>
                </h1>

                <p class="text-[#94A3B8] text-base sm:text-lg leading-relaxed max-w-xl font-normal">
                    Platform modern untuk komunitas, sekolah, organisasi, dan perusahaan dalam merencanakan, mengelola, serta memantau jalannya setiap acara secara profesional.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium shadow-sm transition flex items-center gap-2">
                    Buka Dashboard
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
                @else
                <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium shadow-sm transition">
                    Mulai Sekarang
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-lg bg-[#111722] hover:bg-[#151C29] text-[#F8FAFC] border border-[#202938] text-sm font-medium transition">
                    Daftar Organisasi
                </a>
                @endif
                @endauth
                @endif
            </div>

            <!-- Metric mini bawah CTA -->
            <div class="grid grid-cols-3 gap-6 pt-8 border-t border-[#202938]/60">
                <div>
                    <div class="text-xl font-semibold text-[#F8FAFC]">100%</div>
                    <div class="text-xs text-[#64748B] mt-0.5">Terstruktur</div>
                </div>
                <div>
                    <div class="text-xl font-semibold text-[#F8FAFC]">Multi-Role</div>
                    <div class="text-xs text-[#64748B] mt-0.5">Admin, Panitia, Peserta</div>
                </div>
                <div>
                    <div class="text-xl font-semibold text-[#F8FAFC]">Real-time</div>
                    <div class="text-xs text-[#64748B] mt-0.5">Manajemen Jadwal</div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Tampilan Dashboard Preview Ala SaaS -->
        <div class="lg:col-span-5">
            <div class="rounded-xl bg-[#0D111A] border border-[#202938] p-5 shadow-2xl space-y-5">
                <div class="flex items-center justify-between pb-4 border-b border-[#202938]">
                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-red-500/80"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/80"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></div>
                    </div>
                    <span class="text-[11px] font-mono text-[#64748B]">eventspace.app/dashboard</span>
                </div>

                <div class="space-y-3">
                    <div class="p-3.5 rounded-lg bg-[#111722] border border-[#202938] flex items-center justify-between">
                        <div>
                            <div class="text-xs font-medium text-[#F8FAFC]">Seminar Teknologi Nasional</div>
                            <div class="text-[11px] text-[#64748B] mt-0.5">Aula Utama • 24 Peserta Terdaftar</div>
                        </div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Aktif</span>
                    </div>

                    <div class="p-3.5 rounded-lg bg-[#111722] border border-[#202938] flex items-center justify-between">
                        <div>
                            <div class="text-xs font-medium text-[#F8FAFC]">Workshop UI/UX Design Dasar</div>
                            <div class="text-[11px] text-[#64748B] mt-0.5">Lab Komputer 1 • 50 Kapasitas</div>
                        </div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">Akan Datang</span>
                    </div>

                    <div class="p-3.5 rounded-lg bg-[#111722] border border-[#202938] flex items-center justify-between">
                        <div>
                            <div class="text-xs font-medium text-[#F8FAFC]">Lomba Debat Antar Kelas</div>
                            <div class="text-[11px] text-[#64748B] mt-0.5">Ruang Sidang • Selesai</div>
                        </div>
                        <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-[#202938] text-[#94A3B8]">Arsip</span>
                    </div>
                </div>

                <div class="p-3 rounded-lg bg-blue-600/5 border border-blue-500/10 flex items-center justify-between text-xs text-[#94A3B8]">
                    <span>Sistem Manajemen Terintegrasi</span>
                    <span class="text-blue-500 font-medium">v2.4 Secure</span>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="w-full max-w-7xl mx-auto px-6 py-6 border-t border-[#202938]/60 text-xs text-[#64748B] flex flex-col sm:flex-row items-center justify-between gap-4 relative z-10">
        <p>&copy; {{ date('Y') }} EventSpace. All rights reserved.</p>
        <div class="flex items-center gap-6">
            <span class="hover:text-[#94A3B8] transition cursor-pointer">Privacy</span>
            <span class="hover:text-[#94A3B8] transition cursor-pointer">Terms</span>
            <span class="hover:text-[#94A3B8] transition cursor-pointer">Support</span>
        </div>
    </footer>

</body>

</html>