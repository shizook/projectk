@php
    $menus = $headerMenu ?? \App\Models\MenuItem::header()->get();
    $categories = \App\Models\Category::orderBy('name')->get();
    $menus = $menus instanceof \Illuminate\Support\Collection ? $menus : collect($menus);
    $hasAbout = $menus->contains(function ($item) {
        $url = trim($item->url ?? '', '/');
        return $url === 'about';
    });
    $user = auth()->user();
@endphp

<header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/75 backdrop-blur supports-[backdrop-filter]:bg-white/60 dark:border-slate-800/70 dark:bg-slate-900/70">
    <div class="mx-auto flex w-full max-w-7xl flex-wrap items-center gap-4 px-4 py-1 sm:px-6 lg:grid lg:grid-cols-[auto_1fr_auto] lg:items-center lg:gap-6 lg:px-8 lg:py-2">
        <div class="flex w-full items-start gap-3 lg:w-auto lg:items-center">
            <a href="/" class="flex items-center gap-3 text-slate-900 dark:text-white">
                <img src="{{ asset('logokc.jpg')}}" alt="" class="size-10">

                <div class="flex flex-col leading-tight">
                    <span class="text-lg font-semibold leading-none">Kompas Corner</span>
                    <span class="text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400 dark:text-slate-500">Jurnalisme Perspektif</span>
                </div>
            </a>
            <button type="button" class="inline-flex size-9 items-center justify-center rounded-full border border-slate-200 text-sm font-semibold uppercase tracking-[0.35em] text-slate-600 transition hover:border-slate-900 hover:text-slate-900 dark:border-white/10 dark:text-slate-300 dark:hover:border-white/40 dark:hover:text-white lg:hidden" @click="mobileOpen = !mobileOpen" aria-label="Menu">
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 6 12 12M6 18 18 6"/></svg>
            </button>
        </div>

        <nav class="order-3 hidden w-full items-center justify-center gap-6 text-sm font-semibold text-slate-600 lg:order-none lg:col-start-2 lg:col-end-3 lg:flex lg:justify-center dark:text-slate-300">
            @foreach($menus as $m)
                <a href="{{ $m->url }}" class="transition hover:text-slate-900 dark:hover:text-white">{{ $m->title }}</a>
            @endforeach
            @unless($hasAbout)
                <a href="{{ route('about') }}" class="transition hover:text-slate-900 dark:hover:text-white">About</a>
            @endunless
        </nav>

        <div class="order-4 flex w-full flex-col gap-3 lg:order-none lg:col-start-3 lg:flex-row lg:items-center lg:justify-end lg:gap-4">
            <form action="{{ route('search') }}" method="GET" class="flex w-full items-center gap-2 rounded-full border border-slate-200/80 bg-white px-4 py-2 text-sm shadow-sm transition focus-within:border-slate-900 md:w-auto dark:border-white/10 dark:bg-white/10">
                <svg class="size-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35M5.75 11a5.25 5.25 0 1 0 10.5 0 5.25 5.25 0 0 0-10.5 0Z"/></svg>
                <input name="q" value="{{ request('q') }}" placeholder="Cari berita" class="w-32 bg-transparent focus:outline-none md:w-40" />
                <select name="category" class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 focus:outline-none dark:bg-slate-800 dark:text-slate-200">
                    <option value="">Semua</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </form>

            <div class="flex w-full flex-wrap items-center justify-end gap-2 lg:w-auto lg:flex-nowrap">
                @auth
                    <div x-data="{ open: false }" class="relative flex w-full justify-end md:w-auto">
                        <button type="button" @click="open = !open" class="flex w-full items-center justify-center gap-2 rounded-full border border-slate-200/80 bg-white/80 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:bg-white/10 dark:text-slate-100 md:w-auto">
                            <span class="inline-flex size-6 items-center justify-center rounded-full bg-slate-900 text-[10px] font-semibold text-white dark:bg-white dark:text-slate-900">{{ str($user->name)->substr(0, 1) }}</span>
                            <span class="hidden sm:inline">{{ str($user->name)->words(2, '') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-500 transition dark:text-slate-300" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 9 6 6 6-6"/></svg>
                        </button>

                        <div x-cloak x-show="open" x-transition @click.outside="open = false" class="absolute right-0 top-full mt-3 w-72 space-y-4 rounded-3xl border border-slate-200/80 bg-white/95 p-4 shadow-xl dark:border-white/10 dark:bg-slate-900/95">
                            <div class="flex items-start gap-3">
                                <span class="inline-flex size-10 items-center justify-center rounded-full bg-slate-900 text-sm font-semibold uppercase tracking-[0.3em] text-white dark:bg-white dark:text-slate-900">{{ str($user->name)->substr(0, 1) }}</span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-300">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm">
                                <!-- <a href="{{ route('dashboard') }}" class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-2 font-semibold text-slate-600 transition hover:border-slate-900 hover:text-slate-900 dark:border-white/10 dark:text-slate-200 dark:hover:border-white/30 dark:hover:text-white">Pengaturan Akun<span class="text-xs text-slate-400">?</span></a> -->
                                @if($user->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-2 font-semibold text-slate-600 transition hover:border-slate-900 hover:text-slate-900 dark:border-white/10 dark:text-slate-200 dark:hover:border-white/30 dark:hover:text-white">Dashboard Admin<span class="text-xs text-slate-400">?</span></a>
                                @elseif($user->isAuthor())
                                    <a href="{{ route('posts.index') }}" class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-2 font-semibold text-slate-600 transition hover:border-slate-900 hover:text-slate-900 dark:border-white/10 dark:text-slate-200 dark:hover:border-white/30 dark:hover:text-white">Dashboard Author<span class="text-xs text-slate-400">?</span></a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="flex w-full items-center justify-between rounded-2xl border border-red-200 px-4 py-2 font-semibold text-red-600 transition hover:border-red-400 hover:text-red-700 dark:border-red-500/30 dark:text-red-300">Keluar<span class="text-xs">?</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="flex w-full items-center justify-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white md:w-auto dark:border-white/10 dark:text-slate-200">Masuk / Daftar</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="lg:hidden" x-show="mobileOpen" x-transition x-cloak>
        <div class="space-y-6 border-t border-slate-200 bg-white px-4 pb-8 pt-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <form action="{{ route('search') }}" method="GET" class="space-y-3">
                <label class="flex items-center gap-2 rounded-2xl border border-slate-200 bg-white/70 px-4 py-3 dark:border-white/10 dark:bg-white/10">
                    <svg class="size-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35M5.75 11a5.25 5.25 0 1 0 10.5 0 5.25 5.25 0 0 0-10.5 0Z"/></svg>
                    <input name="q" value="{{ request('q') }}" class="w-full bg-transparent focus:outline-none" placeholder="Cari berita" />
                </label>
                <select name="category" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-white/10 dark:bg-white/10 dark:text-slate-200">
                    <option value="">Semua kategori</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </form>

            <div class="space-y-4">
                <p class="section-label text-left">Menu utama</p>
                <div class="grid gap-3">
                    @foreach($menus as $m)
                        <a href="{{ $m->url }}" class="rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:text-slate-200">{{ $m->title }}</a>
                    @endforeach
                    @unless($hasAbout)
                        <a href="{{ route('about') }}" class="rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:text-slate-200">About</a>
                    @endunless
                </div>
            </div>

            <div class="space-y-3">
                <p class="section-label text-left">Rubrik</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $c)
                        <a href="{{ route('category.show', $c->slug) }}" class="pill">{{ $c->name }}</a>
                    @endforeach
                </div>
            </div>

            @auth
                <div class="space-y-4 rounded-3xl border border-slate-200 px-4 py-4 dark:border-white/10">
                    <div class="flex items-center gap-3 text-sm font-semibold text-slate-700 dark:text-slate-200">
                        <span class="inline-flex size-9 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold uppercase tracking-[0.35em] text-white dark:bg-white dark:text-slate-900">{{ str(auth()->user()->name)->substr(0, 1) }}</span>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    <a href="{{ route('dashboard') }}" class="block rounded-2xl border border-slate-200 px-4 py-2 text-center text-sm font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:text-slate-200">Pengaturan Akun</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl border border-slate-200 px-4 py-2 text-center text-sm font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:text-slate-200">Dashboard Admin</a>
                    @elseif(auth()->user()->isAuthor())
                        <a href="{{ route('posts.index') }}" class="block rounded-2xl border border-slate-200 px-4 py-2 text-center text-sm font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:text-slate-200">Dashboard Author</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full rounded-2xl border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 transition hover:border-red-400 hover:text-red-700 dark:border-red-500/30 dark:text-red-300">Keluar</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="flex w-full items-center justify-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:border-slate-900 dark:hover:border-white/40 hover:text-slate-900 dark:hover:text-white dark:border-white/10 dark:text-slate-200">Masuk / Daftar</a>
            @endauth
        </div>
    </div>
</header>










