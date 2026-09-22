@extends('layouts.app')

@section('title', 'Dashboard Panitia - Sistem Event')

@section('content')
<!-- Header Sambutan Panitia -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#202938] mb-6">
    <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#0D111A] border border-[#202938] text-blue-400 text-xs font-mono tracking-wide mb-2.5">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
            Role: Panitia Event
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-[#F8FAFC]">Dashboard Panitia</h1>
        <p class="text-[#94A3B8] text-sm mt-1">Selamat datang kembali, <span class="text-[#F8FAFC] font-medium">{{ auth()->user()->name }}</span>. Pantau data peserta dan acara di sini.</p>
    </div>
    <div>
        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#0D111A] border border-[#202938] text-[#94A3B8] text-xs font-medium">
            <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
            Panitia Aktif
        </span>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-6">
    <div class="p-5 rounded-xl bg-[#0D111A] border border-[#202938] flex items-center justify-between shadow-sm">
        <div>
            <p class="text-xs text-[#64748B] font-medium tracking-wider uppercase">Acara Tersedia</p>
            <h3 class="text-2xl font-semibold text-[#F8FAFC] mt-1">{{ $totalAcara }}</h3>
        </div>
        <div class="w-10 h-10 rounded-lg bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    </div>

    <div class="p-5 rounded-xl bg-[#0D111A] border border-[#202938] flex items-center justify-between shadow-sm">
        <div>
            <p class="text-xs text-[#64748B] font-medium tracking-wider uppercase">Total Peserta Terdaftar</p>
            <h3 class="text-2xl font-semibold text-[#F8FAFC] mt-1">{{ $totalPeserta }}</h3>
        </div>
        <div class="w-10 h-10 rounded-lg bg-purple-600/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </div>
    </div>
</div>

<!-- 5 Pendaftar Terbaru -->
<div class="rounded-xl bg-[#0D111A] border border-[#202938] p-6 sm:p-6 shadow-xl relative mb-6">
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-[#202938]">
        <div>
            <h3 class="text-sm font-semibold text-[#F8FAFC] uppercase tracking-wider">Pendaftar Terbaru</h3>
            <p class="text-xs text-[#64748B] mt-0.5">Daftar partisipan terakhir yang mendaftar ke acara</p>
        </div>
        @if(Route::has('pendaftaran.index'))
            <a href="{{ route('pendaftaran.index') }}" class="text-xs text-blue-400 hover:text-blue-300 transition-colors font-medium">Lihat Semua &rarr;</a>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-xs sm:text-sm text-left border-collapse">
            <thead>
                <tr class="border-b border-[#202938] text-[#64748B]">
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Nama</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Acara</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Status</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Terdaftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#202938]/60">
                @forelse($pendaftarTerbaru as $pendaftaran)
                    <tr class="hover:bg-[#111722]/50 transition-colors">
                        <td class="py-3.5 px-3 text-[#F8FAFC] font-medium">{{ $pendaftaran->nama }}</td>
                        <td class="py-3.5 px-3 text-[#94A3B8]">{{ $pendaftaran->acara->nama ?? '-' }}</td>
                        <td class="py-3.5 px-3">
                            @php
                                $status = strtolower($pendaftaran->status);
                                $badgeColor = match(true) {
                                    str_contains($status, 'terima') => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                    str_contains($status, 'tolak') => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                                    default => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md border text-[11px] font-medium {{ $badgeColor }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                                {{ ucfirst($pendaftaran->status) }}
                            </span>
                        </td>
                        <td class="py-3.5 px-3 text-[#64748B]">{{ $pendaftaran->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-[#64748B] text-xs">Belum ada data pendaftaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection