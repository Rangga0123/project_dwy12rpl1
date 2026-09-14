<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - Book Stock SMKN5</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-0 p-0">

    <!-- Background -->
    <div
        class="min-h-screen w-full flex items-center justify-center bg-cover bg-center bg-fixed relative"
        style="background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=2000&q=85');"
    >

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/65"></div>

        <!-- Login Card -->
        <div
            class="relative z-10 w-full max-w-md mx-4 p-8 md:p-10
                   bg-black/55 backdrop-blur-xl
                   border border-white/20
                   shadow-2xl rounded-xl"
        >

            <!-- Logo Buku -->
            <div class="flex justify-center mb-6">
                <div
                    class="w-20 h-20
                           bg-white/10
                           border border-white/20
                           rounded-full
                           flex items-center justify-center
                           shadow-lg"
                >
                    <svg
                        class="w-10 h-10 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5
                               S4.168 5.477 3 6.253v13C4.168 18.477
                               5.754 18 7.5 18s3.332.477 4.5 1.253m0-13
                               C13.168 5.477 14.754 5 16.5 5
                               c1.747 0 3.332.477 4.5 1.253v13
                               C19.832 18.477 18.246 18 16.5 18
                               c-1.746 0-3.332.477-4.5 1.253"
                        ></path>
                    </svg>
                </div>
            </div>

            <!-- Judul -->
            <h1
                class="text-white text-center text-2xl font-bold
                       uppercase tracking-widest"
            >
                LOGIN ADMIN
            </h1>

            <p class="text-gray-300 text-center text-sm mt-2 mb-8">
                Book Stock SMKN5
            </p>


            <!-- Error Login -->
            @if ($errors->any())
                <div
                    class="mb-6 p-3 rounded-lg
                           bg-red-500/20
                           border border-red-400/30
                           text-red-200 text-sm"
                >
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">

                    <label
                        for="email"
                        class="block text-white text-xs
                               mb-2 uppercase tracking-wider"
                    >
                        Username / Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"

                        class="w-full
                               bg-transparent
                               border-0
                               border-b border-gray-400
                               text-white
                               placeholder-gray-500
                               focus:border-white
                               focus:outline-none
                               focus:ring-0
                               py-2
                               transition-colors"

                        placeholder="Masukkan email"
                    >

                </div>


                <!-- Password -->
                <div class="mb-4">

                    <label
                        for="password"
                        class="block text-white text-xs
                               mb-2 uppercase tracking-wider"
                    >
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"

                        class="w-full
                               bg-transparent
                               border-0
                               border-b border-gray-400
                               text-white
                               placeholder-gray-500
                               focus:border-white
                               focus:outline-none
                               focus:ring-0
                               py-2
                               transition-colors"

                        placeholder="Masukkan password"
                    >

                </div>


                <!-- Remember Me + Forgot Password -->
                <div class="flex items-center justify-between mb-7">

                    <label class="flex items-center gap-2 text-sm text-gray-300">

                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-gray-500 bg-transparent
                                   text-blue-600 focus:ring-blue-500"
                        >

                        Ingat saya

                    </label>


                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm text-blue-400
                                   hover:text-blue-300
                                   transition"
                        >
                            Lupa password?
                        </a>
                    @endif

                </div>


                <!-- Tombol Login -->
                <button
                    type="submit"

                    class="w-full py-3
                           bg-gradient-to-r
                           from-blue-600
                           to-indigo-600
                           text-white
                           font-bold
                           rounded-lg
                           shadow-lg
                           hover:from-blue-500
                           hover:to-indigo-500
                           hover:shadow-blue-500/30
                           active:scale-[0.98]
                           transition-all"
                >
                    Login
                </button>


                <!-- Register -->
                @if (Route::has('register'))
                    <div class="text-center mt-6">

                        <span class="text-gray-300 text-sm">
                            Belum punya akun?
                        </span>

                        <a
                            href="{{ route('register') }}"
                            class="text-blue-400
                                   hover:text-blue-300
                                   font-semibold
                                   text-sm
                                   ml-1
                                   transition"
                        >
                            Register
                        </a>

                    </div>
                @endif

            </form>


            <!-- Footer -->
            <div class="text-center mt-8">

                <p class="text-gray-500 text-xs">
                    © {{ date('Y') }} Book Stock SMKN5
                </p>

                <p class="text-gray-600 text-xs mt-1">
                    Sistem Restock Buku Perpustakaan
                </p>

            </div>

        </div>

    </div>

</body>
</html>