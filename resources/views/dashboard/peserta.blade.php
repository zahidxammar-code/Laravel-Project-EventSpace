@extends('layouts.app')

@section('title', 'Dashboard Peserta - Sistem Event')

@section('content')
<!-- Header Sambutan Peserta -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#202938] mb-6">
    <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#0D111A] border border-[#202938] text-blue-400 text-xs font-mono tracking-wide mb-2.5">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
            Role: Peserta / Siswa
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-[#F8FAFC]">Dashboard Peserta</h1>
        <p class="text-[#94A3B8] text-sm mt-1">Selamat datang kembali, <span class="text-[#F8FAFC] font-medium">{{ auth()->user()->name }}</span>. Cari event menarik dan daftar di sini.</p>
    </div>
    <div>
        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#0D111A] border border-[#202938] text-[#94A3B8] text-xs font-medium">
            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
            Siap Mendaftar
        </span>
    </div>
</div>

<!-- Quick Info Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-6">
    <div class="p-5 rounded-xl bg-[#0D111A] border border-[#202938] flex items-center justify-between shadow-sm">
        <div>
            <p class="text-xs text-[#64748B] font-medium tracking-wider uppercase">Event Dibuka</p>
            <h3 class="text-2xl font-semibold text-[#F8FAFC] mt-1">{{ $totalEventDibuka }}</h3>
        </div>
        <div class="w-10 h-10 rounded-lg bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    </div>

    <div class="p-5 rounded-xl bg-[#0D111A] border border-[#202938] flex items-center justify-between shadow-sm">
        <div>
            <p class="text-xs text-[#64748B] font-medium tracking-wider uppercase">Event yang Diikuti</p>
            <h3 class="text-2xl font-semibold text-[#F8FAFC] mt-1">{{ $totalDiikuti }}</h3>
        </div>
        <div class="w-10 h-10 rounded-lg bg-purple-600/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
    </div>
</div>

<!-- 5 Acara Terbaru -->
<div class="rounded-xl bg-[#0D111A] border border-[#202938] p-6 sm:p-6 shadow-xl relative mb-6">
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-[#202938]">
        <div>
            <h3 class="text-sm font-semibold text-[#F8FAFC] uppercase tracking-wider">Acara Terbaru</h3>
            <p class="text-xs text-[#64748B] mt-0.5">Daftar event terbaru yang dapat Anda ikuti</p>
        </div>
        @if(Route::has('acara.index'))
            <a href="{{ route('acara.index') }}" class="text-xs text-blue-400 hover:text-blue-300 transition-colors font-medium">Lihat Semua &rarr;</a>
        @endif
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-xs sm:text-sm text-left border-collapse">
            <thead>
                <tr class="border-b border-[#202938] text-[#64748B]">
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Event</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Tanggal</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Lokasi</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px] text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#202938]/60">
                @forelse($acaraTerbaru as $acara)
                    <tr class="hover:bg-[#111722]/50 transition-colors">
                        <td class="py-3.5 px-3">
                            <span class="text-[#F8FAFC] font-medium block">{{ $acara->nama }}</span>
                            <span class="text-[11px] text-[#64748B] mt-0.5 block">{{ optional($acara->kategori)->nama ?? '-' }}</span>
                        </td>
                        <td class="py-3.5 px-3 text-[#94A3B8]">{{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }}</td>
                        <td class="py-3.5 px-3 text-[#94A3B8]">{{ $acara->lokasi }}</td>
                        <td class="py-3.5 px-3 text-right">
                            @if(Route::has('acara.show'))
                                <a href="{{ route('acara.show', $acara) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border border-blue-500/20 text-xs font-medium transition-all">
                                    Lihat
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-[#64748B] text-xs">Belum ada acara terbaru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection