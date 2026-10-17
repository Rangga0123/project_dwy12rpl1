<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Book Stock SMKN 5</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background:
                linear-gradient(rgba(8, 25, 50, .68), rgba(8, 25, 50, .80)),
                url('/images/background-login.jpg') center center / cover fixed;
        }

        .login-card {
            background: rgba(255, 255, 255, .96);
            backdrop-filter: blur(12px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, .30);
            animation: cardAppear .7s ease-out;
        }

        .school-logo {
            animation: logoAppear .8s ease-out;
        }

        .btn-primary {
            transition: all .25s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, .28);
        }

        .form-input {
            transition: all .2s ease;
        }

        .form-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
            outline: none;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(22px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes logoAppear {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body class="flex min-h-screen items-center justify-center px-4 py-8">

    <main class="login-card w-full max-w-md rounded-2xl p-7 sm:p-9">

        <!-- LOGO DAN JUDUL -->
        <div class="school-logo mb-6 text-center">
            <img
                src="{{ asset('images/logo-smkn5.png') }}"
                alt="Logo SMKN 5"
                class="mx-auto mb-3 h-20 w-20 object-contain"
                onerror="this.style.display='none'"
            >

            <h1 class="text-2xl font-bold tracking-tight text-slate-800">
                Lupa Password?
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Book Stock SMKN 5
            </p>

            <div class="mx-auto mt-4 h-1 w-14 rounded-full bg-blue-700"></div>
        </div>

        <!-- DESKRIPSI -->
        <p class="mb-6 text-sm leading-6 text-slate-600">
            Masukkan email yang kamu gunakan saat mendaftar.
            Kami akan membantu mengirimkan tautan untuk membuat
            password baru.
        </p>

        <!-- PESAN SUKSES -->
        @if (session('status'))
            <div class="mb-4 rounded-xl border border-green-200 bg-green-50 p-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <!-- PESAN ERROR -->
        @if ($errors->any())
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM EMAIL -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email"
                class="mb-2 block text-sm font-semibold text-slate-700">
                Alamat Email
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email kamu"
                required
                autofocus
                autocomplete="email"
                class="form-input mb-5 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800"
            >

            <button
                type="submit"
                class="btn-primary w-full rounded-xl bg-blue-700 py-3 font-semibold text-white hover:bg-blue-800"
            >
                Kirim Link Reset Password
            </button>
        </form>

        <!-- KEMBALI KE LOGIN -->
        <div class="mt-6 text-center">
            <a
                href="{{ route('login') }}"
                class="text-sm font-semibold text-blue-700 transition hover:text-blue-900 hover:underline"
            >
                ← Kembali ke Login
            </a>
        </div>

        <!-- FOOTER -->
        <footer class="mt-7 border-t border-slate-200 pt-5 text-center">
            <p class="text-xs text-slate-500">
                Sistem Restock Buku Perpustakaan
            </p>
            <p class="mt-1 text-xs text-slate-400">
                © {{ date('Y') }} Book Stock SMKN 5
            </p>
        </footer>

    </main>

</body>
</html>