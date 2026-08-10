@extends('layouts.app')
@section('title','Reset Password')

@section('content')
<div class="mx-auto mt-10 max-w-md rounded-3xl border border-white/10 bg-white/5 p-8 shadow-sm">
    <h1 class="text-2xl font-bold text-white">Reset Password</h1>
    <p class="mt-2 text-sm text-slate-400">Masukkan password baru kamu.</p>

    @if($errors->any())
        <div class="mt-6 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-300">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="space-y-2">
            <label class="block text-xs font-semibold uppercase tracking-widest text-slate-400">Email</label>
            <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none focus:ring-2 focus:ring-white/10" placeholder="Email">
        </div>

        <div class="space-y-2">
            <label class="block mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Password</label>
            <div class="relative">
                <input type="password" name="password" required class="password-input w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 pr-12 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none focus:ring-2 focus:ring-white/10" placeholder="Password">
                <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white">
                <svg class="eye-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                </button>
            </div>
        </div>

<div class="space-y-2">
    <label class="block mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Konfirmasi Password</label>
    <div class="relative">
        <input type="password" name="password_confirmation" required class="password-input w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 pr-12 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none focus:ring-2 focus:ring-white/10" placeholder="Konfirmasi Password">
        <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white">
            <svg class="eye-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </button>
    </div>
</div>
        <button class="w-full rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#03081a] transition hover:bg-slate-200">Reset Password</button>
    </form>
</div>
@endsection