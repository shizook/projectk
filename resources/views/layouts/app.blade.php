<!DOCTYPE html>
<html lang="id" x-data="{ mobileOpen: false }" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Kompas Corner')</title>
    <meta name="description" content="@yield('meta_description', 'Kompas Corner - Portal berita modern')">

    <link rel="stylesheet" href="{{ asset('build/assets/app-YLZY0FG4.css') }}">
    <script src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js" defer></script>
    <script src="{{ asset('build/assets/app-Bj43h_rG.js') }}" defer></script>

    <style>
        /* Pastikan input text terlihat di dark mode */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        textarea,
        select {
            color: #fff !important;
            background-color: #1e293b !important;
            border-color: #475569 !important;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        textarea::placeholder {
            color: #94a3b8 !important;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus,
        select:focus {
            background-color: #0f172a !important;
            border-color: #64748b !important;
            color: #fff !important;
            outline: none;
        }

        /* Override untuk textarea / contenteditable / editor biasa */
        textarea,
        input[type="text"],
        input[type="email"],
        [contenteditable="true"],
        .editor,
        .prose,
        .ql-editor,
        .ck-content {
            color: #ffffff !important;
            background-color: #0b1220 !important;
        }

        /* placeholder */
        textarea::placeholder,
        input::placeholder {
            color: #cbd5e1 !important;
        }

        /* toolbar container jika perlu (agar kontras tetap baik) */
        .editor-toolbar,
        .tox-toolbar,
        .ck-toolbar,
        .ql-toolbar {
            background: rgba(10, 15, 25, 0.6) !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="min-h-screen dark:bg-slate-950">
    <div class="absolute inset-x-0 top-0 -z-10 h-[420px] hidden bg-transparent dark:block dark:bg-gradient-to-b dark:from-slate-900/80 dark:via-slate-900/40 dark:to-transparent"></div>

    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-lg">Loncat ke konten</a>

    <div class="relative flex min-h-screen flex-col">
        @include('components.navbar')

        <main id="main" class="flex-1 pb-20 pt-10">
            <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        @include('components.footer')
    </div>

    @stack('scripts')
</body>
</html>
