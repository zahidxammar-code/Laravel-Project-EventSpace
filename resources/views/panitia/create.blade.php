@extends('layouts.app')

@section('title', 'Tambah Akun Panitia - Sistem Event')

@section('content')
    <div class="max-w-xl mx-auto">
        <!-- Header Section -->
        <div class="pb-6 mb-6 border-b border-slate-800">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold tracking-wide mb-2 shadow-sm">
                Manajemen Pengguna
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Tambah Akun Panitia</h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-1">Buat kredensial login baru untuk panitia acara.</p>
        </div>

        <!-- Form Container Card -->
        <div class="rounded-3xl bg-slate-950/40 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl shadow-xl">
            <form method="POST" action="{{ route('panitia.store') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama panitia"
                           class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 hover:border-slate-700 transition-all duration-200" required>
                    @error('name') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="panitia@example.com"
                           class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 hover:border-slate-700 transition-all duration-200" required>
                    @error('email') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                           class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 hover:border-slate-700 transition-all duration-200" required>
                    @error('password') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-slate-900">
                    <button type="submit" class="px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium text-xs sm:text-sm shadow-lg shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Simpan Akun
                    </button>
                    <a href="{{ route('panitia.index') }}" class="px-6 py-3 rounded-2xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs sm:text-sm border border-slate-800 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection