@extends('layouts.app')

@section('title', auth()->user()->role === 'peserta' ? 'Pendaftaran Saya - Sistem Event' : 'Data Pendaftaran - Sistem Event')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-8 border-b border-slate-800">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-semibold tracking-wide mb-2 shadow-sm">
                {{ auth()->user()->role === 'peserta' ? 'Riwayat Partisipasi' : 'Manajemen Partisipan' }}
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">
                {{ auth()->user()->role === 'peserta' ? 'Pendaftaran Saya' : 'Data Pendaftaran Peserta' }}
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-1">
                {{ auth()->user()->role === 'peserta' ? 'Daftar acara yang telah Anda ikuti atau daftarkan.' : 'Kelola dan pantau seluruh partisipan yang mendaftar ke acara.' }}
            </p>
        </div>
    </div>

    <div class="rounded-3xl bg-slate-950/40 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl shadow-xl overflow-hidden relative">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-purple-600/15 to-blue-600/0 rounded-full blur-2xl pointer-events-none"></div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-800 text-slate-400">
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">Acara</th>
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">Nama</th>
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">No HP</th>
                        @if(auth()->user()->role !== 'peserta')
                            <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">Akun</th>
                        @endif
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">Status</th>
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">Terdaftar Pada</th>
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900/60">
                    @forelse($pendaftarans as $pendaftaran)
                        <tr class="group hover:bg-slate-900/40 transition-colors duration-200">
                            <td class="py-4 px-4">
                                <span class="font-medium text-white group-hover:text-blue-400 transition-colors block">
                                    {{ $pendaftaran->acara->nama ?? '-' }}
                                </span>
                                <span class="text-[11px] text-slate-500">Lokasi: {{ $pendaftaran->acara->lokasi ?? '-' }}</span>
                            </td>

                            <td class="py-4 px-4 text-slate-300">{{ $pendaftaran->nama }}</td>
                            <td class="py-4 px-4 text-slate-300">{{ $pendaftaran->no_hp }}</td>

                            @if(auth()->user()->role !== 'peserta')
                                <td class="py-4 px-4 text-slate-300 font-medium">
                                    {{ $pendaftaran->user->name ?? '-' }}
                                </td>
                            @endif

                            <!-- Kolom Status -->
                            <td class="py-4 px-4">
                                @if(auth()->user()->role === 'peserta')
                                    @php
                                        $status = strtolower($pendaftaran->status);
                                        $badgeColor = match(true) {
                                            str_contains($status, 'terima') => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                            str_contains($status, 'tolak') => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                                            default => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full border text-[11px] font-medium inline-flex items-center gap-1.5 {{ $badgeColor }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                                        {{ ucfirst($pendaftaran->status) }}
                                    </span>
                                @else
                                    <form method="POST" action="{{ route('pendaftaran.updateStatus', $pendaftaran) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="bg-slate-900 border border-slate-800 rounded-xl px-2.5 py-1.5 text-[11px] text-white focus:outline-none focus:border-blue-500">
                                            <option value="menunggu" @selected($pendaftaran->status === 'menunggu')>Menunggu</option>
                                            <option value="diterima" @selected($pendaftaran->status === 'diterima')>Diterima</option>
                                            <option value="ditolak" @selected($pendaftaran->status === 'ditolak')>Ditolak</option>
                                        </select>
                                    </form>
                                @endif
                            </td>

                            <td class="py-4 px-4 text-slate-400">
                                {{ $pendaftaran->terdaftar_pada ?? $pendaftaran->created_at->format('d M Y, H:i') }}
                            </td>

                            <td class="py-4 px-4 text-right">
                                @if(Route::has('acara.show'))
                                    <a href="{{ route('acara.show', $pendaftaran->acara_id) }}" class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white border border-slate-800 transition-all text-xs">
                                        Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'peserta' ? 6 : 7 }}" class="py-12 text-center text-slate-500 text-xs">
                                Belum ada data pendaftaran yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-900">
            @if(isset($pendaftarans) && method_exists($pendaftarans, 'links'))
                {{ $pendaftarans->links() }}
            @endif
        </div>
    </div>
@endsection