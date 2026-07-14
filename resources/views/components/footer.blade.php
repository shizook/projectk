<footer class="border-t border-slate-200 bg-white/90 py-12 text-sm text-slate-500 dark:border-slate-800 dark:bg-slate-950/80 dark:text-slate-400">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="space-y-4">
            <a href="/" class="flex items-center gap-2 text-lg font-bold text-slate-900 dark:text-white">
                <!-- @if(!empty($siteLogo))
                    <img src="{{ $siteLogo }}" alt="Kompas Corner" class="h-10 w-auto object-contain" />
                @else
                    <span class="inline-flex size-8 items-center justify-center rounded-full bg-slate-900 text-white dark:bg-white dark:text-slate-900">KC</span>
                @endif -->
                Kompas Corner
            </a>
            <p class="text-sm leading-relaxed">
                Menyajikan berita pilihan dengan sudut pandang jernih, membantu Anda memahami apa yang paling penting setiap hari.
            </p>
        </div>

        <div>
            <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Redaksi</h4>
            <ul class="mt-4 space-y-2">
                <li><a href="#" class="hover:text-slate-900 dark:hover:text-white">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-slate-900 dark:hover:text-white">Pedoman Media Siber</a></li>
                <li><a href="#" class="hover:text-slate-900 dark:hover:text-white">Hubungi</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Layanan</h4>
            <ul class="mt-4 space-y-2">
                <li><a href="#" class="hover:text-slate-900 dark:hover:text-white">Newsletter</a></li>
                <li><a href="#" class="hover:text-slate-900 dark:hover:text-white">Iklan &amp; Kemitraan</a></li>
                <li><a href="#" class="hover:text-slate-900 dark:hover:text-white">FAQ</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Ikuti Kami</h4>
            <div class="mt-4 flex gap-3">
                <a href="#" class="inline-flex size-9 items-center justify-center rounded-full border border-slate-300 transition hover:border-slate-900 hover:text-slate-900 dark:border-slate-600 dark:text-slate-300 dark:hover:border-white dark:hover:text-white">X</a>
                <a href="#" class="inline-flex size-9 items-center justify-center rounded-full border border-slate-300 transition hover:border-slate-900 hover:text-slate-900 dark:border-slate-600 dark:text-slate-300 dark:hover:border-white dark:hover:text-white">IG</a>
                <a href="#" class="inline-flex size-9 items-center justify-center rounded-full border border-slate-300 transition hover:border-slate-900 hover:text-slate-900 dark:border-slate-600 dark:text-slate-300 dark:hover:border-white dark:hover:text-white">YT</a>
            </div>
        </div>
    </div>

    <div class="mt-10 border-t border-slate-200/60 pt-6 text-center text-xs text-slate-400 dark:border-slate-800/60 dark:text-slate-500">
        &copy; {{ date('Y') }} Kompas Corner. All rights reserved.
    </div>
</footer>
