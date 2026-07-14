@extends('layouts.app')
@section('title','Kategori')

@section('content')
<h1 class="text-2xl font-bold mb-4">Kategori</h1>
<a href="{{ route('categories.create') }}" class="px-4 py-2 rounded bg-slate-900 text-white">+ New</a>
<table class="w-full text-left border mt-4">
  <thead><tr><th class="p-2">Nama</th><th class="p-2">Slug</th><th class="p-2">Aksi</th></tr></thead>
  <tbody>
    @foreach($categories as $c)
    <tr>
      <td class="p-2">{{ $c->name }}</td>
      <td class="p-2">{{ $c->slug }}</td>
      <td class="p-2">
        <a href="{{ route('categories.edit',$c) }}" class="underline">Edit</a>
        <form method="POST" action="{{ route('categories.destroy',$c) }}" class="inline">@csrf @method('DELETE') <button class="underline text-red-600">Delete</button></form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $categories->links() }}
@endsection
