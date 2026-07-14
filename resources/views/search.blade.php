@extends('layouts.app')
@section('title', 'Hasil Pencarian | Kompas Corner')
@section('meta_description', 'Cari berita berdasarkan judul, konten, atau kategori')

@section('content')
<h1 class="text-2xl font-bold mb-4">Hasil Pencarian</h1>
@if($q)
  <p class="mb-4">Keyword: <span class="font-semibold">{{ $q }}</span></p>
@endif
@if($cat)
  <p class="mb-4">Kategori: <span class="font-semibold">{{ $cat }}</span></p>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <div class="md:col-span-2 space-y-4">
    @forelse($posts as $p)
      <article class="p-4 rounded-xl border border-slate-200 dark:border-slate-700">
        <a href="{{ route('post.show',$p->slug) }}" class="text-xl font-semibold hover:underline">{{ $p->title }}</a>
        <div class="text-sm text-slate-500 dark:text-slate-400 mt-1">
          {{ optional($p->published_at)->format('d M Y') }} · {{ $p->category?->name ?? '-' }}
        </div>
        <p class="text-slate-700 dark:text-slate-200">{{ $p->excerpt }}</p>
      </article>
    @empty
      <p>Tidak ada hasil.</p>
    @endforelse
    {{ $posts->links() }}
  </div>
  <aside class="space-y-6">
    @include('components.sidebar-latest',['latest'=>$latest])
    <div>
      <h3 class="text-lg font-semibold mb-3">Popular</h3>
      <div class="space-y-3">
        @foreach($popular as $pp)
          <a class="block hover:underline" href="{{ route('post.show',$pp->slug) }}">{{ $pp->title }}</a>
        @endforeach
      </div>
    </div>
  </aside>
</div>
@endsection
