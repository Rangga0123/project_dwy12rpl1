@extends(Auth::user()->role === 'admin' ? 'admin.layouts.app' : 'user.layouts.app')

@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi akun kamu')

@push('styles')
<style>
    :root {
        --brown: #70432d;
        --brown-dark: #5d3523;
        --orange: #d96b24;
        --line: #e9e1db;
    }

    .profile-card {
        background: white;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 2px 7px rgba(55,35,24,.035);
        overflow: hidden;
    }
    .card-heading { padding: 19px 22px; border-bottom: 1px solid var(--line); }
    .card-body { padding: 22px; }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #57534e;
        margin-bottom: 7px;
    }
    .form-input {
        width: 100%;
        border: 1px solid #ded6cf;
        border-radius: 8px;
        padding: 11px 12px;
        font-size: 14px;
        background: white;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }
    .form-input:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(217,107,36,.12);
    }

    .btn-primary, .btn-orange, .btn-danger {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s ease;
    }
    .btn-primary { background: var(--brown); color: white; border: none; }
    .btn-primary:hover { background: var(--brown-dark); }
    .btn-orange { background: var(--orange); color: white; border: none; }
    .btn-orange:hover { background: #c95e1b; }
    .btn-danger { background: white; color: #b91c1c; border: 1px solid #fecaca; }
    .btn-danger:hover { background: #fef2f2; }

    .notice-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 12px 15px;
        border-radius: 9px;
        font-size: 13px;
    }
    .notice-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        padding: 12px 15px;
        border-radius: 9px;
        font-size: 13px;
    }

    .profile-photo, .photo-placeholder {
        width: 105px;
        height: 105px;
        border-radius: 50%;
        border: 4px solid #f3e8df;
    }
    .profile-photo { object-fit: cover; background: #eadfd6; }
    .photo-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eadfd6;
        color: var(--brown);
        font-size: 35px;
        font-weight: bold;
    }

    @media (max-width: 639px) {
        .card-body, .card-heading { padding: 16px; }
    }
</style>
@endpush

@section('content')
@php
    $user = Auth::user();
    $isAdmin = $user->role === 'admin';
@endphp

<section class="content-area p-4 md:p-8 page-content">
    <div class="max-w-5xl mx-auto">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-stone-800">Pengaturan Profil</h1>
            <p class="text-sm text-stone-500 mt-1">
                Perbarui informasi akun, foto profil, dan kata sandi.
            </p>
        </div>

        @if (session('success'))
            <div class="notice-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('success_photo'))
            <div class="notice-success mb-4">
                {{ session('success_photo') }}
            </div>
        @endif

        @if (session('success_password'))
            <div class="notice-success mb-4">
                {{ session('success_password') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="notice-error mb-5">
                <p class="font-bold mb-2">Ada data yang perlu diperiksa:</p>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- FOTO PROFIL -->
            <div class="profile-card">
                <div class="card-heading">
                    <h3 class="font-bold text-stone-800">Foto Profil</h3>
                    <p class="text-xs text-stone-500 mt-1">Foto yang tampil di akun kamu</p>
                </div>

                <div class="card-body">
                    <div class="flex flex-col items-center text-center">

                        @if ($user->profile_photo)
                            <img id="photoPreview"
                                 src="{{ asset('storage/' . $user->profile_photo) }}"
                                 alt="Foto profil" class="profile-photo mb-4">
                        @else
                            <div id="photoPlaceholder" class="photo-placeholder mb-4">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <img id="photoPreview" src="" alt="Pratinjau foto profil"
                                 class="profile-photo mb-4 hidden">
                        @endif

                        <h4 class="font-bold text-stone-800">{{ $user->name }}</h4>
                        <p class="text-xs text-stone-500 mt-1">{{ $user->email }}</p>

                        <span class="mt-3 px-3 py-1 rounded-full text-xs font-semibold"
                              style="background:#f5e7dc;color:#70432d;">
                            {{ $isAdmin ? 'Administrator' : 'User' }}
                        </span>
                    </div>

                    <form method="POST" action="{{ route('profile.photo.update') }}"
                          enctype="multipart/form-data" class="mt-6">
                        @csrf

                        <label for="profile_photo" class="form-label">Pilih foto baru</label>
                        <input type="file" id="profile_photo" name="profile_photo"
                               accept="image/jpeg,image/png,image/webp"
                               class="form-input text-xs" required>

                        <p class="text-xs text-stone-500 mt-2">
                            Format JPG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                        <button type="submit" class="btn-orange w-full mt-4">Simpan Foto</button>
                    </form>

                    @if ($user->profile_photo)
                        <form method="POST" action="{{ route('profile.photo.delete') }}" class="mt-3"
                              onsubmit="return confirm('Yakin ingin menghapus foto profil?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger w-full">Hapus Foto Profil</button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- INFORMASI AKUN -->
            <div class="profile-card lg:col-span-2">
                <div class="card-heading">
                    <h3 class="font-bold text-stone-800">Informasi Akun</h3>
                    <p class="text-xs text-stone-500 mt-1">Ubah nama atau email akun kamu</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-5">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-input"
                                   value="{{ old('name', $user->name) }}"
                                   required maxlength="255" autocomplete="name">
                        </div>

                        <div class="mb-5">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input"
                                   value="{{ old('email', $user->email) }}"
                                   required maxlength="255" autocomplete="username">
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Role Akun</label>
                            <input type="text" class="form-input bg-stone-50"
                                   value="{{ $isAdmin ? 'Administrator' : 'User' }}" disabled>
                            <p class="text-xs text-stone-500 mt-2">
                                Role akun hanya dapat diubah oleh pengelola sistem.
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- GANTI PASSWORD -->
            <div class="profile-card lg:col-span-3">
                <div class="card-heading">
                    <h3 class="font-bold text-stone-800">Keamanan Akun</h3>
                    <p class="text-xs text-stone-500 mt-1">
                        Ganti kata sandi untuk menjaga keamanan akun.
                    </p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                                <input type="password" id="current_password" name="current_password"
                                       class="form-input" autocomplete="current-password" required>
                            </div>

                            <div>
                                <label for="password" class="form-label">Kata Sandi Baru</label>
                                <input type="password" id="password" name="password"
                                       class="form-input" autocomplete="new-password" required>
                            </div>

                            <div>
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-input" autocomplete="new-password" required>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit" class="btn-primary">Ganti Kata Sandi</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <footer class="text-center text-xs text-stone-400 mt-7">
            © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
        </footer>

    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('profile_photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    if (!photoInput || !photoPreview) return;

    photoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('Silakan pilih file gambar.');
            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
            photoPreview.src = event.target.result;
            photoPreview.classList.remove('hidden');
            photoPlaceholder?.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush