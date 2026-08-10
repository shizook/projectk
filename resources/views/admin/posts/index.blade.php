@extends('layouts.app')
@section('title','Kelola Post')

@section('content')
<div class="flex items-center justify-between mb-6">
  <h1 class="text-2xl font-bold text-white">Posts</h1>
  <a href="{{ route('posts.create') }}" class="px-5 py-2.5 rounded-full bg-white text-[#03081a] font-semibold text-sm hover:bg-slate-200 transition">+ New</a>
</div>

<div class="overflow-x-auto rounded-3xl border border-white/10 bg-white/5 p-2">
  <table class="w-full text-left text-sm text-slate-300">
    <thead>
      <tr class="border-b border-white/10 text-xs font-semibold uppercase tracking-widest text-slate-400">
        <th class="p-4">Title</th>
        <th class="p-4">Author</th>
        <th class="p-4">Status</th>
        
        {{-- Hanya tampil untuk role Author --}}
        @if(auth()->user()->isAuthor())
          <th class="p-4">Updated</th>
        @endif

        <th class="p-4">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $p)
      <tr class="border-b border-white/5 hover:bg-white/5 transition">
        <td class="p-4 font-semibold text-white">{{ $p->title }}</td>
        <td class="p-4 text-slate-400">{{ $p->author->name }}</td>
        <td class="p-4">{{ ucfirst($p->status) }}</td>
        
        {{-- Hanya tampil untuk role Author --}}
        @if(auth()->user()->isAuthor())
          <td class="p-4 text-slate-400">{{ $p->updated_at->diffForHumans() }}</td>
        @endif

        <td class="p-4">
          <a class="underline mr-3 text-slate-300 hover:text-white" href="{{ route('posts.edit',$p) }}">Edit</a>
          <form class="inline" method="POST" action="{{ route('posts.destroy',$p) }}" onsubmit="return confirm('Hapus?')">
            @csrf @method('DELETE')
            <button class="underline text-rose-400 hover:text-rose-300">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="mt-6">{{ $posts->links() }}</div>
@endsection