<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun - Book Stock SMKN5</title>
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

        .register-background {
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

        .blue-light {
            position: absolute;
            z-index: -1;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(37, 99, 235, .2);
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

        .register-card {
            width: 100%;
            max-width: 440px;
            padding: 32px;
            border-radius: 15px;
            background: rgba(12, 22, 39, .92);
            border: 1px solid rgba(148, 181, 230, .24);
            box-shadow: 0 22px 65px rgba(0, 0, 0, .38);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            opacity: 0;
            animation: cardAppear .7s ease-out forwards;
        }

        .school-logo {
            display: block;
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin: 0 auto 15px;
            animation: logoAppear .7s ease-out .2s both;
        }

        .brand-name {
            color: #93c5fd;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
        }

        .field-label {
            display: block;
            margin-bottom: 7px;
            color: #dce7f5;
            font-size: 12px;
            font-weight: 600;
        }

        .input-field {
            display: block;
            width: 100%;
            padding: 11px 13px;
            color: #172033;
            background: #f1f5f9;
            border: 1px solid #dbe4ef;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-field::placeholder {
            color: #8793a5;
        }

        .input-field:focus {
            background: #fff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .16);
        }

        .register-button {
            width: 100%;
            padding: 13px;
            color: white;
            background: #2563eb;
            border: 1px solid #3b82f6;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .25s, transform .25s, box-shadow .25s;
        }

        .register-button:hover {
            background: #1d4ed8;
            box-shadow: 0 7px 22px rgba(37, 99, 235, .28);
            transform: translateY(-2px);
        }

        .register-button:active {
            transform: scale(.985);
        }

        .text-link {
            color: #93c5fd;
            text-decoration: none;
            transition: color .2s;
        }

        .text-link:hover {
            color: #dbeafe;
            text-decoration: underline;
        }

        .error-box {
            padding: 12px 14px;
            margin-bottom: 18px;
            color: #fecaca;
            background: rgba(127, 29, 29, .25);
            border: 1px solid rgba(248, 113, 113, .35);
            border-radius: 8px;
            font-size: 13px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-input {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            display: flex;
            padding: 4px;
            color: #64748b;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: #2563eb;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(24px);
                filter: blur(3px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        @keyframes logoAppear {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lightFloat {
            from {
                transform: translate(0, 0);
            }
            to {
                transform: translate(30px, 25px);
            }
        }

        @media (max-width: 480px) {
            .register-background {
                padding: 18px 13px;
                background-attachment: scroll;
            }

            .register-card {
                padding: 25px 21px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }

            .register-card {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

<div class="register-background">

    <div class="blue-light light-one"></div>
    <div class="blue-light light-two"></div>

    <main class="register-card">

        <header class="text-center mb-6">

            <img
                src="{{ asset('images/logo-smkn5.png') }}"
                alt="Logo SMKN 5"
                class="school-logo"
            >

            <p class="brand-name mb-3">BOOK STOCK SMKN5</p>

            <h1 class="text-2xl font-bold">
                Buat Akun
            </h1>

            <p class="text-gray-300 text-sm mt-2">
                Daftarkan akun untuk menggunakan aplikasi
            </p>

        </header>

        @if ($errors->any())
            <div class="error-box" role="alert">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="field-label">
                    Nama Lengkap
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama lengkap"
                    class="input-field"
                >
            </div>

            <div class="mb-4">
                <label for="email" class="field-label">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="Masukkan email"
                    class="input-field"
                >
            </div>

            <div class="mb-4">
                <label for="password" class="field-label">
                    Password
                </label>

                <div class="password-wrapper">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Buat password"
                        class="input-field password-input"
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        data-password-toggle="password"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                    >
                        <svg
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

            <div class="mb-6">
                <label for="password_confirmation" class="field-label">
                    Konfirmasi Password
                </label>

                <div class="password-wrapper">
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi password"
                        class="input-field password-input"
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        data-password-toggle="password_confirmation"
                        aria-label="Tampilkan password"
                        aria-pressed="false"
                    >
                        <svg
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

            <button type="submit" class="register-button">
                Buat Akun
            </button>

            <p class="text-center text-sm text-gray-400 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                   class="text-link font-semibold ml-1">
                    Masuk di sini
                </a>
            </p>

        </form>

        <footer class="text-center mt-6 pt-4 border-t border-white/10">
            <p class="text-gray-400 text-xs">
            </p>
        </footer>

    </main>

</div>

<script>
    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(
                button.getAttribute('data-password-toggle')
            );

            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';

            button.setAttribute(
                'aria-label',
                show ? 'Sembunyikan password' : 'Tampilkan password'
            );

            button.setAttribute('aria-pressed', String(show));

            button.innerHTML = show
                ? `<svg width="21" height="21" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                     <path d="M3 3l18 18"/>
                     <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                     <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.4 0 10 7 10 7a16 16 0 0 1-3.1 3.8"/>
                     <path d="M6.6 6.6C3.7 8.5 2 12 2 12s3.6 7 10 7c1.1 0 2.1-.2 3-.5"/>
                   </svg>`
                : `<svg width="21" height="21" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                     <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/>
                     <circle cx="12" cy="12" r="3"/>
                   </svg>`;
        });
    });
</script>

</body>
</html>