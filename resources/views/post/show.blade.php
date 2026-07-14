@extends('layouts.app')
@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('content')
<article class="max-w-3xl mx-auto">
  <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
  <div class="text-sm text-slate-500 dark:text-slate-400 mt-1">
    {{ optional($post->published_at)->format('d M Y') }} · {{ $post->category?->name }}
  </div>

  @if($post->cover_image)
    <img src="{{ asset('storage/'.$post->cover_image) }}" class="my-4 rounded-xl w-full object-cover max-h-[500px]">
  @endif

  <div class="prose dark:prose-invert max-w-none">{!! $post->content !!}</div>

  <section class="mt-10">
    <h2 class="text-xl font-semibold mb-4">Komentar</h2>
    @auth
      <form method="POST" action="{{ route('comments.store', $post->slug) }}" class="space-y-3">
        @csrf
        <textarea name="content" required rows="3" class="w-full p-3 rounded-lg bg-slate-100 dark:bg-slate-800"></textarea>
        <button class="px-4 py-2 rounded-lg bg-slate-900 text-white dark:bg-white dark:text-slate-900">Kirim</button>
      </form>
    @else
      <p class="text-sm">Silakan <a class="underline" href="{{ route('login') }}">login</a> untuk berkomentar.</p>
    @endauth

    <div class="mt-6 space-y-4">
      @foreach($post->comments as $c)
        <div class="p-3 rounded-lg border border-slate-200 dark:border-slate-700">
          <div class="text-sm text-slate-500">{{ $c->user->name }} · {{ $c->created_at->diffForHumans() }}</div>
          <p class="mt-2">{{ $c->content }}</p>
        </div>
      @endforeach
    </div>
  </section>

  @if($related->count())
    <section class="mt-10">
      <h2 class="text-xl font-semibold mb-4">Related</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($related as $r)
          <a href="{{ route('post.show',$r->slug) }}" class="p-4 rounded-xl border hover:bg-slate-50 dark:hover:bg-slate-800">
            <div class="font-semibold">{{ $r->title }}</div>
            <div class="text-sm text-slate-500">{{ optional($r->published_at)->format('d M Y') }}</div>
          </a>
        @endforeach
      </div>
    </section>
  @endif
</article>
@endsection



