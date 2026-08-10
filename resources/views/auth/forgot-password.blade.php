@extends('layouts.app')
@section('title','Lupa Password')

@section('content')
<div class="mx-auto mt-10 max-w-md rounded-3xl border border-white/10 bg-white/5 p-8 shadow-sm">
    <h1 class="text-2xl font-bold text-white">Lupa Password?</h1>
    <p class="mt-2 text-sm text-slate-400">Masukkan email yang digunakan untuk mengirim link reset password.</p>

    @if (session('status'))
        <div class="mt-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mt-6 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-300">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-5">
        @csrf
        <div class="space-y-2">
            <label class="block mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none focus:ring-2 focus:ring-white/10" placeholder="Email">
        </div>

        <button class="w-full rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#03081a] transition hover:bg-slate-200">Kirim Link Reset</button>
    </form>

    <div class="text-center mt-6">
        <a href="{{ route('login') }}" class="text-sm text-slate-400 hover:text-white hover:underline">
            Kembali ke Login
        </a>
    </div>
</div>
@endsection