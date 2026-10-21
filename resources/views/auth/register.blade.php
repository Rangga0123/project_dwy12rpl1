<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Book Stock SMKN 5</title>

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

        .page-enter {
            animation: fadeIn .7s ease both;
        }

        .hero-content {
            animation: slideLeft .9s ease both;
        }

        .register-card {
            animation: slideRight .9s ease both;
            box-shadow: 0 20px 60px rgba(120, 70, 0, .14);
        }

        /* PANEL KIRI */
        .login-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(
                    90deg,
                    rgba(65, 35, 10, .88),
                    rgba(105, 55, 10, .58)
                ),
                url('{{ asset("images/background-login.jpg") }}') center / cover no-repeat;
            color: white;
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

        /* PANEL REGISTER */
        .register-card {
            border: 1px solid #FDE7C3;
            border-radius: 16px;
        }

        /* INPUT KUNING: SAMAKAN DENGAN LOGIN */
        .form-input {
            display: block;
            width: 100%;
            min-height: 47px;
            border: 1px solid #FFB900 !important;
            background: #FFEB3B !important;
            color: #222222 !important;
            border-radius: 9px;
            padding: 12px 14px;
            outline: none;
            font-size: 13px;
            -webkit-text-fill-color: #222222;
            opacity: 1 !important;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-input:focus {
            border-color: #FFB300 !important;
            background: #FFEB3B !important;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, .25) !important;
        }

        .form-input::placeholder {
            color: #805B00 !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #805B00;
        }

        /* WARNA INPUT SAAT AUTOFILL CHROME */
        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover,
        .form-input:-webkit-autofill:focus,
        .form-input:-webkit-autofill:active {
            -webkit-text-fill-color: #222222 !important;
            box-shadow: 0 0 0 1000px #FFEB3B inset !important;
            border: 1px solid #FFB900 !important;
            transition: background-color 9999s ease-in-out 0s;
        }

        /* WARNA TOMBOL DAN LINK */
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

        .register-button {
            background: #FF9100 !important;
            border: 1px solid #FF9100 !important;
            color: #FFFFFF !important;
            transition: background .2s, transform .2s, box-shadow .2s;
        }

        .register-button:hover {
            background: #E67E00 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 123, 0, .24);
        }

        /* ERROR LARAVEL */
        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .error-box {
            padding: 12px;
            margin-bottom: 18px;
            color: #b91c1c;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            font-size: 12px;
        }

        /* ANIMASI */
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
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .login-hero {
                min-height: 430px;
            }

            .hero-content {
                padding: 36px 25px;
            }

            .register-card {
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

            .register-card {
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

    <!-- PANEL KIRI -->
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
                    Buat akun Book Stock SMKN 5 untuk mengakses informasi
                    buku dan mengajukan penambahan stok buku perpustakaan.
                </p>
            </div>

            <p class="text-xs text-white/60 mt-8">
                © {{ date('Y') }} Book Stock SMKN 5 Kabupaten Tangerang
            </p>

        </div>
    </section>

    <!-- PANEL KANAN: REGISTER -->
    <section class="min-h-screen flex items-center justify-center px-4 py-10 lg:px-10 bg-gradient-to-br from-orange-50 via-white to-amber-100">

        <div class="register-card w-full max-w-md rounded-2xl bg-white/95 p-8 sm:p-10">

            <div class="mb-7">
                <p class="text-xs font-bold tracking-[2px] uppercase orange-text mb-4">
                    Pendaftaran Akun
                </p>

                <h2 class="text-3xl font-bold text-slate-900">
                    Buat Akun Baru
                </h2>

                <p class="text-sm text-slate-500 mt-3 leading-6">
                    Daftarkan akun untuk mulai menggunakan Book Stock SMKN 5.
                </p>
            </div>

            @if ($errors->any())
                <div class="error-box" role="alert">
                    <p class="font-bold mb-2">
                        Pendaftaran belum berhasil:
                    </p>

                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- NAMA LENGKAP -->
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
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
                        class="form-input"
                    >

                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

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
                        autocomplete="username"
                        placeholder="nama@gmail.com"
                        class="form-input"
                    >

                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- KATA SANDI -->
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">
                        Kata Sandi
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Masukkan kata sandi"
                        class="form-input"
                    >

                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- KONFIRMASI KATA SANDI -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">
                        Konfirmasi Kata Sandi
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi kata sandi"
                        class="form-input"
                    >
                </div>

                <button
                    type="submit"
                    class="register-button w-full rounded-lg py-3.5 text-sm font-bold"
                >
                    Daftar Sekarang
                    <span class="ml-2">→</span>
                </button>
            </form>

            <div class="text-center mt-7">
                <p class="text-sm text-slate-500 mb-3">
                    Sudah punya akun?
                </p>

                <a
                    href="{{ route('login') }}"
                    class="orange-link text-sm font-bold hover:underline"
                >
                    Masuk di sini
                </a>
            </div>

            <p class="text-center text-xs text-slate-400 mt-7">
                Sistem Informasi Restock Buku Perpustakaan
            </p>

        </div>
    </section>

</div>

</body>
</html>