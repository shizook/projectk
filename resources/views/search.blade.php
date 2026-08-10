@extends('layouts.app')
@section('title', 'Hasil Pencarian | Kompas Corner')
@section('meta_description', 'Cari berita berdasarkan judul, konten, atau kategori')

@section('content')
<div class="py-4">
    <!-- Judul & Filter Pencarian -->
    <h1 class="mb-2 text-2xl font-bold text-white">Hasil Pencarian</h1>
    
    <div class="mb-6 flex flex-wrap gap-4 text-sm text-slate-400">
        @if($q)
            <p>Keyword: <span class="font-semibold text-white">{{ $q }}</span></p>
        @endif
        @if($cat)
            <p>Kategori: <span class="font-semibold text-white">{{ $cat }}</span></p>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        <!-- Area Hasil Pencarian Utama -->
        <div class="space-y-4 md:col-span-2">
            @forelse($posts as $p)
                <article class="rounded-xl border border-white/10 bg-white/5 p-5 transition hover:border-white/20">
                    <a href="{{ route('post.show',$p->slug) }}" class="text-lg font-bold text-white transition hover:text-slate-300">
                        {{ $p->title }}
                    </a>
                    <div class="mt-1 text-xs text-slate-400">
                        {{ optional($p->published_at)->format('d M Y') }} · {{ $p->category?->name ?? '-' }}
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-slate-300">
                        {{ $p->excerpt }}
                    </p>
                </article>
            @empty
                <div class="rounded-xl border border-white/10 bg-white/5 p-6 text-center text-slate-400">
                    Tidak ada hasil pencarian ditemukan.
                </div>
            @endforelse

            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-6">
            <div class="rounded-xl border border-white/10 bg-white/5 p-5">
                <h3 class="mb-3 text-base font-bold text-white">Popular</h3>
                <div class="space-y-3 text-sm">
                    @foreach($popular as $pp)
                        <a class="block text-slate-300 transition hover:text-white" href="{{ route('post.show',$pp->slug) }}">
                            {{ $pp->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
              @include('components.sidebar-latest',['latest'=>$latest])
            </div>
        </aside>
    </div>
</div>
@endsection