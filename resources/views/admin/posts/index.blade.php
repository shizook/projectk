@extends('layouts.app')
@section('title','Kelola Post')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Posts</h1>
  <a href="{{ route('posts.create') }}" class="px-4 py-2 rounded bg-slate-900 text-white dark:bg-white dark:text-slate-900">+ New</a>
</div>

<table class="w-full text-left border dark:border-slate-700">
  <thead>
    <tr class="border-b dark:border-slate-700">
      <th class="p-3">Title</th>
      <th class="p-3">Author</th>
      <th class="p-3">Status</th>
      <th class="p-3">Updated</th>
      <th class="p-3">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $p)
    <tr class="border-b dark:border-slate-700">
      <td class="p-3">{{ $p->title }}</td>
      <td class="p-3">{{ $p->author->name }}</td>
      <td class="p-3">{{ ucfirst($p->status) }}</td>
      <td class="p-3">{{ $p->updated_at->diffForHumans() }}</td>
      <td class="p-3">
        <a class="underline mr-2" href="{{ route('posts.edit',$p) }}">Edit</a>
        <form class="inline" method="POST" action="{{ route('posts.destroy',$p) }}" onsubmit="return confirm('Hapus?')">
          @csrf @method('DELETE')
          <button class="underline text-red-600">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="mt-4">{{ $posts->links() }}</div>
@endsection
