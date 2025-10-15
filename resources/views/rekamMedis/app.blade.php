<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Unit Pelayanan Kesehatan' }}</title>
    <!-- Link Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load Font Awesome Icons (digunakan untuk ikon) - Diperbaiki -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --sidebar-width: 230px;
            --sidebar-bg: #dff0f9;
            --sidebar-hover: #b9e0f4;
            --body-bg: #f6fbff;
            --header-bg: #cfe8fa;
        }

        body {
            background-color: var(--body-bg);
            font-family: 'Inter', sans-serif;
            /* Menambahkan font yang umum digunakan */
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar h5 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            color: #0d6efd;
            /* Warna biru untuk judul */
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #000;
            text-decoration: none;
            margin: 8px 10px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--sidebar-hover);
            font-weight: 500;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .content {
            margin-left: calc(var(--sidebar-width) + 20px);
            /* 230px + sedikit margin */
            padding: 25px;
        }

        /* Header yang sesuai dengan permintaan */
        .header {
            background-color: var(--header-bg);
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Button Styles */
        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #1e7e34;
            color: white;
        }

        .btn-red {
            background-color: #dc3545;
            color: white;
        }

        .btn-red:hover {
            background-color: #bd2130;
            color: white;
        }

        .card {
            border-radius: 12px;
            border: none;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h5 class="d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-plus-circle text-primary me-2"></i> Unit Pelayanan Kesehatan
        </h5>
        <!-- Navigasi Sidebar - Diperbarui untuk meniru ikon di screenshot -->
        <nav class="nav flex-column">
            <a class="nav-link" href="#"><i class="fas fa-home"></i> Dashboard</a>
            <a class="nav-link" href="#"><i class="fas fa-user-friends"></i> Pendaftaran Pasien</a>
            <a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i> Jadwal Dokter</a>
            <a class="nav-link active" href="#"><i class="fas fa-notes-medical"></i> Rekam Medis Pasien</a>
            <a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Laporan</a>
        </nav>
    </div>

    <div class="content">
        <div class="header d-flex justify-content-between align-items-center">
            <!-- Judul Dinamis -->
            <span>{{ $title ?? 'Dashboard' }}</span>

            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-primary btn-sm">Logout</button>
            </form>
        </div>

        <!-- Konten halaman akan disisipkan di sini -->
        @yield('content')

    </div>

    <!-- Bootstrap JS Bundle - Diperbaiki -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
```