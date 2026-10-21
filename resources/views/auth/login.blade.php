<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Book Stock SMKN 5</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #FFF7E6;
        }

        .login-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(90deg, rgba(65, 35, 10, .88), rgba(105, 55, 10, .58)),
                url('/images/background-login.jpg') center / cover no-repeat;
            color: white;
        }

        .hero-content {
            animation: slideLeft .9s ease both;
        }

        .login-card {
            animation: slideRight .9s ease both;
            box-shadow: 0 20px 60px rgba(120, 70, 0, .14);
        }

        .info-card {
            background: rgba(105, 55, 10, .72);
            border: 1px solid rgba(255, 193, 7, .45);
            backdrop-filter: blur(8px);
            transition: transform .25s ease, background .25s ease;
        }

        .info-card:hover {
            transform: translateY(-4px);
            background: rgba(130, 65, 8, .85);
        }

        
        /* KOTAK EMAIL DAN PASSWORD: ORANYE */
        .form-input {
            display: block;
            width: 100%;
            border: 2px solid #FF9100 !important;
            background: #FFF0D9 !important;
            color: #222222 !important;
            border-radius: 9px;
            padding: 13px 14px;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            -webkit-text-fill-color: #222222;
            opacity: 1 !important;
        }

        .form-input:focus {
            border-color: #FF9100 !important;
            background: #FFE0B2 !important;
            box-shadow: 0 0 0 3px rgb(255, 145, 0) !important;
        }

        .form-input::placeholder {
            color: #ff8400 !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #ff8400;
        }

        /* WARNA ORANYE JIKA EMAIL/PASSWORD TERSIMPAN DI CHROME */
        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus {
            -webkit-text-fill-color: #222222 !important;
            box-shadow: 0 0 0 1000px #FFF0D9 inset !important;
            border: 2px solid #FF9100 !important;
            transition: background-color 9999s ease-in-out 0s;
        }


        /* MENCEGAH WARNA AUTOFILL CHROME MENUTUPI KUNING */
        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus {
            -webkit-text-fill-color: #222222 !important;
            box-shadow: 0 0 0 1000px #FFEB3B inset !important;
            border: 2px solid #FFC107 !important;
            transition: background-color 9999s ease-in-out 0s;
        }

        .login-button {
            background: #FF9100;
            transition: transform .2s, background .2s, box-shadow .2s;
        }

        .login-button:hover {
            background: #E67E00;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 123, 0, .24);
        }

        .register-button {
            background: #FF9100 !important;
            border: 1px solid #FF9100 !important;
            color: #FFFFFF !important;
            transition: background .2s, transform .2s;
        }

        .register-button:hover {
            background: #E67E00 !important;
            transform: translateY(-1px);
        }

        .orange-text {
            color: #C65D00;
        }

        .orange-link {
            color: #C65D00;
            transition: color .2s;
        }

        .orange-link:hover {
            color: #8A3D00;
        }

        .remember-checkbox {
            accent-color: #FF9100;
        }

        @keyframes slideLeft {
            from {
                opacity: 0;
                transform: translateX(-28px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(28px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .page-enter {
            animation: fadeIn .7s ease both;
        }

        @media (max-width: 900px) {
            .login-hero {
                min-height: 430px;
            }

            .hero-content {
                padding: 36px 25px;
            }

            .login-card {
                margin: 24px;
            }
        }

        @media (max-width: 640px) {
            .login-hero {
                min-height: 390px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 30px;
            }

            .login-card {
                margin: 16px;
                padding: 25px !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body class="page-enter min-h-screen">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        <!-- BAGIAN KIRI: INFORMASI PERPUSTAKAAN -->
        <section class="login-hero min-h-screen flex items-center">
            <div class="hero-content relative z-10 w-full max-w-2xl mx-auto px-8 py-12 lg:px-16">

                <div class="flex items-center gap-3 mb-10">
                    <div class="w-14 h-14 rounded-xl bg-white flex items-center justify-center p-2 shadow-lg">
                        <img
                            src="{{ asset('images/logo-smkn5.png') }}"
                            alt="Logo SMKN 5"
                            class="w-full h-full object-contain"
                        >
                    </div>

                    <div>
                        <h2 class="font-bold text-lg">Book Stock SMKN 5</h2>
                        <p class="text-sm text-white/75">
                            Sistem Restock Buku Perpustakaan
                        </p>
                    </div>
                </div>

                <p class="text-xs uppercase tracking-[3px] font-bold text-amber-300 mb-4">
                    Sistem Informasi Perpustakaan
                </p>

                <h1 class="hero-title text-4xl lg:text-5xl font-bold leading-tight mb-5">
                    Kelola Stok Buku
                    <br>
                    Lebih Mudah dan Praktis
                </h1>

                <p class="text-sm leading-7 text-white/85 max-w-lg mb-8">
                    Sistem untuk membantu pengelolaan data buku, pemantauan stok,
                    dan pengajuan restock buku di perpustakaan SMKN 5 Kabupaten Tangerang.
                </p>

                <div class="info-grid grid grid-cols-1 sm:grid-cols-2 gap-3">

                    <div class="info-card rounded-xl p-4">
                        <p class="text-xs uppercase tracking-wider text-amber-300 font-bold mb-2">
                            Pemimpin Perpustakaan
                        </p>
                        <p class="font-bold text-sm">Panjalu Remasaki</p>
                        <p class="text-xs text-white/70 mt-1">
                            Perpustakaan SMKN 5
                        </p>
                    </div>

                    <div class="info-card rounded-xl p-4">
                        <p class="text-xs uppercase tracking-wider text-amber-300 font-bold mb-2">
                            Jam Buka
                        </p>
                        <p class="font-bold text-sm">Senin – Jumat</p>
                        <p class="text-xs text-white/70 mt-1">
                            08.00 – 16.00 WIB
                        </p>
                    </div>

                    <div class="info-card rounded-xl p-4 sm:col-span-2">
                        <p class="text-xs uppercase tracking-wider text-amber-300 font-bold mb-2">
                            Lokasi Perpustakaan
                        </p>
                        <p class="text-sm leading-6">
                            Jl. Insinyur Sutami, Jl. Raya Mauk No. Km. 1,2,
                            Mauk Barat, Kecamatan Mauk, Kabupaten Tangerang,
                            Banten 15330.
                        </p>
                    </div>

                </div>

                <div class="border-l-2 border-amber-400 pl-4 mt-7">
                    <p class="font-bold text-sm mb-1">Informasi</p>
                    <p class="text-xs leading-6 text-white/80">
                        Gunakan akun yang sudah terdaftar untuk masuk ke sistem
                        pengelolaan stok buku perpustakaan.
                    </p>
                </div>

                <p class="text-xs text-white/60 mt-8">
                    © {{ date('Y') }} Book Stock SMKN 5 Kabupaten Tangerang
                </p>

            </div>
        </section>

        <!-- BAGIAN KANAN: FORM LOGIN -->
        <section class="min-h-screen flex items-center justify-center px-4 py-10 lg:px-10 bg-gradient-to-br from-orange-50 via-white to-amber-100">

            <div class="login-card w-full max-w-md rounded-2xl bg-white/95 border border-amber-100 p-8 sm:p-10">

                <div class="mb-8">
                    <p class="text-xs font-bold tracking-[2px] uppercase orange-text mb-4">
                        Area Pengguna
                    </p>

                    <h2 class="text-3xl font-bold text-slate-900">
                        Selamat Datang
                    </h2>

                    <p class="text-sm text-slate-500 mt-3 leading-6">
                        Silakan masuk menggunakan akun yang sudah terdaftar.
                    </p>
                </div>

                <!-- PESAN STATUS -->
                @if (session('status'))
                    <div class="mb-5 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm p-3">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- PESAN ERROR -->
                @if ($errors->any())
                    <div class="mb-5 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm p-3">
                        <p class="font-bold mb-1">Login gagal</p>
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM LOGIN -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- EMAIL -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
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
                            placeholder="Masukkan email"
                            class="form-input"
                        >
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-bold text-slate-700">
                                Kata Sandi
                            </label>

                            @if (Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-xs font-semibold orange-link hover:underline"
                                >
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan kata sandi"
                                class="form-input pr-20"
                            >

                            <button
                                type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-3 text-sm font-semibold orange-text"
                            >
                                Lihat
                            </button>
                        </div>
                    </div>

                    <!-- INGAT SAYA -->
                    <div class="flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="remember-checkbox w-4 h-4 rounded border-gray-300"
                        >

                        <label for="remember_me" class="ml-2 text-sm text-slate-600">
                            Ingat saya
                        </label>
                    </div>

                    <!-- TOMBOL LOGIN -->
                    <button
                        type="submit"
                        class="login-button w-full rounded-lg py-3.5 text-white text-sm font-bold"
                    >
                        Masuk ke Akun
                        <span class="ml-2">→</span>
                    </button>

                </form>

                <!-- DAFTAR AKUN -->
                @if (Route::has('register'))
                    <div class="text-center mt-7">
                        <p class="text-sm text-slate-500 mb-3">
                            Belum punya akun?
                        </p>

                        <a
                            href="{{ route('register') }}"
                            class="register-button block w-full rounded-lg py-3 text-sm font-bold"
                        >
                            Daftar Sekarang
                            <span class="ml-2">→</span>
                        </a>
                    </div>
                @endif

                <p class="text-center text-xs text-slate-400 mt-7">
                    Sistem Informasi Restock Buku Perpustakaan
                </p>

            </div>
        </section>

    </div>

    <!-- FITUR LIHAT / SEMBUNYIKAN PASSWORD -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword?.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';
            togglePassword.textContent = isHidden ? 'Sembunyikan' : 'Lihat';
        });
    </script>

</body>
</html>