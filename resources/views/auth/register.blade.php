@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="max-w-md mx-auto w-full px-5 py-16">
    <div class="bg-white/80 border border-blush-light rounded-3xl shadow-sm p-8">
        <h1 class="font-display italic text-3xl text-plum text-center mb-2">Buat Akun Baru</h1>
        <p class="text-sm text-plum/70 text-center mb-8">Daftar dulu supaya pesananmu tersimpan rapi.</p>

        <form method="POST" action="{{ route('register.attempt') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-plum mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full rounded-xl border border-blush-light px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blush-dark bg-cream/60">
            </div>

            <div>
                <label class="block text-sm font-medium text-plum mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full rounded-xl border border-blush-light px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blush-dark bg-cream/60">
            </div>

            <div>
                <label class="block text-sm font-medium text-plum mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full rounded-xl border border-blush-light px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blush-dark bg-cream/60">
                <p class="text-xs text-plum/50 mt-1">Minimal 8 karakter.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-plum mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full rounded-xl border border-blush-light px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blush-dark bg-cream/60">
            </div>

            <button type="submit"
                    class="w-full py-3 rounded-full bg-blush-dark text-white font-medium tracking-wide uppercase text-xs hover:bg-plum transition-colors">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-plum/70 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blush-dark font-medium hover:underline">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection