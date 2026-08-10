@extends('layouts.app')
@section('title','Tambah Kategori')

@section('content')
<div class="space-y-8">
    <header class="flex items-center justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Kategori</p>
            <h1 class="text-2xl font-bold text-white">Buat Kategori Baru</h1>
            <p class="text-sm text-slate-400">Atur rubrik agar navigasi konten tetap terstruktur.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-slate-300 transition hover:border-white/30 hover:text-white">Kembali</a>
    </header>

    <form method="POST" action="{{ route('categories.store') }}" class="space-y-6 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-sm">
        @csrf

        <div class="space-y-2">
            <label class="block text-xs font-semibold uppercase tracking-widest text-slate-400">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus maxlength="120" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none focus:ring-2 focus:ring-white/10" placeholder="Misal: Teknologi">
            @error('name')
                <p class="text-xs font-semibold text-rose-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-semibold uppercase tracking-widest text-slate-400">Deskripsi (opsional)</label>
            <textarea name="description" rows="4" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none focus:ring-2 focus:ring-white/10" placeholder="Gambaran singkat tentang rubrik ini">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-xs font-semibold text-rose-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('categories.index') }}" class="rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-slate-400 transition hover:border-white/30 hover:text-white">Batal</a>
            <button type="submit" class="rounded-full bg-white px-6 py-2 text-sm font-semibold text-[#03081a] transition hover:bg-slate-200">Simpan Kategori</button>
        </div>
    </form>
</div>
@endsection