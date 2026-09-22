@extends('layouts.app')

@section('title', 'Daftar Acara - EventSpace')

@section('content')
<!-- Header & Action Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-6 mb-6 border-b border-slate-800">
    <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-xs font-semibold tracking-wide mb-2">
                Manajemen Event
            </div>
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white">Daftar Acara</h1>
        <p class="text-slate-400 text-xs sm:text-sm mt-1">Kelola dan temukan seluruh kegiatan resmi sekolah secara terpusat.</p>
    </div>

    @if(auth()->user()->role === 'admin' && Route::has('acara.create'))
    <div>
        <a href="{{ route('acara.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium text-xs shadow-sm transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Acara Baru</span>
        </a>
    </div>
    @endif
</div>

<!-- Search & Filter Control Bar -->
<form method="GET" action="{{ route('acara.index') }}" class="mb-6 grid grid-cols-1 sm:grid-cols-12 gap-3 bg-slate-900 p-3 rounded-2xl border border-slate-800 shadow-sm">
    <div class="sm:col-span-5 relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama acara..."
            class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-slate-200 text-xs sm:text-sm focus:outline-none focus:border-blue-500 transition-colors duration-200" />
    </div>

    <div class="sm:col-span-4">
        <select name="kategori_id" class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-slate-200 text-xs sm:text-sm focus:outline-none focus:border-blue-500 transition-colors duration-200">
            <option value="" class="bg-slate-950 text-slate-400">Semua Kategori</option>
            @foreach($kategoris as $kat)
            <option value="{{ $kat->id }}" class="bg-slate-950 text-white" @selected(request('kategori_id') == $kat->id)>
                {{ $kat->nama }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="sm:col-span-3 flex gap-2">
        <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs sm:text-sm font-medium border border-slate-700 transition-colors duration-200">
            Filter
        </button>
        @if(request('search') || request('kategori_id'))
        <a href="{{ route('acara.index') }}" class="px-3.5 py-2.5 rounded-xl bg-slate-950 hover:bg-slate-800 text-slate-400 hover:text-slate-200 text-xs sm:text-sm border border-slate-800 flex items-center justify-center transition-colors duration-200" title="Reset Filter">
            Reset
        </a>
        @endif
    </div>
</form>

<!-- Grid Card Acara -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    @forelse($acaras as $acara)
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-sm hover:border-slate-700 transition-all duration-200 flex flex-col justify-between">

        <div>
            <!-- Top Badges -->
            <div class="flex items-center justify-between gap-2 mb-3">
                <span class="px-2.5 py-1 rounded-md bg-slate-800 text-slate-300 text-[11px] font-medium tracking-wide">
                    {{ $acara->kategori->nama ?? 'Umum' }}
                </span>

                <!-- Badge Status Dinamis (Selesai: Abu, Berlangsung: Biru, Akan Datang: Oren) -->
                @php
                    $status = trim(strtolower($acara->status));
                    
                    if (str_contains($status, 'selesai') || str_contains($status, 'closed') || str_contains($status, 'past')) {
                        $badgeColor = 'bg-slate-800 text-slate-400 border-slate-700';
                        $dotColor = 'bg-slate-500';
                    } elseif (str_contains($status, 'berlangsung') || str_contains($status, 'active') || str_contains($status, 'ongoing')) {
                        $badgeColor = 'bg-blue-500/10 text-blue-400 border-blue-500/20';
                        $dotColor = 'bg-blue-400 animate-pulse';
                    } else {
                        $badgeColor = 'bg-amber-500/10 text-amber-400 border-amber-500/20';
                        $dotColor = 'bg-amber-400';
                    }
                @endphp

                <span class="px-2.5 py-1 rounded-md text-[11px] font-medium border flex items-center gap-1.5 {{ $badgeColor }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                    {{ ucfirst($acara->status) }}
                </span>
            </div>

            <!-- Title & Description -->
            <h3 class="text-base font-semibold text-white mb-1.5">
                {{ $acara->nama }}
            </h3>
            <p class="text-slate-400 text-xs line-clamp-2 leading-relaxed mb-4">
                {{ $acara->deskripsi }}
            </p>

            <!-- Metadata List -->
            <div class="space-y-1.5 py-3 border-t border-b border-slate-800 mb-4 text-xs text-slate-400">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Jadwal Pelaksanaan</span>
                    <span class="text-slate-200 font-medium">{{ $acara->tanggal }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Kapasitas Peserta</span>
                    <span class="text-slate-200 font-medium">{{ $acara->pendaftarans->count() }} / {{ $acara->kapasitas }}</span>
                </div>
            </div>
        </div>

        <!-- Action Footer -->
        <div class="flex items-center gap-2 pt-1">
            @if(Route::has('acara.show'))
            <a href="{{ route('acara.show', $acara->id) }}"
                class="flex-1 px-4 py-2 rounded-xl {{ auth()->user()->role === 'peserta' ? 'bg-blue-600 hover:bg-blue-500 text-white' : 'bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700' }} text-xs font-medium text-center transition-colors duration-200">
                {{ auth()->user()->role === 'peserta' ? 'Daftar Kegiatan' : 'Kelola Detail' }}
            </a>
            @endif

            @if(auth()->user()->role === 'admin')
                @if(Route::has('acara.edit'))
                <a href="{{ route('acara.edit', $acara->id) }}" class="px-3 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-medium border border-slate-700 transition-colors duration-200">
                    Edit
                </a>
                @endif
                @if(Route::has('acara.destroy'))
                <form action="{{ route('acara.destroy', $acara->id) }}" method="POST" onsubmit="return confirm('Hapus acara ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-3 py-2 rounded-xl bg-slate-800 hover:bg-rose-500/20 text-rose-400 text-xs font-medium border border-slate-700 hover:border-rose-500/30 transition-colors duration-200">
                        Hapus
                    </button>
                </form>
                @endif
            @endif
        </div>

    </div>
    @empty
    <div class="col-span-2 text-center py-12 bg-slate-900 border border-slate-800 rounded-2xl">
        <p class="text-slate-400 text-xs sm:text-sm">Tidak ada data acara yang ditemukan.</p>
    </div>
    @endforelse

</div>

<!-- Paginasi -->
<div class="mt-6">
    {{ $acaras->links() }}
</div>
@endsection