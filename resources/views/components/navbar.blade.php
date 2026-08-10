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

<header class="relative z-50 border-b border-white/10 bg-[#03081a]/75 backdrop-blur-md">
    <div class="mx-auto flex w-full max-w-7xl flex-wrap items-center gap-4 px-4 py-1 sm:px-6 lg:grid lg:grid-cols-[auto_1fr_auto] lg:items-center lg:gap-6 lg:px-8 lg:py-2">
        
        
        <div class="flex w-full items-start gap-3 lg:w-auto lg:items-center">
            <a href="/" class="flex items-center gap-3 text-white">
                <img src="{{asset('logokc.jpg')}}" alt="Logo" class="size-10 rounded-full">

                <div class="flex flex-col leading-tight">
                    <span class="text-lg font-semibold leading-none text-white">Kompas Corner</span>
                    <span class="text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400 whitespace-nowrap">Jurnalisme Perspektif</span>
                </div>
            </a>

            <button type="button" class="inline-flex size-9 items-center justify-center rounded-full border border-white/10 text-sm font-semibold text-slate-300 transition hover:border-white/40 hover:text-white lg:hidden" @click="mobileOpen = !mobileOpen" aria-label="Menu">
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 6 12 12M6 18 18 6"/></svg>
            </button>
        </div>


        <nav class="order-3 hidden w-full items-center justify-center gap-6 text-sm font-semibold text-slate-300 lg:order-none lg:col-start-2 lg:col-end-3 lg:flex lg:justify-center">
            @foreach($menus as $m)
                <a href="{{ $m->url }}" class="transition hover:text-white">{{ $m->title }}</a>
            @endforeach
            @unless($hasAbout)
                <a href="{{ route('about') }}" class="transition hover:text-white">About</a>
            @endunless
        </nav>


        <div class="order-4 flex w-full flex-col gap-3 lg:order-none lg:col-start-3 lg:flex-row lg:items-center lg:justify-end lg:gap-4">
            
       
            <form action="{{ route('search') }}" method="GET" class="flex w-full items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm shadow-sm transition focus-within:border-white/30 md:w-auto">
                <svg class="size-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35M5.75 11a5.25 5.25 0 1 0 10.5 0 5.25 5.25 0 0 0-10.5 0Z"/></svg>
                <input name="q" value="{{ request('q') }}" placeholder="Cari berita" class="w-32 bg-transparent text-white placeholder-slate-400 focus:outline-none md:w-40" />
                <select name="category" class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-slate-200 focus:outline-none border-none">
                    <option value="" class="bg-[#03081a] text-slate-200">Semua</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->slug }}" @selected(request('category') === $c->slug) class="bg-[#03081a] text-slate-200">{{ $c->name }}</option>
                    @endforeach
                </select>
            </form>

      
            <div class="flex w-full flex-wrap items-center justify-end gap-2 lg:w-auto lg:flex-nowrap">
                @auth
                    <div x-data="{ open: false }" class="relative flex w-full justify-end md:w-auto">
                        <button type="button" @click="open = !open" class="flex w-full items-center justify-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:border-white/30 hover:text-white md:w-auto">
                            <span class="inline-flex size-6 items-center justify-center rounded-full bg-white text-[10px] font-semibold text-[#03081a]">{{ str($user->name)->substr(0, 1) }}</span>
                            <span class="hidden sm:inline">{{ str($user->name)->words(2, '') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-slate-400 transition" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 9 6 6 6-6"/></svg>
                        </button>

                 
                        <div x-cloak x-show="open" x-transition @click.outside="open = false" class="absolute right-0 top-full mt-3 w-72 space-y-4 rounded-3xl border border-white/10 bg-[#03081a] p-4 shadow-2xl">
                            <div class="flex items-start gap-3">
                                <span class="inline-flex size-10 items-center justify-center rounded-full bg-white text-sm font-semibold uppercase tracking-[0.3em] text-[#03081a]">{{ str($user->name)->substr(0, 1) }}</span>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm">
                                @if($user->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between rounded-2xl border border-white/10 px-4 py-2 font-semibold text-slate-300 transition hover:border-white/30 hover:text-white">Dashboard Admin</a>
                                @elseif($user->isAuthor())
                                    <a href="{{ route('posts.index') }}" class="flex items-center justify-between rounded-2xl border border-white/10 px-4 py-2 font-semibold text-slate-300 transition hover:border-white/30 hover:text-white">Dashboard Author</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="flex w-full items-center justify-between rounded-2xl border border-red-500/30 px-4 py-2 font-semibold text-red-400 transition hover:border-red-500 hover:text-red-300">Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="flex w-full items-center justify-center rounded-2xl border border-white/10 px-4 py-2.5 text-sm font-semibold text-slate-200 transition hover:border-white/40 hover:text-white md:w-auto">Masuk / Daftar</a>
                @endauth
            </div>
        </div>
    </div>


    <div class="lg:hidden" x-show="mobileOpen" x-transition x-cloak>
        <div class="space-y-6 border-t border-white/10 bg-[#03081a] px-4 pb-8 pt-6 shadow-xl">
            <form action="{{ route('search') }}" method="GET" class="space-y-3">
                <label class="flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                    <svg class="size-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35M5.75 11a5.25 5.25 0 1 0 10.5 0 5.25 5.25 0 0 0-10.5 0Z"/></svg>
                    <input name="q" value="{{ request('q') }}" class="w-full bg-transparent text-white placeholder-slate-400 focus:outline-none" placeholder="Cari berita" />
                </label>
                <select name="category" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-200 focus:outline-none">
                    <option value="" class="bg-[#03081a]">Semua kategori</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->slug }}" @selected(request('category') === $c->slug) class="bg-[#03081a]">{{ $c->name }}</option>
                    @endforeach
                </select>
            </form>

            <div class="space-y-4">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Menu utama</p>
                <div class="grid gap-3">
                    @foreach($menus as $m)
                        <a href="{{ $m->url }}" class="rounded-2xl border border-white/10 px-4 py-3 text-sm font-semibold text-slate-300 transition hover:border-white/30 hover:text-white">{{ $m->title }}</a>
                    @endforeach
                    @unless($hasAbout)
                        <a href="{{ route('about') }}" class="rounded-2xl border border-white/10 px-4 py-3 text-sm font-semibold text-slate-300 transition hover:border-white/30 hover:text-white">About</a>
                    @endunless
                </div>
            </div>

            <div class="space-y-3">
                <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Rubrik</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $c)
                        <a href="{{ route('category.show', $c->slug) }}" class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-300 transition hover:border-white/30 hover:text-white">{{ $c->name }}</a>
                    @endforeach
                </div>
            </div>

            @auth
                <div class="space-y-4 rounded-3xl border border-white/10 px-4 py-4">
                    <div class="flex items-center gap-3 text-sm font-semibold text-slate-200">
                        <span class="inline-flex size-9 items-center justify-center rounded-full bg-white text-xs font-semibold uppercase tracking-[0.35em] text-[#03081a]">{{ str(auth()->user()->name)->substr(0, 1) }}</span>
                        <span>{{ auth()->user()->name }}</span>
                    </div>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl border border-white/10 px-4 py-2 text-center text-sm font-semibold text-slate-300 transition hover:border-white/30 hover:text-white">Dashboard Admin</a>
                    @elseif(auth()->user()->isAuthor())
                        <a href="{{ route('posts.index') }}" class="block rounded-2xl border border-white/10 px-4 py-2 text-center text-sm font-semibold text-slate-300 transition hover:border-white/30 hover:text-white">Dashboard Author</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full rounded-2xl border border-red-500/30 px-4 py-2 text-sm font-semibold text-red-400 transition hover:border-red-500 hover:text-red-300">Keluar</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="flex w-full items-center justify-center rounded-2xl border border-white/10 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:border-white/30 hover:text-white">Masuk / Daftar</a>
            @endauth
        </div>
    </div>
</header>