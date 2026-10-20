<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Book Stock SMKN 5</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #172b4d;
            background: #eaf1fb;
        }

        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr .9fr;
        }

        /* BACKGROUND FOTO PERPUSTAKAAN */
        .left-panel {
            position: relative;
            min-height: 100vh;
            padding: 45px 9%;
            display: flex;
            align-items: center;
            overflow: hidden;
            color: white;
            background-color: #10213d;
            background-image:
                linear-gradient(
                    110deg,
                    rgba(8, 20, 42, .78),
                    rgba(8, 20, 42, .42)
                ),
                url('{{ asset("images/background-login.jpg") }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .left-content {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 620px;
            animation: slideLeft .8s ease both;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 40px;
        }

        .brand-logo {
            width: 55px;
            height: 55px;
            padding: 5px;
            object-fit: contain;
            background: white;
            border-radius: 10px;
        }

        .eyebrow {
            color: #bfdbfe;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .main-heading {
            font-size: clamp(30px, 3.4vw, 45px);
            font-weight: 800;
            line-height: 1.15;
            margin: 15px 0;
        }

        .description {
            max-width: 470px;
            font-size: 14px;
            line-height: 1.8;
            color: #e2e8f0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 28px;
        }

        .info-card {
            padding: 16px;
            border: 1px solid rgba(255,255,255,.23);
            background: rgba(15, 23, 42, .58);
            border-radius: 10px;
            backdrop-filter: blur(7px);
            transition: transform .25s ease, background .25s ease;
        }

        .info-card:hover {
            transform: translateY(-4px);
            background: rgba(30, 58, 95, .8);
        }

        .info-title {
            color: #bfdbfe;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 13px;
            font-weight: bold;
            line-height: 1.6;
        }

        .info-detail {
            font-size: 11px;
            line-height: 1.7;
            color: #e2e8f0;
            margin-top: 5px;
        }

        .left-footer {
            margin-top: 24px;
            font-size: 11px;
            color: #cbd5e1;
        }

        .right-panel {
            min-height: 100vh;
            padding: 35px 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, #f8fbff, #e7f0ff);
        }

        .register-card {
            width: 100%;
            max-width: 430px;
            padding: 35px;
            background: rgba(255,255,255,.96);
            border: 1px solid white;
            border-radius: 18px;
            box-shadow: 0 20px 55px rgba(31, 67, 112, .14);
            animation: slideUp .7s ease both;
        }

        .form-eyebrow {
            color: #64748b;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .form-heading {
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-top: 10px;
        }

        .form-description {
            font-size: 12px;
            line-height: 1.7;
            color: #64748b;
            margin-top: 7px;
            margin-bottom: 25px;
        }

        .field { margin-bottom: 17px; }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            color: #334155;
            margin-bottom: 8px;
        }

        .field input {
            width: 100%;
            min-height: 45px;
            padding: 12px 13px;
            border: 1px solid #d5dfed;
            border-radius: 8px;
            background: #f8fbff;
            color: #172b4d;
            font-size: 13px;
            outline: none;
            transition: border .2s, box-shadow .2s, background .2s;
        }

        .field input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .13);
        }

        .field input::placeholder { color: #94a3b8; }

        .error {
            color: #dc2626;
            font-size: 11px;
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

        .register-button {
            width: 100%;
            min-height: 46px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(100deg, #2563eb, #1d4ed8);
            color: white;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 7px 15px rgba(37, 99, 235, .18);
            transition: transform .2s, box-shadow .2s, filter .2s;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, .25);
            filter: brightness(1.05);
        }

        .login-link {
            color: #1d4ed8;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link:hover { text-decoration: underline; }

        .form-footer {
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 25px;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-22px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @media (max-width: 900px) {
            .page { grid-template-columns: 1fr; }

            .left-panel {
                min-height: auto;
                padding: 35px 7%;
            }

            .brand { margin-bottom: 30px; }

            .main-heading { font-size: 32px; }

            .right-panel {
                min-height: auto;
                padding: 35px 18px;
            }

            .register-card { max-width: 500px; }
        }

        @media (max-width: 480px) {
            .info-grid { grid-template-columns: 1fr; }

            .register-card { padding: 25px 20px; }

            .form-heading { font-size: 26px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
<div class="page">

    <!-- PANEL KIRI -->
    <section class="left-panel">
        <div class="left-content">

            <div class="brand">
                <img
                    src="{{ asset('images/logo-smkn5.png') }}"
                    alt="Logo SMKN 5"
                    class="brand-logo"
                >

                <div>
                    <div class="font-bold text-sm">Book Stock SMKN 5</div>
                    <div class="text-xs text-blue-100 mt-1">
                        Sistem Restock Buku Perpustakaan
                    </div>
                </div>
            </div>

            <p class="eyebrow">Perpustakaan SMKN 5</p>

            <h1 class="main-heading">
                Bergabung dan Kelola Stok Buku dengan Mudah
            </h1>

            <p class="description">
                Buat akun Book Stock SMKN 5 untuk mengakses informasi buku
                dan mengajukan penambahan stok buku perpustakaan.
            </p>

            <div class="info-grid">

                <div class="info-card">
                    <div class="info-title">Pemimpin Perpustakaan</div>
                    <div class="info-value">Panjalu Remasaki</div>
                    <div class="info-detail">Perpustakaan SMKN 5</div>
                </div>

                <div class="info-card">
                    <div class="info-title">Jam Operasional</div>
                    <div class="info-value">Senin – Jumat</div>
                    <div class="info-detail">08.00 – 16.00 WIB</div>
                </div>

                <div class="info-card">
                    <div class="info-title">Lokasi Perpustakaan</div>
                    <div class="info-detail">
                        Jl. Insinyur Sutami, Jl. Raya Mauk No. Km 1,2,
                        Mauk Barat, Kecamatan Mauk, Kabupaten Tangerang,
                        Banten 15330.
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-title">Informasi</div>
                    <div class="info-detail">
                        Sistem membantu pengelolaan data buku dan pengajuan
                        restock agar lebih mudah dipantau.
                    </div>
                </div>

            </div>

            <div class="left-footer">
                © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku
            </div>

        </div>
    </section>

    <!-- PANEL KANAN: FORM REGISTER -->
    <section class="right-panel">
        <div class="register-card">

            <p class="form-eyebrow">Pendaftaran Akun</p>
            <h2 class="form-heading">Buat Akun Baru</h2>

            <p class="form-description">
                Daftarkan akun untuk mulai menggunakan Book Stock SMKN 5.
            </p>

            @if ($errors->any())
                <div class="error-box" role="alert">
                    <p class="font-bold mb-2">Pendaftaran belum berhasil:</p>

                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <label for="name">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@gmail.com"
                        required
                        autocomplete="username"
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Kata Sandi</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan kata sandi"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi kata sandi"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="register-button">
                    Daftar Sekarang &nbsp; →
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="login-link">
                    Masuk di sini
                </a>
            </p>

            <div class="form-footer">
                Sistem Informasi Restock Buku Perpustakaan
            </div>

        </div>
    </section>

</div>
</body>
</html>