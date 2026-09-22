@extends('layouts.app')

@section('title', $acara->nama . ' - Sistem Event')

@section('content')
    <!-- Header Title & Tombol Edit -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-8 border-b border-slate-800">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold tracking-wide mb-2 shadow-sm">
                Detail Informasi Acara
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">{{ $acara->nama }}</h1>
        </div>

        @if(auth()->user()->role === 'admin')
            <div class="flex items-center gap-2">
                <a href="{{ route('acara.edit', $acara) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 text-xs font-medium border border-amber-500/30 hover:border-amber-500/50 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <span>Edit Acara</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Grid Layout Informasi Utama -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- Informasi Detail (Kiri - 2 Kolom) -->
        <div class="lg:col-span-2 rounded-3xl bg-slate-950/40 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl shadow-xl relative overflow-hidden group hover:border-slate-700 transition-all duration-300">
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-blue-600/15 to-purple-600/0 rounded-full blur-2xl pointer-events-none"></div>

            <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 pb-2 border-b border-slate-900">Spesifikasi Acara</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs sm:text-sm">
                <div class="space-y-1">
                    <span class="text-slate-500 text-xs font-medium">Kategori</span>
                    <p class="text-white font-medium flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        {{ $acara->kategori->nama ?? 'Umum' }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500 text-xs font-medium">Status</span>
                    <div>
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
                        <span class="px-2.5 py-1 rounded-md text-[11px] font-medium border inline-flex items-center gap-1.5 {{ $badgeColor }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                            {{ ucfirst($acara->status) }}
                        </span>
                    </div>
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <span class="text-slate-500 text-xs font-medium">Deskripsi Lengkap</span>
                    <p class="text-slate-300 leading-relaxed bg-slate-900/50 p-4 rounded-2xl border border-slate-800/60">
                        {{ $acara->deskripsi }}
                    </p>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500 text-xs font-medium">Lokasi</span>
                    <p class="text-white font-medium">{{ $acara->lokasi }}</p>
                </div>

                <div class="space-y-1">
                    <span class="text-slate-500 text-xs font-medium">Dibuat Oleh</span>
                    <p class="text-white font-medium">{{ $acara->pembuat->name ?? ($acara->user->name ?? 'Admin') }}</p>
                </div>
            </div>
        </div>

        <!-- Panel Aksi / Pendaftaran (Kanan - 1 Kolom) -->
        <div class="rounded-3xl bg-slate-950/40 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl shadow-xl flex flex-col justify-between group hover:border-blue-500/40 transition-all duration-300">
            <div>
                <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-4 pb-2 border-b border-slate-900">Status Pendaftaran</h3>

                <div class="py-4 text-center">
                    <span class="text-slate-400 text-xs block mb-1">Kapasitas Terisi</span>
                    <div class="text-3xl font-extrabold text-white tracking-tight">
                        {{ $acara->pendaftarans->count() }} <span class="text-slate-500 text-lg">/ {{ $acara->kapasitas }}</span>
                    </div>

                    <div class="w-full bg-slate-900 rounded-full h-2 mt-3 overflow-hidden border border-slate-800">
                        @php
                            $percentage = $acara->kapasitas > 0 ? min(100, ($acara->pendaftarans->count() / $acara->kapasitas) * 100) : 0;
                        @endphp
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Bagian Tombol Pendaftaran Peserta -->
            <div class="pt-6 border-t border-slate-900">
                @if(auth()->user()->role === 'peserta')
                    @if($acara->pendaftarans->count() >= $acara->kapasitas)
                        <div class="p-3 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs text-center font-medium">
                            Maaf, kuota acara ini sudah penuh.
                        </div>
                    @else
                        <button type="button" onclick="document.getElementById('modalDaftar').showModal()"
                            class="w-full py-3 px-4 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-semibold text-xs shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 text-center">
                            Daftar Acara Ini
                        </button>
                    @endif
                @else
                    <div class="p-3 rounded-2xl bg-slate-900 border border-slate-800 text-slate-400 text-xs text-center">
                        Aksi pendaftaran khusus akun peserta.
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Modal Popup Form Pendaftaran -->
    <dialog id="modalDaftar" class="rounded-2xl p-0 border border-slate-800 bg-slate-950 text-white backdrop:bg-black/60">
        <div class="p-6 w-80">
            <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-4 pb-2 border-b border-slate-800">
                Form Pendaftaran
            </h3>
            <form method="POST" action="{{ route('pendaftaran.store', $acara) }}" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs text-slate-400 mb-1">Nama</label>
                    <input type="text" name="nama" required
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs text-slate-400 mb-1">No HP</label>
                    <input type="text" name="no_hp" required
                        class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-sm text-white focus:outline-none focus:border-blue-500">
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="submit"
                        class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white text-xs font-semibold transition-all">
                        Kirim
                    </button>
                    <button type="button" onclick="document.getElementById('modalDaftar').close()"
                        class="px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-800 text-slate-400 text-xs hover:text-white transition-all">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Jadwal Acara -->
    <div class="rounded-3xl bg-slate-950/40 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl shadow-xl mb-8">
        <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider mb-6 pb-2 border-b border-slate-900">
            Jadwal Acara
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-800 text-slate-400">
                        <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Tanggal</th>
                        <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px]">Waktu</th>
                        @if(auth()->user()->role === 'admin')
                            <th class="py-3 px-3 font-semibold uppercase tracking-wider text-[11px] text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900/60">
                    @forelse($acara->jadwal ?? [] as $jadwal)
                        <tr class="hover:bg-slate-900/40 transition-colors">
                            <td class="py-3 px-3 text-white">{{ $jadwal->tanggal }}</td>
                            <td class="py-3 px-3 text-slate-300">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }} WIB</td>
                            @if(auth()->user()->role === 'admin')
                                <td class="py-3 px-3 text-right">
                                    <form method="POST" action="{{ route('jadwal.destroy', $jadwal) }}" onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 transition-all text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 3 : 2 }}" class="py-8 text-center text-slate-500 text-xs">
                                Belum ada jadwal.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(auth()->user()->role === 'admin')
            <form method="POST" action="{{ route('jadwal.store', $acara) }}" class="flex flex-wrap gap-2 mt-6 pt-4 border-t border-slate-900">
                @csrf
                <input type="date" name="tanggal" required class="bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white">
                <input type="time" name="waktu_mulai" required class="bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white">
                <input type="time" name="waktu_selesai" required class="bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white">
                <button type="submit" class="px-4 py-2 rounded-xl bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border border-blue-500/30 text-xs font-medium transition-all">
                    Tambah Jadwal
                </button>
            </form>
        @endif
    </div>

    <!-- Tombol Kembali -->
    <div>
        <a href="{{ route('acara.index') }}" class="inline-flex items-center gap-2 text-xs text-blue-400 hover:text-blue-300 transition-colors duration-200 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar Acara</span>
        </a>
    </div>
@endsection