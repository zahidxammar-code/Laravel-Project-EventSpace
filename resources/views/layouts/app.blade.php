<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Pengelolaan Event')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen selection:bg-blue-500 selection:text-white">

    <div class="relative flex flex-col min-h-screen overflow-x-hidden">

        <!-- Background Glow Effects -->
        <div class="absolute top-0 right-1/4 w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-[300px] h-[300px] bg-blue-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <!-- Navigation Bar -->
        @include('layouts.navigation')

        <!-- Main Container -->
        <main class="w-full max-w-5xl mx-auto px-4 py-8 relative z-10 flex-grow">

            <!-- Flash Messages -->
            @if(session('sukses'))
                <div class="mb-6 rounded-xl bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 px-4 py-3 text-sm flex items-center gap-2">
                    <span>{{ session('sukses') }}</span>
                </div>
            @endif

            @if(session('gagal'))
                <div class="mb-6 rounded-xl bg-rose-500/10 border border-rose-500/25 text-rose-400 px-4 py-3 text-sm flex items-center gap-2">
                    <span>{{ session('gagal') }}</span>
                </div>
            @endif

            <!-- Card Content Wrapper -->
            <div class="bg-slate-900/80 backdrop-blur-xl border border-slate-800/80 rounded-2xl shadow-2xl p-6 sm:p-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="w-full max-w-5xl mx-auto px-4 py-6 border-t border-slate-900 text-xs text-slate-500 text-center relative z-10">
            &copy; {{ date('Y') }} Sistem Pengelolaan Event Sekolah.
        </footer>

    </div>

</body>
</html>