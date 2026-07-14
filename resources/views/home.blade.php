@extends('layouts.app')
@section('title', isset($activeCategory) ? $activeCategory->name.' | Kompas Corner' : 'Beranda | Kompas Corner')
@section('meta_description', 'Berita terbaru dan populer dari Kompas Corner')

@section('content')
@php
    $collection = collect($posts->items());
    $hero = $collection->shift();
    $topStories = $collection->take(4);
    $moreStories = $collection->skip(4);
@endphp

@if(!$hero)
    <div class="rounded-3xl border border-dashed border-slate-300 bg-white/70 p-12 text-center text-slate-500 dark:border-slate-700 dark:bg-slate-900/70">
        <h2 class="text-2xl font-semibold">Belum ada berita</h2>
        <p class="mt-3">Silakan tambahkan artikel pertama Anda melalui panel admin.</p>
    </div>
@else
    <div class="grid gap-10 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]">
        <section class="space-y-10">
            <article class="relative overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-900 text-white shadow-xl dark:border-slate-800">
                <div class="absolute inset-0">
                    @if($hero->cover_image)
                        <img src="{{ asset('storage/'.$hero->cover_image) }}" alt="{{ $hero->title }}" class="h-full w-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
                    @else
                        <div class="h-full w-full bg-gradient-to-br from-slate-800 via-slate-900 to-slate-950"></div>
                    @endif
                </div>
                <div class="relative flex flex-col gap-6 p-8 sm:p-10 md:p-14">
                    <span class="inline-flex w-fit items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-widest text-white">
                        {{ $hero->category->name ?? 'Umum' }}
                    </span>
                    <div class="space-y-4">
                        <h1 class="text-3xl font-black leading-tight tracking-tight sm:text-4xl md:text-5xl">
                            {{ $hero->title }}
                        </h1>
                        <p class="max-w-2xl text-base text-slate-200 sm:text-lg">
                            {{ $hero->excerpt ?? str($hero->content)->stripTags()->limit(150) }}
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-300">
                        <span>{{ optional($hero->published_at)->translatedFormat('d M Y') ?? 'Draft' }}</span>
                        <span class="hidden md:inline">&middot;</span>
                        <span>{{ $hero->author->name ?? 'Kompas Corner' }}</span>
                    </div>
                    <div class="mt-auto flex flex-wrap items-center gap-4">
                        <a href="{{ route('post.show', $hero->slug) }}" class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                            Baca selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m13.5 4.5 6 6-6 6m6-6h-15" />
                            </svg>
                        </a>
                        <span class="hidden rounded-full border border-white/30 px-4 py-2 text-xs uppercase tracking-widest text-white lg:inline-flex">Sorotan utama</span>
                    </div>
                </div>
            </article>

            @if($topStories->isNotEmpty())
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Top Stories</h2>
                        <a href="{{ route('search', ['sort' => 'latest']) }}" class="text-sm font-semibold text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">Lihat semua</a>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2">
                        @foreach($topStories as $story)
                            <a href="{{ route('post.show', $story->slug) }}" class="group flex h-full flex-col justify-between rounded-2xl border border-slate-200/80 bg-white/80 p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:border-slate-800/80 dark:bg-slate-900/60">
                                <div class="space-y-3">
                                    <span class="inline-flex w-fit items-center rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-wider text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                                        {{ $story->category->name ?? 'Umum' }}
                                    </span>
                                    <h3 class="text-lg font-semibold leading-tight text-slate-900 transition group-hover:text-slate-700 dark:text-white dark:group-hover:text-slate-200">
                                        {{ $story->title }}
                                    </h3>
                                    <p class="text-sm text-slate-500 line-clamp-3 dark:text-slate-300">
                                        {{ $story->excerpt ?? str($story->content)->stripTags()->limit(120) }}
                                    </p>
                                </div>
                                <div class="mt-6 flex items-center justify-between text-xs font-semibold text-slate-400">
                                    <span>{{ optional($story->published_at)->translatedFormat('d M Y') }}</span>
                                    <span class="flex items-center gap-1 text-slate-500 transition group-hover:text-slate-900 dark:text-slate-300 dark:group-hover:text-white">
                                        Baca
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($moreStories->isNotEmpty())
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Berita Terbaru</h2>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2">
                        @foreach($moreStories as $story)
                            <article class="flex h-full flex-col rounded-2xl border border-slate-200/80 bg-white/80 p-5 shadow-sm transition hover:shadow-lg dark:border-slate-800/80 dark:bg-slate-900/60">
                                <div class="flex items-center gap-3 text-xs text-slate-400">
                                    <span>{{ optional($story->published_at)->translatedFormat('d M Y') }}</span>
                                    <span>&middot;</span>
                                    @if($story->category)
                                        <a href="{{ route('category.show', $story->category->slug) }}" class="font-semibold uppercase tracking-widest text-slate-500 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
                                            {{ $story->category->name }}
                                        </a>
                                    @endif
                                </div>
                                <h3 class="mt-3 text-lg font-semibold text-slate-900 transition hover:text-slate-700 dark:text-white dark:hover:text-slate-200">
                                    <a href="{{ route('post.show', $story->slug) }}">{{ $story->title }}</a>
                                </h3>
                                <p class="mt-3 text-sm text-slate-500 line-clamp-3 dark:text-slate-300">
                                    {{ $story->excerpt ?? str($story->content)->stripTags()->limit(120) }}
                                </p>
                                <a href="{{ route('post.show', $story->slug) }}" class="mt-6 inline-flex w-fit items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900 dark:text-slate-300 dark:hover:text-white">
                                    Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="pt-4">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        </section>

        <aside class="space-y-8">
            <div class="rounded-3xl border border-slate-200/80 bg-white/90 p-6 shadow-sm dark:border-slate-800/80 dark:bg-slate-900/70">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Trending Sekarang</h3>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">Topik yang paling banyak dibaca hari ini.</p>
                <div class="mt-5 space-y-4">
                    @foreach($popular->take(5) as $index => $pp)
                        <a href="{{ route('post.show', $pp->slug) }}" class="group flex items-start gap-3">
                            <span class="flex size-8 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-600 transition group-hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200">{{ $index + 1 }}</span>
                            <span class="text-sm font-semibold leading-snug text-slate-700 transition group-hover:text-slate-900 dark:text-slate-200 dark:group-hover:text-white">{{ $pp->title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            @include('components.sidebar-latest', ['latest' => $latest])
<!-- 
            <div class="rounded-3xl border border-slate-200/80 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 p-6 text-white shadow-lg">
                <h3 class="text-lg font-semibold">Dapatkan ringkasan pagi</h3>
                <p class="mt-2 text-sm text-white/80">Kirimkan email berisi sorotan berita terpenting langsung ke inbox Anda.</p>
                <form class="mt-4 space-y-3">
                    <input type="email" class="w-full rounded-full border border-white/30 bg-white/10 px-4 py-2 text-sm placeholder:text-white/60 focus:border-white focus:outline-none" placeholder="nama@email.com">
                    <button type="button" class="w-full rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Berlangganan</button>
                </form>
            </div> -->
        </aside>
    </div>
@endif
@endsection
