<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Restock - Book Stock SMKN5</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f4f0;
            color: #5c321d;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #713f24;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            padding: 24px 14px;
        }

        .logo {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,.25);
        }

        .logo-icon {
            font-size: 48px;
        }

        .logo h2 {
            margin: 8px 0 5px;
            font-size: 22px;
        }

        .logo p {
            margin: 0;
            font-size: 13px;
            opacity: .9;
        }

        .nav {
            margin-top: 25px;
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            margin-bottom: 6px;
            border-radius: 10px;
            transition: .2s;
        }

        .nav a:hover,
        .nav a.active {
            background: #e87518;
        }

        .nav-icon {
            width: 25px;
            text-align: center;
            font-size: 20px;
        }

        /* MAIN */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 68px;
            background: white;
            border-bottom: 2px solid #713f24;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .menu {
            font-size: 28px;
            color: #713f24;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: bold;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #713f24;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 35px;
        }

        .page-title h1 {
            margin: 0;
            font-size: 32px;
        }

        .page-title p {
            margin-top: 7px;
            color: #6d7280;
        }

        .card {
            background: white;
            border: 2px solid #9a542b;
            border-radius: 16px;
            margin-top: 25px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,.06);
        }

        .card-header {
            padding: 22px 25px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            margin: 0;
            font-size: 21px;
        }

        .btn-add {
            background: #713f24;
            color: white;
            text-decoration: none;
            padding: 11px 17px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-add:hover {
            background: #e87518;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #faf6f1;
            color: #713f24;
            padding: 16px;
            text-align: left;
            font-size: 14px;
            border-bottom: 2px solid #9a542b;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #eee;
            color: #4b5563;
        }

        tr:hover {
            background: #fffaf5;
        }

        .empty {
            text-align: center;
            padding: 55px 20px;
            color: #777;
        }

        .empty-icon {
            font-size: 45px;
            margin-bottom: 10px;
        }

        /* STATUS */
        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .disetujui {
            background: #d1fae5;
            color: #047857;
        }

        .ditolak {
            background: #fee2e2;
            color: #b91c1c;
        }

        .catatan {
            font-size: 13px;
            color: #777;
            margin-top: 5px;
        }

        @media(max-width: 800px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">📖</div>

            <h2>Book Stock SMKN5</h2>

            <p>
                Sistem Restock Buku<br>
                Perpustakaan
            </p>
        </div>

        <nav class="nav">

            <a href="{{ route('dashboard') }}">
                <span class="nav-icon">🏠</span>
                Dashboard
            </a>

            <a href="{{ route('books.index') }}">
                <span class="nav-icon">📚</span>
                Data Buku
            </a>

            <a href="{{ route('user.restock.create') }}">
                <span class="nav-icon">📄</span>
                Pengajuan Restock
            </a>

            <a href="{{ route('user.restock.history') }}" class="active">
                <span class="nav-icon">🕘</span>
                Riwayat Restock
            </a>

            <a href="{{ route('profile.edit') }}">
                <span class="nav-icon">👤</span>
                Profil
            </a>

            <a href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="nav-icon">🚪</span>
                Logout
            </a>

            <form id="logout-form"
                  method="POST"
                  action="{{ route('logout') }}"
                  style="display:none;">
                @csrf
            </form>

        </nav>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <header class="topbar">

            <div class="menu">
                ☰
            </div>

            <div class="user-info">

                <span>🔔</span>

                <div class="avatar">
                    👤
                </div>

                <div>
                    {{ auth()->user()->name }}

                    <small style="display:block;color:#777;font-weight:normal;">
                        User
                    </small>
                </div>

            </div>

        </header>


        <section class="content">

            <div class="page-title">

                <h1>Riwayat Restock</h1>

                <p>
                    Lihat semua pengajuan restock yang pernah Anda kirim.
                </p>

            </div>


            <div class="card">

                <div class="card-header">

                    <h2>Daftar Pengajuan Restock</h2>

                    <a href="{{ route('user.restock.create') }}"
                       class="btn-add">
                        + Pengajuan Baru
                    </a>

                </div>


                @if($requests->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Buku</th>
                                    <th>Jumlah</th>
                                    <th>Alasan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Catatan Admin</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($requests as $request)

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <strong>
                                                {{ $request->restock->title ?? '-' }}
                                            </strong>

                                            @if($request->restock)
                                                <div class="catatan">
                                                    {{ $request->restock->author }}
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $request->jumlah }} buku
                                        </td>

                                        <td>
                                            {{ $request->alasan ?: '-' }}
                                        </td>

                                        <td>
                                            {{ $request->created_at->format('d/m/Y H:i') }}
                                        </td>

                                        <td>

                                            @if($request->status === 'menunggu')

                                                <span class="status menunggu">
                                                    Menunggu
                                                </span>

                                            @elseif($request->status === 'disetujui')

                                                <span class="status disetujui">
                                                    Disetujui
                                                </span>

                                            @elseif($request->status === 'ditolak')

                                                <span class="status ditolak">
                                                    Ditolak
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            {{ $request->catatan_admin ?: '-' }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty">

                        <div class="empty-icon">
                            📄
                        </div>

                        <h3>Belum Ada Pengajuan</h3>

                        <p>
                            Anda belum pernah membuat pengajuan restock.
                        </p>

                        <a href="{{ route('user.restock.create') }}"
                           class="btn-add">
                            Buat Pengajuan Restock
                        </a>

                    </div>

                @endif

            </div>

        </section>

    </main>

</div>

</body>
</html>