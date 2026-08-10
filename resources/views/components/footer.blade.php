<footer class="border-t border-slate-800 bg-[#03081a] py-12 text-sm text-slate-300">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="space-y-4">
            <a href="/" class="flex items-center gap-2 text-lg font-bold text-white">
                Kompas Corner
            </a>
            <p class="text-sm leading-relaxed text-slate-400">
                Menyajikan berita pilihan dengan sudut pandang jernih, membantu Anda memahami apa yang paling penting setiap hari.
            </p>
        </div>

        <div>
            <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Redaksi</h4>
            <ul class="mt-4 space-y-2">
                <li><a href="{{asset('about')}}" class="hover:text-white">Tentang Kami</a></li>
                <li><a href="https://www.kompas.id/pedoman-media-siber" target="_blank" class="hover:text-white">Pedoman Media Siber</a></li>
                <li><a href="#" class="hover:text-white">Hubungi</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Layanan</h4>
            <ul class="mt-4 space-y-2">
                <li><a href="#" class="hover:text-white">Newsletter</a></li>
                <li><a href="#" class="hover:text-white">Iklan &amp; Kemitraan</a></li>
                <li><a href="#" class="hover:text-white">FAQ</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Ikuti Kami</h4>
            <div class="mt-4 flex gap-3">
                <a href="https://x.com/kompascorner" target="_blank" class="inline-flex size-9 items-center justify-center rounded-full border border-slate-700 text-slate-300 transition hover:border-white hover:text-white">X</a>
                <a href="https://www.instagram.com/kompascorner/" target="_blank" class="inline-flex size-9 items-center justify-center rounded-full border border-slate-700 text-slate-300 transition hover:border-white hover:text-white">IG</a>
                <a href="https://www.youtube.com/@KompasCorner" target="_blank" class="inline-flex size-9 items-center justify-center rounded-full border border-slate-700 text-slate-300 transition hover:border-white hover:text-white">YT</a>
            </div>
        </div>
    </div>

    <div class="mt-10 border-t border-slate-800/60 pt-6 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} Kompas Corner. All rights reserved.
    </div>
</footer>