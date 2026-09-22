<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EventSpace') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#080B12] text-[#F8FAFC] min-h-screen flex flex-col items-center justify-center relative overflow-hidden p-6 font-sans selection:bg-blue-600 selection:text-white">

        <!-- Subtle Ambient Background Glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-blue-600/[0.03] rounded-full blur-[140px] pointer-events-none"></div>

        <!-- Tombol Kembali ke Welcome & Logo Kecil -->
        <div class="w-full max-w-md mb-5 relative z-10 flex items-center justify-between">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-medium text-[#94A3B8] hover:text-[#F8FAFC] transition-colors bg-[#0D111A] border border-[#202938] px-3.5 py-2 rounded-lg group">
                <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Beranda</span>
            </a>

            <!-- Mini Logo Indicator -->
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded bg-[#111722] border border-[#202938] flex items-center justify-center p-1">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <span class="text-xs font-semibold tracking-tight text-[#F8FAFC]">Event<span class="text-blue-500">Space</span></span>
            </div>
        </div>

        <!-- Main Card Container -->
        <div class="relative z-10 w-full max-w-md bg-[#0D111A] border border-[#202938] rounded-xl shadow-2xl p-8">
            {{ $slot }}
        </div>

        <!-- Footer Kecil -->
        <div class="mt-8 text-xs text-[#64748B] relative z-10">
            &copy; {{ date('Y') }} EventSpace. Plan. Connect. Celebrate.
        </div>
    </body>
</html>