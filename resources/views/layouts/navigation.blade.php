<nav x-data="{ open: false }" class="sticky top-4 z-50 w-full max-w-5xl mx-auto px-4 animate-fade-in-down">
    <div class="backdrop-blur-[120px] backdrop-saturate-150 bg-[#080B12]/25 border border-white/10 rounded-3xl shadow-2xl shadow-blue-950/20 px-4 sm:px-6 py-3 transition-all duration-300">
        <div class="flex items-center justify-between">

            <!-- Logo & Nav Links (Desktop) -->
            <div class="flex items-center gap-6 text-sm">
                <!-- Logo dengan Efek Hover -->
                <div class="flex items-center gap-2 group cursor-pointer">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo EventSpace"
                        class="w-8 h-8 rounded-2xl object-cover shadow-lg shadow-blue-500/30 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-blue-500/50 transition-all duration-300">
                    <span class="font-bold tracking-tight text-white hidden sm:inline group-hover:text-blue-400 transition-colors duration-200">EventSpace</span>
                </div>

                <!-- Menu Navigasi Desktop -->
                <div class="hidden md:flex items-center gap-1">

                    <!-- Menu Dashboard -->
                    @if(Route::has('dashboard'))
                    <a href="{{ route('dashboard') }}"
                        class="relative px-3 py-2 rounded-xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:scale-[1.05] active:scale-[0.97] {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Dashboard
                        </span>
                        @if(request()->routeIs('dashboard'))
                        <span class="absolute left-2 right-2 -bottom-1 h-0.5 rounded-full bg-blue-500"></span>
                        @endif
                    </a>
                    @endif

                    <!-- Menu Acara -->
                    @if(Route::has('acara.index'))
                    <a href="{{ route('acara.index') }}"
                        class="relative px-3 py-2 rounded-xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:scale-[1.05] active:scale-[0.97] {{ request()->routeIs('acara.*') ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Acara
                        </span>
                        @if(request()->routeIs('acara.*'))
                        <span class="absolute left-2 right-2 -bottom-1 h-0.5 rounded-full bg-blue-500"></span>
                        @endif
                    </a>
                    @endif

                    <!-- Menu Kategori (Admin) -->
                    @if(auth()->user()->role === 'admin' && Route::has('kategori.index'))
                    <a href="{{ route('kategori.index') }}"
                        class="relative px-3 py-2 rounded-xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:scale-[1.05] active:scale-[0.97] {{ request()->routeIs('kategori.*') ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h6"></path>
                            </svg>
                            Kategori
                        </span>
                        @if(request()->routeIs('kategori.*'))
                        <span class="absolute left-2 right-2 -bottom-1 h-0.5 rounded-full bg-blue-500"></span>
                        @endif
                    </a>
                    @endif

                    <!-- Menu Kelola Panitia (Admin) -->
                    @if(auth()->user()->role === 'admin' && Route::has('panitia.index'))
                    <a href="{{ route('panitia.index') }}"
                        class="relative px-3 py-2 rounded-xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:scale-[1.05] active:scale-[0.97] {{ request()->routeIs('panitia.*') ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Kelola Panitia
                        </span>
                        @if(request()->routeIs('panitia.*'))
                        <span class="absolute left-2 right-2 -bottom-1 h-0.5 rounded-full bg-blue-500"></span>
                        @endif
                    </a>
                    @endif

                    <!-- Menu Pendaftaran -->
                    @if(Route::has('pendaftaran.index'))
                    <a href="{{ route('pendaftaran.index') }}"
                        class="relative px-3 py-2 rounded-xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:scale-[1.05] active:scale-[0.97] {{ request()->routeIs('pendaftaran.*') ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            Pendaftaran
                        </span>
                        @if(request()->routeIs('pendaftaran.*'))
                        <span class="absolute left-2 right-2 -bottom-1 h-0.5 rounded-full bg-blue-500"></span>
                        @endif
                    </a>
                    @endif
                </div>
            </div>

            <!-- User Info & Logout (Desktop) -->
            <div class="hidden md:flex items-center gap-2 pl-3 pr-1.5 py-1.5 rounded-2xl bg-slate-800/50 border border-slate-700/40 hover:bg-slate-800/70 hover:border-slate-600/50 transition-all duration-200 group">
                <!-- Diubah dari bg-blue-600 ke background abu-abu gelap dengan teks/icon abu-abu terang -->
                <div class="w-8 h-8 rounded-xl bg-slate-700/60 border border-slate-600/50 flex items-center justify-center text-slate-300 shrink-0 shadow-sm group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-4.5 h-4.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4.418 0-8 2.239-8 5v1a1 1 0 001 1h14a1 1 0 001-1v-1c0-2.761-3.582-5-8-5z" />
                    </svg>
                </div>

                <div class="flex flex-col leading-tight pr-2">
                    <span class="font-semibold text-slate-200 text-xs">{{ auth()->user()->name }}</span>
                    <span @class([ 'text-[10px] capitalize' , 'text-blue-400'=> auth()->user()->role === 'admin',
                        'text-purple-400' => auth()->user()->role === 'panitia',
                        'text-emerald-400' => auth()->user()->role === 'peserta',
                        ])>{{ auth()->user()->role }}</span>
                </div>

                <div class="w-px h-6 bg-slate-700/60"></div>

                <form method="POST" action="{{ route('logout') }}" class="pl-1">
                    @csrf
                    <button type="submit" class="p-1.5 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 hover:scale-110 active:scale-95 transition-all duration-200" title="Logout">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>  

            <!-- Hamburger Button (Mobile) -->
            <div class="flex items-center md:hidden">
                <button @click="open = ! open" class="p-2 rounded-2xl bg-slate-800/50 text-slate-300 hover:text-white border border-slate-700/40 hover:scale-105 active:scale-95 focus:outline-none transition-all duration-200">
                    <svg x-show="!open" class="w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" x-cloak class="w-5 h-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden pt-4 pb-2 mt-3 border-t border-slate-800/60 space-y-1">

            <div class="flex items-center gap-3 px-2 py-1.5 mb-2">
                <!-- Diubah dari bg-blue-600 ke background abu-abu gelap dengan teks/icon abu-abu terang -->
                <div class="w-8 h-8 rounded-xl bg-slate-700/60 border border-slate-600/50 flex items-center justify-center text-slate-300 shadow-sm">
                    <svg class="w-4.5 h-4.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4.418 0-8 2.239-8 5v1a1 1 0 001 1h14a1 1 0 001-1v-1c0-2.761-3.582-5-8-5z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs font-semibold text-white">{{ auth()->user()->name }}</div>
                    <div @class([ 'text-[10px] capitalize' , 'text-blue-400'=> auth()->user()->role === 'admin',
                        'text-purple-400' => auth()->user()->role === 'panitia',
                        'text-emerald-400' => auth()->user()->role === 'peserta',
                        ])>{{ auth()->user()->role }}</div>
                </div>
            </div>

            @if(Route::has('dashboard'))
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-2xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:translate-x-1 {{ request()->routeIs('dashboard') ? 'bg-slate-800/60 text-white font-semibold border-l-2 border-blue-500' : 'text-slate-200' }}">Dashboard</a>
            @endif

            @if(Route::has('acara.index'))
            <a href="{{ route('acara.index') }}" class="block px-3 py-2 rounded-2xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:translate-x-1 {{ request()->routeIs('acara.*') ? 'bg-slate-800/60 text-white font-semibold border-l-2 border-blue-500' : 'text-slate-200' }}">Acara</a>
            @endif

            @if(auth()->user()->role === 'admin' && Route::has('kategori.index'))
            <a href="{{ route('kategori.index') }}" class="block px-3 py-2 rounded-2xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:translate-x-1 {{ request()->routeIs('kategori.*') ? 'bg-slate-800/60 text-white font-semibold border-l-2 border-blue-500' : 'text-slate-200' }}">Kategori</a>
            @endif

            @if(auth()->user()->role === 'admin' && Route::has('panitia.index'))
            <a href="{{ route('panitia.index') }}" class="block px-3 py-2 rounded-2xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:translate-x-1 {{ request()->routeIs('panitia.*') ? 'bg-slate-800/60 text-white font-semibold border-l-2 border-blue-500' : 'text-slate-200' }}">Kelola Panitia</a>
            @endif

            @if(Route::has('pendaftaran.index'))
            <a href="{{ route('pendaftaran.index') }}" class="block px-3 py-2 rounded-2xl text-xs font-medium transition-all duration-200 hover:bg-slate-800/60 hover:translate-x-1 {{ request()->routeIs('pendaftaran.*') ? 'bg-slate-800/60 text-white font-semibold border-l-2 border-blue-500' : 'text-slate-200' }}">Pendaftaran</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-slate-800/60">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-2xl text-xs font-medium text-rose-400 hover:bg-rose-500/10 transition-colors duration-200">Keluar Sistem</button>
            </form>
        </div>
    </div>
</nav>

<!-- Tambahan Keyframe Animasi Masuk Profesional -->
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-down {
        animation: fadeInDown 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>