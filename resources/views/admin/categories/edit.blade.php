@extends('layouts.app')
@section('title','Edit Kategori')

@section('content')
<div class="space-y-8">
    <header class="flex items-center justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-brand-500">Kategori</p>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Perbarui Kategori</h1>
            <p class="text-sm text-slate-500 dark:text-slate-300">Sesuaikan nama atau deskripsi rubrik yang sudah ada.</p>
        </div>
        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-brand-500 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300">Kembali</a>
    </header>

    <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6 rounded-3xl border border-slate-200/80 bg-white/90 p-6 shadow-sm dark:border-slate-800/80 dark:bg-slate-900/70">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label class="text-xs font-semibold uppercase tracking-widest text-slate-400">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required maxlength="120" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-slate-700 dark:bg-slate-900">
            @error('name')
                <p class="text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2">
            <label class="text-xs font-semibold uppercase tracking-widest text-slate-400">Deskripsi (opsional)</label>
            <textarea name="description" rows="4" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-200 dark:border-slate-700 dark:bg-slate-900">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="text-xs font-semibold text-rose-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('categories.index') }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-500 hover:border-slate-300 hover:text-slate-700 dark:border-slate-700 dark:text-slate-300">Batal</a>
            <button type="submit" class="rounded-full bg-brand-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-brand-500">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection