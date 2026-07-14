@extends('layouts.app')
@section('title','Reset Password')

@section('content')
<div class="mx-auto mt-10 max-w-md rounded-3xl border border-slate-200/80 bg-white/90 p-8 shadow-sm dark:border-slate-800/80 dark:bg-slate-900/70">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Reset Password</h1>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">Masukkan password baru kamu.</p>

    @if($errors->any())
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-400/40 dark:bg-red-500/10 dark:text-red-200">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="space-y-2">
            <label class="text-xs font-semibold uppercase tracking-widest text-slate-400">Email</label>
            <input type="email" name="email" value="{{ old('email', $email) }}" required autofocus class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-slate-700 dark:bg-slate-900" placeholder="Email">
        </div>

        <div class="space-y-2">
            <label class="text-xs font-semibold uppercase tracking-widest text-slate-400">Password Baru</label>
            <input type="password" name="password" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-slate-700 dark:bg-slate-900" placeholder="Password Baru">
        </div>

        <div class="space-y-2">
            <label class="text-xs font-semibold uppercase tracking-widest text-slate-400">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-slate-700 dark:bg-slate-900" placeholder="Konfirmasi Password">
        </div>

        <button class="w-full rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">Reset Password</button>
    </form>
</div>
@endsection