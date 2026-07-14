@extends('layouts.app')
@section('title','Admin Dashboard')

@section('content')
<div class="space-y-10">
    @if(session('ok'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
            {{ session('ok') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.logo') }}" enctype="multipart/form-data" class="rounded-3xl border border-slate-200/80 bg-white/95 p-6 shadow-sm dark:border-slate-800/80 dark:bg-slate-900/70">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-4">
                @if(!empty($siteLogo))
                    <span class="inline-flex h-14 w-auto items-center justify-center rounded-2xl bg-white/80 p-2 shadow-sm ring-1 ring-slate-200 dark:bg-white/10 dark:ring-white/10">
                        <img src="{{ $siteLogo }}" alt="Logo saat ini" class="h-10 w-auto object-contain" />
                    </span>
                @else
                    <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl border border-dashed border-slate-300 text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 dark:border-white/20 dark:text-slate-500">KC</span>
                @endif
                <div class="space-y-1 text-sm">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Logo Navigasi</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-300">Unggah file PNG, JPG, atau SVG maks 1 MB. Logo tampil di header situs.</p>
                    @if($currentLogoPath)
                        <p class="text-xs text-slate-400 dark:text-slate-500">Disimpan di: <code class="text-[11px]">storage/{{ ltrim($currentLogoPath, '/') }}</code></p>
                    @endif
                </div>
            </div>

            <div class="flex flex-1 flex-col gap-4 lg:flex-row lg:items-center lg:justify-end">
                <div class="flex flex-col gap-2 text-sm">
                    <label class="inline-flex cursor-pointer items-center gap-3 rounded-full border border-slate-200 bg-white px-4 py-2 font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:bg-white/10 dark:text-slate-200">
                        <input type="file" name="logo" accept="image/*" class="hidden" />
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m6-6H6"/></svg>
                        Pilih Logo Baru
                    </label>
                    @error('logo')
                        <p class="text-xs font-semibold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-slate-900 px-5 py-2 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-white dark:text-slate-900">Simpan Perubahan</button>
                    @if($currentLogoPath)
                        <button type="submit" name="remove_logo" value="1" class="inline-flex items-center gap-2 rounded-full border border-rose-200 px-5 py-2 text-sm font-semibold text-rose-600 transition hover:border-rose-400 hover:text-rose-700 dark:border-rose-500/30 dark:text-rose-300">Hapus Logo</button>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <header class="flex flex-col gap-2">
        <p class="text-sm uppercase tracking-[0.3em] text-brand-500">Admin Panel</p>
        <h1 class="text-3xl font-black text-slate-900 dark:text-white">Ringkasan Hari Ini</h1>
        <p class="text-sm text-slate-500 dark:text-slate-300">Pantau performa platform dan buka modul manajemen konten melalui pintasan di bawah.</p>
    </header>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200/80 bg-white/95 p-6 shadow-sm dark:border-slate-800/80 dark:bg-slate-900/70">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Kunjungan 14 Hari Terakhir</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-300">Data dari middleware tracking</p>
                </div>
                <span class="rounded-full bg-brand-500/10 px-3 py-1 text-xs font-semibold tracking-wide text-brand-600">Traffic</span>
            </div>
            <canvas id="visitorsChart"></canvas>
        </div>

        <div class="rounded-3xl border border-slate-200/80 bg-white/95 p-6 shadow-sm dark:border-slate-800/80 dark:bg-slate-900/70">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Posting Populer</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-300">Berdasarkan total view</p>
                </div>
                <span class="rounded-full bg-amber-500/10 px-3 py-1 text-xs font-semibold tracking-wide text-amber-600">Konten</span>
            </div>
            <canvas id="topPostsChart"></canvas>
        </div>
    </div>

    <section class="rounded-3xl border border-slate-200/80 bg-white/95 p-6 shadow-sm dark:border-slate-800/80 dark:bg-slate-900/70">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Pintasan Manajemen</h2>
                <p class="text-sm text-slate-500 dark:text-slate-300">Kelola konten dan pengguna dari satu tempat.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-brand-600">Refresh</a>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('posts.index') }}" class="group rounded-2xl border border-slate-200/80 bg-slate-50/80 px-5 py-4 transition hover:border-brand-500 hover:bg-brand-500/5 dark:border-slate-700/80 dark:bg-slate-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-slate-900 transition group-hover:text-brand-600 dark:text-white dark:group-hover:text-brand-300">Kelola Postingan</h3>
                    <span class="rounded-full bg-brand-500/10 px-3 py-1 text-xs font-semibold text-brand-600">Author</span>
                </div>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-300">Buat, sunting, dan jadwalkan berita.</p>
            </a>

            <a href="{{ route('categories.index') }}" class="group rounded-2xl border border-slate-200/80 bg-slate-50/80 px-5 py-4 transition hover:border-brand-500 hover:bg-brand-500/5 dark:border-slate-700/80 dark:bg-slate-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-slate-900 transition group-hover:text-brand-600 dark:text-white dark:group-hover:text-brand-300">Kategori</h3>
                    <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-600">Struktur</span>
                </div>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-300">Atur rubrik supaya navigasi rapi.</p>
            </a>

            <a href="{{ route('admin.menus.index') }}" class="group rounded-2xl border border-slate-200/80 bg-slate-50/80 px-5 py-4 transition hover:border-brand-500 hover:bg-brand-500/5 dark:border-slate-700/80 dark:bg-slate-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-slate-900 transition group-hover:text-brand-600 dark:text-white dark:group-hover:text-brand-300">Menu Navigasi</h3>
                    <span class="rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold text-sky-600">UI</span>
                </div>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-300">Susun item menu utama dan footer.</p>
            </a>

            <a href="{{ route('admin.users.index') }}" class="group rounded-2xl border border-slate-200/80 bg-slate-50/80 px-5 py-4 transition hover:border-brand-500 hover:bg-brand-500/5 dark:border-slate-700/80 dark:bg-slate-900/70">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-slate-900 transition group-hover:text-brand-600 dark:text-white dark:group-hover:text-brand-300">Pengguna & Peran</h3>
                    <span class="rounded-full bg-rose-500/10 px-3 py-1 text-xs font-semibold text-rose-600">Akses</span>
                </div>
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-300">Promosikan author baru atau batasi akses.</p>
            </a>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const vLabels = @json($vLabels);
const vData = @json($vData);
new Chart(document.getElementById('visitorsChart'), {
    type: 'line',
    data: {
        labels: vLabels,
        datasets: [{
            label: 'Visitors',
            data: vData,
            borderColor: 'rgba(52, 103, 255, 0.8)',
            backgroundColor: 'rgba(52, 103, 255, 0.2)',
            tension: 0.35,
            fill: true,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

const tpLabels = @json($tpLabels);
const tpData = @json($tpData);
new Chart(document.getElementById('topPostsChart'), {
    type: 'bar',
    data: {
        labels: tpLabels,
        datasets: [{
            label: 'Views',
            data: tpData,
            backgroundColor: 'rgba(244, 114, 182, 0.7)',
            borderRadius: 8,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endsection
