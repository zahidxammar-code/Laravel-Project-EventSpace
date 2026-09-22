<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 space-y-1">
        <h2 class="text-lg font-bold tracking-tight text-[#F8FAFC]">Masuk ke EventSpace</h2>
        <p class="text-xs text-[#94A3B8]">Masukkan kredensial Anda untuk mengakses dashboard manajemen.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-[#94A3B8] mb-1.5">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                class="w-full px-3.5 py-2.5 rounded-lg bg-[#111722] border border-[#202938] text-[#F8FAFC] text-sm focus:outline-none focus:border-blue-500 transition-all placeholder:text-[#64748B]" placeholder="nama@domain.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-medium text-[#94A3B8] mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="w-full px-3.5 py-2.5 rounded-lg bg-[#111722] border border-[#202938] text-[#F8FAFC] text-sm focus:outline-none focus:border-blue-500 transition-all placeholder:text-[#64748B]" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-400" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs pt-0.5">
            <label for="remember_me" class="inline-flex items-center text-[#94A3B8] cursor-pointer hover:text-[#F8FAFC] transition">
                <input id="remember_me" type="checkbox" name="remember" class="rounded bg-[#111722] border-[#202938] text-blue-600 focus:ring-blue-500 focus:ring-offset-[#0D111A]">
                <span class="ms-2">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full py-2.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-medium text-xs shadow-sm transition-all duration-200">
                Masuk ke Akun
            </button>
        </div>

        <!-- Link Register -->
        @if (Route::has('register'))
            <p class="text-center text-xs text-[#94A3B8] pt-4 border-t border-[#202938]">
                Belum punya akun organisasi? 
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors ml-1">Daftar sekarang</a>
            </p>
        @endif
    </form>
</x-guest-layout>