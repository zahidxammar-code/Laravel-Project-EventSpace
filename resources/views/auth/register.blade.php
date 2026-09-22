<x-guest-layout>
    <div class="mb-6 space-y-1">
        <h2 class="text-lg font-bold tracking-tight text-[#F8FAFC]">Buat Akun EventSpace</h2>
        <p class="text-xs text-[#94A3B8]">Mulai kelola event komunitas atau sekolah secara terstruktur.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-medium text-[#94A3B8] mb-1.5">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                class="w-full px-3.5 py-2.5 rounded-lg bg-[#111722] border border-[#202938] text-[#F8FAFC] text-sm focus:outline-none focus:border-blue-500 transition-all placeholder:text-[#64748B]" placeholder="Nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-400" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-[#94A3B8] mb-1.5">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                class="w-full px-3.5 py-2.5 rounded-lg bg-[#111722] border border-[#202938] text-[#F8FAFC] text-sm focus:outline-none focus:border-blue-500 transition-all placeholder:text-[#64748B]" placeholder="nama@domain.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-medium text-[#94A3B8] mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                class="w-full px-3.5 py-2.5 rounded-lg bg-[#111722] border border-[#202938] text-[#F8FAFC] text-sm focus:outline-none focus:border-blue-500 transition-all placeholder:text-[#64748B]" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-400" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-medium text-[#94A3B8] mb-1.5">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                class="w-full px-3.5 py-2.5 rounded-lg bg-[#111722] border border-[#202938] text-[#F8FAFC] text-sm focus:outline-none focus:border-blue-500 transition-all placeholder:text-[#64748B]" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-400" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-medium text-xs shadow-sm transition-all duration-200">
                Buat Akun Baru
            </button>
        </div>

        <!-- Link Login -->
        <p class="text-center text-xs text-[#94A3B8] pt-4 border-t border-[#202938]">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors ml-1">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>