@extends('layouts.app')
@section('title','Kategori')

@section('content')
<div class="space-y-6">

    <!-- Container 1: Header & Tombol Tambah -->
    <div class="flex flex-col gap-4 rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="mt-1 text-2xl font-bold text-white">Kelola Kategori</h1>
            <p class="mt-1 text-sm text-slate-400">Daftar seluruh rubrik dan kategori berita yang tersedia di website.</p>
        </div>
        <div>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-2.5 text-sm font-semibold text-[#03081a] transition hover:bg-slate-200">
                + Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Container 2: Tabel Daftar Kategori -->
    <div class="overflow-x-auto rounded-3xl border border-white/10 bg-white/5 p-6">
        <table class="w-full text-left text-sm text-slate-300">
            <thead>
                <tr class="border-b border-white/10 text-xs font-semibold uppercase tracking-widest text-slate-400">
                    <th class="pb-4">Nama</th>
                    <th class="pb-4">Slug</th>
                    <th class="pb-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($categories as $c)
                <tr class="transition hover:bg-white/5">
                    <td class="py-4 font-semibold text-white">{{ $c->name }}</td>
                    <td class="py-4 text-slate-400">{{ $c->slug }}</td>
                    <td class="py-4">
                        <a href="{{ route('categories.edit',$c) }}" class="mr-3 font-semibold text-sky-400 underline hover:text-sky-300">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy',$c) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf 
                            @method('DELETE') 
                            <button class="font-semibold text-red-400 underline hover:text-rose-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Navigasi Halaman (Pagination) -->
        @if($categories->hasPages())
            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

</div>
@endsection