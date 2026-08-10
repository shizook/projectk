@extends('layouts.app')
@section('title','Kelola Menu Navigasi')

@section('content')
<div class="space-y-6">

    <!-- Container 1: Judul Halaman -->
    <div class="rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur">
        <h1 class="mt-1 text-2xl font-bold text-white">Menu Navigasi</h1>
        <p class="mt-1 text-sm text-slate-400">Atur dan kelola susunan menu utama yang tampil pada header website.</p>
        <br>
        <p class="mt-1 text-sm text-slate-400">(Pastikan kategori sudah ditambah terlebih dahulu di kategori sebelum masuk di header)</p>
    </div>

    <!-- Container 2: Form Dynamic (Tambah / Edit) -->
    <form method="POST" action="{{ isset($menuData) ? route('admin.menus.update', $menuData) : route('admin.menus.store') }}" class="rounded-3xl border border-white/10 bg-white/5 p-6 shadow-sm">
        @csrf
        @if(isset($menuData))
            @method('PATCH')
        @endif
        
        <input type="hidden" name="location" value="header">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Judul -->
            <div>
                <label class="block mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Judul</label>
                <input name="title" value="{{ old('title', $menuData->title ?? '') }}" placeholder="Judul Menu" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none">
            </div>

            <!-- URL -->
            <div>
                <label class="block mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">URL</label>
                <input name="url" value="{{ old('url', $menuData->url ?? '') }}" placeholder='Masukkan "/category/(judul)"' required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none">
            </div>

            <!-- Urutan -->
            <div>
                <label class="block mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Urutan</label>
                <input type="number" name="display_order" value="{{ old('display_order', $menuData->display_order ?? '') }}" placeholder="Urutan header" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-white/30 focus:outline-none">
            </div>

            <!-- Status Tampil -->
            <div>
                <label class="block mb-2 text-xs font-semibold uppercase tracking-widest text-slate-400">Status</label>
                <select name="visible" class="w-full rounded-2xl border border-white/10 bg-[#03081a] px-4 py-2.5 text-sm text-white focus:border-white/30 focus:outline-none">
                    <option value="1" {{ old('visible', $menuData->visible ?? 1) == 1 ? 'selected' : '' }}>Tampil</option>
                    <option value="0" {{ old('visible', $menuData->visible ?? 1) == 0 ? 'selected' : '' }}>Sembunyi</option>
                </select>
            </div>
        </div>

        <div class="mt-5 flex items-center gap-3">
            <button type="submit" class="rounded-full bg-white px-6 py-2.5 text-sm font-semibold text-[#03081a] transition hover:bg-slate-200">
                {{ isset($menuData) ? 'Simpan Perubahan' : '+ Tambah Menu' }}
            </button>

            @if(isset($menuData))
                <a href="{{ route('admin.menus.index') }}" class="rounded-full border border-white/20 px-6 py-2.5 text-sm font-semibold text-slate-300 hover:bg-white/10 transition">
                    Batal Edit
                </a>
            @endif
        </div>
    </form>

    <!-- Container 3: Tabel Daftar Menu -->
    <div class="overflow-x-auto rounded-3xl border border-white/10 bg-white/5 p-6">
        <table class="w-full text-left text-sm text-slate-300">
            <thead>
                <tr class="border-b border-white/10 text-xs font-semibold uppercase tracking-widest text-slate-400">
                    <th class="pb-4">Judul</th>
                    <th class="pb-4">URL</th>
                    <th class="pb-4">Urutan</th>
                    <th class="pb-4">Tampil?</th>
                    <th class="pb-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($menus as $m)
                <tr class="transition hover:bg-white/5">
                    <td class="py-4 font-semibold text-white">{{ $m->title }}</td>
                    <td class="py-4 text-slate-400">{{ $m->url }}</td>
                    <td class="py-4">{{ $m->display_order ?? '-' }}</td>
                    <td class="py-4">
                        @if($m->visible)
                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-400 border border-emerald-500/20">Ya</span>
                        @else
                            <span class="rounded-full bg-rose-500/10 px-3 py-1 text-xs font-semibold text-rose-400 border border-rose-500/20">Tidak</span>
                        @endif
                    </td>
                    <td class="py-4 flex items-center">
                        <!-- Link Edit yang memicu query parameter ?edit=ID -->
                        <a href="{{ route('admin.menus.index', ['edit' => $m->id]) }}" class="mr-3 font-semibold text-sky-400 underline hover:text-sky-300">
                            Edit
                        </a>

                        <!-- Form Hapus -->
                        <form method="POST" action="{{ route('admin.menus.destroy', $m) }}" class="inline" onsubmit="return confirm('Hapus menu ini?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="font-semibold text-rose-400 underline hover:text-red-400">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection