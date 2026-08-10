<!DOCTYPE html>

<html lang="id" x-data="{ mobileOpen: false }" class="dark">
<head>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Kompas Corner') - Portal Berita Terkini</title>
    <meta name="description" content="@yield('meta_description', 'Kompas Corner adalah portal berita pilihan yang menyajikan informasi terkini dengan sudut pandang jernih.')">
    <meta name="robots" content="index, follow">

    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Kompas Corner')">
    <meta property="og:description" content="@yield('meta_description', 'Kompas Corner - Portal berita modern.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Kompas Corner">

    
    <link rel="canonical" href="{{ url()->current() }}">
    
    <link rel="stylesheet" href="{{ asset('build/assets/app-U1EFl2Q4.css') }}">
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-password').forEach(function (button) {
            button.addEventListener('click', function () {
                const wrapper = button.closest('.relative');
                const input = wrapper.querySelector('.password-input');
                const icon = wrapper.querySelector('.eye-icon');
                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';

                icon.innerHTML = isPassword
                    ? `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.774 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />`
                    : `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
            });
        });
    });
</script>
</body>
</html>
