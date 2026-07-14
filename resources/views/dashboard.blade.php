@extends('layouts.app')
@section('title','Pengaturan Akun')
@section('meta_description','Kelola profil Kompas Corner Anda')

@section('content')
<div class="space-y-12" x-data="{ photoName: '', photoPreview: '{{ auth()->user()->profile_photo_url }}' }">
    @if(session('ok'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
            {{ session('ok') }}
        </div>
    @endif

    <header class="space-y-2">
        <p class="section-label">Pengaturan</p>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Akun Saya</h1>
        <p class="text-sm text-slate-500 dark:text-slate-300">Perbarui informasi profil serta avatar yang akan muncul pada komentar dan navigasi.</p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="grid gap-8 lg:grid-cols-[1fr_0.8fr]">
        @csrf
        @method('PUT')

        <section class="glass-card p-10 space-y-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-center">
                <div class="relative">
                    <img x-bind:src="photoPreview" alt="Avatar" class="size-28 rounded-full object-cover ring-2 ring-white/70 dark:ring-white/10" />
                    <label class="absolute bottom-0 right-0 inline-flex size-9 cursor-pointer items-center justify-center rounded-full bg-slate-900 text-white shadow-lg transition hover:bg-slate-700 dark:bg-white dark:text-slate-900">
                        <input class="hidden" type="file" name="profile_photo" accept="image/*" x-on:change="photoName = $event.target.files[0]?.name; photoPreview = URL.createObjectURL($event.target.files[0])" />
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 4.75h4.5v4.5m0-4.5-6 6M19.25 19.25h-4.5v-4.5m0 4.5 6-6"/></svg>
                    </label>
                </div>
                <div class="space-y-2 text-sm text-slate-500 dark:text-slate-300">
                    <p>Unggah foto baru (maks 2 MB). Jika tidak dipilih, kami tetap gunakan avatar inisial.</p>
                    <p x-show="photoName" class="font-semibold text-slate-600 dark:text-slate-200">File terpilih: <span x-text="photoName"></span></p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Nama</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-slate-100" />
                    @error('name')
                        <p class="text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-slate-900 focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-slate-100" />
                    @error('email')
                        <p class="text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button type="submit" class="rounded-full bg-slate-900 px-6 py-2 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-white dark:text-slate-900">Simpan Perubahan</button>
                <small class="text-xs text-slate-400 dark:text-slate-500">Perubahan avatar akan tampil di komentar dan navigasi.</small>
            </div>
        </section>

        <aside class="glass-card p-10 space-y-5">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Info Akun</h2>
            <ul class="space-y-3 text-sm text-slate-500 dark:text-slate-300">
                <li><span class="font-semibold text-slate-700 dark:text-slate-100">Peran:</span> {{ ucfirst(auth()->user()->role) }}</li>
                <li><span class="font-semibold text-slate-700 dark:text-slate-100">Bergabung:</span> {{ auth()->user()->created_at->translatedFormat('d M Y') }}</li>
                <li><span class="font-semibold text-slate-700 dark:text-slate-100">Posting:</span> {{ auth()->user()->posts()->count() }}</li>
                <li><span class="font-semibold text-slate-700 dark:text-slate-100">Komentar:</span> {{ auth()->user()->comments()->count() }}</li>
            </ul>
            <div class="rounded-2xl border border-slate-200/80 bg-white/70 px-4 py-3 text-xs text-slate-500 dark:border-white/10 dark:bg-white/10 dark:text-slate-200">
                Ingin menonaktifkan akun? Hubungi redaksi melalui <a href="mailto:help@kompascorner.id" class="text-blue-500 hover:underline">help@kompascorner.id</a>.
            </div>
        </aside>
    </form>

    <section class="glass-card p-10">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Riwayat Aktivitas</h2>
        <p class="text-sm text-slate-500 dark:text-slate-300">Beberapa aktivitas terakhir di akun Anda.</p>
        <ul class="mt-4 space-y-3 text-sm text-slate-500 dark:text-slate-300">
            <li>• Login terakhir: {{ now()->translatedFormat('d M Y H:i') }}</li>
            <li>• Mengomentari artikel terbaru komunitas.</li>
            <li>• Menyimpan 3 artikel ke koleksi baca nanti.</li>
        </ul>
    </section>
</div>
@endsection