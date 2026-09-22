@extends('layouts.app')

@section('title', 'Edit Acara - ' . $acara->nama)

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="pb-6 mb-6 border-b border-slate-800">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-semibold tracking-wide mb-2 shadow-sm">
                Manajemen Acara
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white">Edit Acara</h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-1">Perbarui detail informasi kegiatan sekolah di bawah ini.</p>
        </div>

        <!-- Form Card Container -->
        <div class="rounded-3xl bg-slate-950/40 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl shadow-xl">
            <form method="POST" action="{{ route('acara.update', $acara) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Nama Acara -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Nama Acara</label>
                    <input type="text" name="nama" value="{{ old('nama', $acara->nama) }}" 
                        class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 hover:border-slate-700 transition-all duration-200" required>
                    @error('nama') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Kategori</label>
                    <select name="kategori_id" class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 hover:border-slate-700 transition-all duration-200" required>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" class="bg-slate-900 text-white" @selected(old('kategori_id', $acara->kategori_id) == $kategori->id)>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Deskripsi Lengkap</label>
                    <textarea name="deskripsi" rows="4" 
                        class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 hover:border-slate-700 transition-all duration-200">{{ old('deskripsi', $acara->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal & Waktu (Grid 3 Kolom) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $acara->tanggal) }}" 
                            class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 transition" required>
                        @error('tanggal') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai', $acara->waktu_mulai) }}" 
                            class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 transition" required>
                        @error('waktu_mulai') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai', $acara->waktu_selesai) }}" 
                            class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 transition" required>
                        @error('waktu_selesai') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Lokasi Acara</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $acara->lokasi) }}" 
                        class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 transition" required>
                    @error('lokasi') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <!-- Kapasitas & Status (Grid 2 Kolom) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Kapasitas Peserta</label>
                        <input type="number" name="kapasitas" value="{{ old('kapasitas', $acara->kapasitas) }}" 
                            class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 transition" required>
                        @error('kapasitas') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Status Acara</label>
                        <select name="status" class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-4 py-3 text-xs sm:text-sm text-white focus:outline-none focus:border-blue-500 transition">
                            <option value="akan_datang" class="bg-slate-900" @selected(old('status', $acara->status) === 'akan_datang')>Akan Datang</option>
                            <option value="berlangsung" class="bg-slate-900" @selected(old('status', $acara->status) === 'berlangsung')>Berlangsung</option>
                            <option value="selesai" class="bg-slate-900" @selected(old('status', $acara->status) === 'selesai')>Selesai</option>
                        </select>
                        @error('status') <p class="text-rose-400 text-xs mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center gap-3 pt-4 border-t border-slate-900">
                    <button type="submit" class="px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium text-xs sm:text-sm shadow-lg shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('acara.index') }}" class="px-6 py-3 rounded-2xl bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs sm:text-sm border border-slate-800 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection