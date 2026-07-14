@extends('layouts.app')
@section('title','Kelola Menu Navigasi')

@section('content')
<h1 class="text-2xl font-bold mb-4">Menu Navigasi</h1>

<form method="POST" action="{{ route('admin.menus.store') }}" class="mb-6 p-4 border rounded-lg">
  @csrf
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <input name="title" placeholder="Judul" required class="px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
    <input name="url" placeholder="URL" required class="px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
    <select name="location" required class="px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
      <option value="header">Header</option>
      <option value="footer">Footer</option>
    </select>
    <input type="number" name="display_order" placeholder="Urutan" class="px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
    <select name="visible" class="px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-800">
      <option value="1">Tampil</option>
      <option value="0">Sembunyi</option>
    </select>
  </div>
  <button class="mt-3 px-4 py-2 bg-slate-900 text-white rounded-lg">Tambah</button>
</form>

<table class="w-full text-left border dark:border-slate-700">
  <thead>
    <tr><th class="p-2">Judul</th><th class="p-2">URL</th><th class="p-2">Lokasi</th><th class="p-2">Urutan</th><th class="p-2">Tampil?</th><th class="p-2">Aksi</th></tr>
  </thead>
  <tbody>
    @foreach($menus as $m)
    <tr>
      <td class="p-2">{{ $m->title }}</td>
      <td class="p-2">{{ $m->url }}</td>
      <td class="p-2">{{ ucfirst($m->location) }}</td>
      <td class="p-2">{{ $m->display_order }}</td>
      <td class="p-2">{{ $m->visible ? 'Ya' : 'Tidak' }}</td>
      <td class="p-2">
        <form method="POST" action="{{ route('admin.menus.update',$m) }}" class="inline">@csrf @method('PATCH')
          <button class="underline text-blue-600">Edit</button>
        </form>
        <form method="POST" action="{{ route('admin.menus.destroy',$m) }}" class="inline">@csrf @method('DELETE')
          <button class="underline text-red-600">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
