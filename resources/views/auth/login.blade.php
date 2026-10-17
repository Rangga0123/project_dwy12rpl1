<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Book Stock SMKN5</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #101827;
            color: #fff;
        }

        /* BACKGROUND FOTO */
        .login-background {
            min-height: 100vh;
            min-height: 100svh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 16px;
            position: relative;
            isolation: isolate;
            overflow: hidden;

            background-color: #101827;
            background-image:
                linear-gradient(
                    120deg,
                    rgba(7, 18, 39, .76),
                    rgba(9, 25, 50, .55),
                    rgba(5, 14, 29, .78)
                ),
                url('/images/background-login.jpg');

            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* EFEK CAHAYA BIRU */
        .blue-light {
            position: absolute;
            z-index: -1;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(37, 99, 235, .22);
            filter: blur(85px);
            pointer-events: none;
            animation: lightFloat 7s ease-in-out infinite alternate;
        }

        .light-one {
            top: -130px;
            left: -100px;
        }

        .light-two {
            right: -100px;
            bottom: -130px;
            background: rgba(14, 165, 233, .16);
            animation-delay: 1.5s;
        }

        /* KARTU LOGIN */
        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 34px;
            border-radius: 15px;

            background: rgba(12, 22, 39, .91);
            border: 1px solid rgba(148, 181, 230, .24);
            box-shadow: 0 22px 65px rgba(0, 0, 0, .38);

            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            opacity: 0;
            animation: cardAppear .8s ease-out forwards;
        }

        .login-card:hover {
            border-color: rgba(96, 165, 250, .5);
            transition: border-color .3s ease;
        }

        /* LOGO */
        .school-logo {
            display: block;
            width: 76px;
            height: 76px;
            object-fit: contain;
            margin: 0 auto 17px;
            background: transparent;
            border: none;

            opacity: 0;
            animation: logoAppear .7s ease-out .25s forwards;
        }

        .brand-name {
            color: #93c5fd;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
        }

        .subtitle {
            color: #b8c5d8;
        }

        /* LABEL INPUT */
        .field-label {
            display: block;
            margin-bottom: 8px;
            color: #dce7f5;
            font-size: 12px;
            font-weight: 600;
        }

        /* INPUT */
        .input-field {
            display: block;
            width: 100%;
            padding: 12px 14px;
            color: #172033;
            background: #f1f5f9;
            border: 1px solid #dbe4ef;
            border-radius: 8px;
            outline: none;
            font-size: 14px;

            transition:
                border-color .25s ease,
                box-shadow .25s ease,
                background .25s ease;
        }

        .input-field::placeholder {
            color: #8793a5;
        }

        .input-field:focus {
            background: #fff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .18);
        }

        /* PASSWORD DAN IKON MATA */
        .password-wrapper {
            position: relative;
        }

        .password-input {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            color: #64748b;
            background: transparent;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: color .2s, transform .2s;
        }

        .password-toggle:hover {
            color: #2563eb;
            transform: translateY(-50%) scale(1.1);
        }

        .password-toggle:focus-visible {
            outline: 2px solid #3b82f6;
        }

        /* LINK */
        .text-link {
            color: #93c5fd;
            text-decoration: none;
            transition: color .2s ease;
        }

        .text-link:hover {
            color: #dbeafe;
            text-decoration: underline;
        }

        /* TOMBOL MASUK */
        .login-button {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 13px 16px;
            color: #fff;
            background: #2563eb;
            border: 1px solid #3b82f6;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;

            transition:
                background .25s ease,
                transform .25s ease,
                box-shadow .25s ease;
        }

        .login-button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 65%;
            height: 100%;
            background: linear-gradient(
                110deg,
                transparent,
                rgba(255, 255, 255, .23),
                transparent
            );
            transform: skewX(-20deg);
        }

        .login-button:hover::before {
            animation: buttonShine .7s ease;
        }

        .login-button:hover {
            background: #1d4ed8;
            box-shadow: 0 7px 22px rgba(37, 99, 235, .28);
            transform: translateY(-2px);
        }

        .login-button:active {
            transform: scale(.985);
        }

        /* TOMBOL DAFTAR */
        .register-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px 16px;
            color: #dbeafe;
            background: rgba(37, 99, 235, .08);
            border: 1px solid rgba(96, 165, 250, .45);
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;

            transition:
                background .25s ease,
                border-color .25s ease,
                transform .25s ease;
        }

        .register-button:hover {
            color: #fff;
            background: rgba(37, 99, 235, .2);
            border-color: #60a5fa;
            transform: translateY(-1px);
        }

        /* ERROR LOGIN */
        .error-box {
            padding: 12px 14px;
            margin-bottom: 20px;
            color: #fecaca;
            background: rgba(127, 29, 29, .25);
            border: 1px solid rgba(248, 113, 113, .35);
            border-radius: 8px;
            font-size: 13px;
        }

        /* ANIMASI MASUK */
        @keyframes cardAppear {
            0% {
                opacity: 0;
                transform: translateY(28px) scale(.98);
                filter: blur(4px);
            }

            70% {
                opacity: 1;
                filter: blur(0);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
                filter: blur(0);
            }
        }

        @keyframes logoAppear {
            from {
                opacity: 0;
                transform: translateY(-12px) scale(.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes lightFloat {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(35px, 25px) scale(1.15);
            }
        }

        @keyframes buttonShine {
            from { left: -120%; }
            to { left: 150%; }
        }

        /* HP */
        @media (max-width: 480px) {
            .login-background {
                padding: 20px 14px;
                background-attachment: scroll;
            }

            .login-card {
                padding: 27px 22px;
            }

            .school-logo {
                width: 68px;
                height: 68px;
            }
        }

        /* MENGURANGI ANIMASI JIKA DIMINTA PERANGKAT */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }

            .login-card,
            .school-logo {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

<div class="login-background">

    <div class="blue-light light-one"></div>
    <div class="blue-light light-two"></div>

    <main class="login-card">

        <!-- LOGO SEKOLAH -->
        <header class="text-center mb-7">

            <img
                src="{{ asset('images/logo-smkn5.png') }}"
                alt="Logo SMKN 5"
                class="school-logo"
            >

            <p class="brand-name mb-3">
                BOOK STOCK SMKN5
            </p>

            <h1 class="text-2xl font-bold tracking-wide">
                Selamat Datang
            </h1>

            <p class="subtitle text-sm mt-2">
                Sistem Restock Buku Perpustakaan
            </p>

            <p class="text-gray-400 text-sm mt-2">
                Silakan masuk ke akun Anda
            </p>

        </header>

        <!-- PESAN ERROR -->
        @if ($errors->any())
            <div class="error-box" role="alert">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="field-label">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Masukkan email Anda"
                    class="input-field"
                >
            </div>

            <div class="mb-5">
                <label for="password" class="field-label">
                    Password
                </label>

                <div class="password-wrapper">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password Anda"
                        class="input-field password-input"
                    >

                    <button
                        type="button"
                        id="togglePassword"
                        class="password-toggle"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                        title="Tampilkan password"
                    >
                        <svg
                            id="eyeIcon"
                            xmlns="http://www.w3.org/2000/svg"
                            width="21"
                            height="21"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- INGAT SAYA -->
            <div class="flex items-center justify-between gap-3 mb-7">

                <label class="flex items-center gap-2 text-sm text-gray-300 cursor-pointer">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="accent-blue-600"
                    >
                    Ingat saya
                </label>

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-link text-sm"
                    >
                        Lupa password?
                    </a>
                @endif

            </div>

            <!-- MASUK -->
            <button type="submit" class="login-button">
                <span class="relative z-10">
                    Masuk ke Akun &nbsp; →
                </span>
            </button>

            <!-- DAFTAR -->
            @if (Route::has('register'))
                <div class="mt-5">

                    <p class="text-center text-sm text-gray-400 mb-3">
                        Belum punya akun?
                    </p>

                    <a
                        href="{{ route('register') }}"
                        class="register-button"
                    >
                        Daftar Sekarang &nbsp; →
                    </a>

                </div>
            @endif

        </form>

        <!-- FOOTER -->
        <footer class="text-center mt-7 pt-5 border-t border-white/10">

            <p class="text-gray-500 text-xs mt-2">
                Sistem Restock Buku Perpustakaan
            </p>

        </footer>

    </main>

</div>

<!-- FUNGSI LIHAT PASSWORD -->
<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    const eyeOpen = `
        <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
        <circle cx="12" cy="12" r="3"/>
    `;

    const eyeClosed = `
        <path d="M3 3l18 18"/>
        <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
        <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a16 16 0 0 1-3.1 3.8"/>
        <path d="M6.6 6.6C3.7 8.5 2 12 2 12s3.6 7 10 7c1.1 0 2.1-.2 3-.5"/>
    `;

    togglePassword.addEventListener('click', function () {
        const showPassword = passwordInput.type === 'password';

        passwordInput.type = showPassword ? 'text' : 'password';
        eyeIcon.innerHTML = showPassword ? eyeClosed : eyeOpen;

        togglePassword.setAttribute(
            'aria-label',
            showPassword ? 'Sembunyikan password' : 'Tampilkan password'
        );

        togglePassword.setAttribute(
            'aria-pressed',
            String(showPassword)
        );

        togglePassword.title = showPassword
            ? 'Sembunyikan password'
            : 'Tampilkan password';
    });
</script>

</body>
</html>