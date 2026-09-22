@extends('layouts.app')

@section('title', 'Daftar Kategori - Sistem Event')

@section('content')
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-8 border-b border-slate-800">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold tracking-wide mb-2 shadow-sm">
                Manajemen Kategori
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Daftar Kategori</h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-1">Kelola kategori pengelompokan acara di sistem.</p>
        </div>
        
        <a href="{{ route('kategori.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium text-xs sm:text-sm shadow-lg shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Kategori</span>
        </a>
    </div>

    <!-- Table Container Card -->
    <div class="rounded-3xl bg-slate-950/40 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl shadow-xl overflow-hidden relative">
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-blue-600/15 to-purple-600/0 rounded-full blur-2xl pointer-events-none"></div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs sm:text-sm text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-800 text-slate-400">
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">Nama Kategori</th>
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px]">Deskripsi</th>
                        <th class="py-3.5 px-4 font-semibold uppercase tracking-wider text-[11px] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-900/60">
                    @forelse($kategoris as $kategori)
                        <tr class="group hover:bg-slate-900/40 transition-colors duration-200">
                            <td class="py-4 px-4 font-medium text-white group-hover:text-blue-400 transition-colors">
                                {{ $kategori->nama }}
                            </td>
                            <td class="py-4 px-4 text-slate-400">
                                {{ $kategori->deskripsi ?? '-' }}
                            </td>
                            <td class="py-4 px-4 text-right space-x-2">
                                <a href="{{ route('kategori.edit', $kategori) }}" 
                                   class="inline-flex items-center px-3 py-1.5 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 border border-amber-500/20 transition-all text-xs font-medium">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('kategori.destroy', $kategori) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 transition-all text-xs font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-12 text-center text-slate-500 text-xs">
                                Belum ada data kategori yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 pt-4 border-t border-slate-900">
            @if(isset($kategoris) && method_exists($kategoris, 'links'))
                {{ $kategoris->links() }}
            @endif
        </div>
    </div>
@endsection