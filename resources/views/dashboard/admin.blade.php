@extends('layouts.app')

@section('title', 'Dashboard Admin - EventSpace')

@section('content')
<!-- Header Sambutan -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-[#202938]">
    <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#0D111A] border border-[#202938] text-blue-400 text-xs font-mono tracking-wide mb-2.5">
            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
            Role: Administrator OS
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-[#F8FAFC]">Dashboard Admin</h1>
        <p class="text-[#94A3B8] text-sm mt-1">Selamat datang kembali, <span class="text-[#F8FAFC] font-medium">{{ auth()->user()->name }}</span>. Kelola sistem, event, dan akses pengguna dari satu pintu.</p>
    </div>
    <div>
        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#0D111A] border border-[#202938] text-[#94A3B8] text-xs font-medium">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            Sistem Aktif & Aman
        </span>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-6">
    <div class="p-5 rounded-xl bg-[#0D111A] border border-[#202938] flex items-center justify-between shadow-sm">
        <div>
            <p class="text-xs text-[#64748B] font-medium tracking-wider uppercase">Total Event</p>
            <h3 class="text-2xl font-semibold text-[#F8FAFC] mt-1">{{ $totalEvent }}</h3>
        </div>
        <div class="w-10 h-10 rounded-lg bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    </div>

    <div class="p-5 rounded-xl bg-[#0D111A] border border-[#202938] flex items-center justify-between shadow-sm">
        <div>
            <p class="text-xs text-[#64748B] font-medium tracking-wider uppercase">Upcoming Events</p>
            <h3 class="text-2xl font-semibold text-[#F8FAFC] mt-1">{{ $totalUpcoming }}</h3>
        </div>
        <div class="w-10 h-10 rounded-lg bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
    </div>

    <div class="p-5 rounded-xl bg-[#0D111A] border border-[#202938] flex items-center justify-between shadow-sm">
        <div>
            <p class="text-xs text-[#64748B] font-medium tracking-wider uppercase">Total Participants</p>
            <h3 class="text-2xl font-semibold text-[#F8FAFC] mt-1">{{ number_format($totalPeserta) }}</h3>
        </div>
        <div class="w-10 h-10 rounded-lg bg-blue-600/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
    </div>
</div>

<!-- Upcoming Events Table Section -->
<div class="rounded-xl bg-[#0D111A] border border-[#202938] p-6 sm:p-6 shadow-xl relative mb-6">
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-[#202938]">
        <div>
            <h3 class="text-sm font-semibold text-[#F8FAFC] uppercase tracking-wider">Upcoming Events</h3>
            <p class="text-xs text-[#64748B] mt-0.5">Daftar kegiatan mendatang yang siap dilaksanakan</p>
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
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Date</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Location</th>
                    <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#202938]/60">
                @forelse($acaraMendatang as $acara)
                    <tr class="hover:bg-[#111722]/50 transition-colors">
                        <td class="py-3.5 px-3">
                            <span class="text-[#F8FAFC] font-medium block">{{ $acara->nama }}</span>
                            <span class="block text-[11px] text-[#64748B] mt-0.5">{{ optional($acara->kategori)->nama ?? 'Umum' }}</span>
                        </td>
                        <td class="py-3.5 px-3 text-[#94A3B8]">{{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }}</td>
                        <td class="py-3.5 px-3 text-[#94A3B8]">{{ $acara->lokasi }}</td>
                        <td class="py-3.5 px-3">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[11px] font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                Open
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-[#64748B] text-xs">Belum ada event mendatang yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection