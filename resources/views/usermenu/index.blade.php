<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Admin SMKN 13 Bandung') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3 header-section">
            <h2 class="mb-0 page-title">Daftar Admin SMKN 13 Bandung</h2>
            <a href="{{ url('usermenu/create') }}" class="btn btn-primary">
                <i class="fa-solid fa-user-plus"></i> <span class="btn-text">Tambah Admin</span>
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table id="slideTable" class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th class="hide-mobile">Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->id }}</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-name">{{ $row->name }}</div>
                                    <div class="user-email-mobile">{{ $row->email }}</div>
                                </div>
                            </td>
                            <td class="hide-mobile">{{ $row->email }}</td>
                            <td class="hide-mobile">
                                <span class="password-field">{{ $row->password }}</span>
                            </td>
                            <td><span class="badge bg-info text-dark">{{ $row->role }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ url('usermenu/' . $row->id . '/edit') }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i> <span class="btn-text">Edit</span>
                                    </a>

                                    <form action="{{ url('usermenu/' . $row->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fa-solid fa-trash"></i> <span class="btn-text">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        /* Tabel modern dengan nuansa maroon & hitam */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header tabel */
        .custom-table thead {
            background: linear-gradient(135deg, #800000, #000000);
            /* maroon → hitam */
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 14px;
        }

        .custom-table th {
            padding: 14px;
            font-weight: 600;
            text-align: center;
        }

        /* Isi tabel */
        .custom-table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #333;
        }

        /* Hover baris */
        .custom-table tbody tr {
            transition: background 0.25s ease;
        }

        .custom-table tbody tr:hover {
            background: #fcebea;
            /* merah muda soft saat hover */
        }

        /* Badge role */
        .badge {
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
        }

        .bg-info {
            background: #ffe0e0;
            color: #800000 !important;
            /* maroon */
            border: 1px solid #d4a5a5;
        }

        /* Tombol aksi */
        .custom-table td .btn {
            margin: 2px;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 13px;
            transition: all 0.2s ease;
        }

        .btn-warning {
            background: #f39c12;
            border: none;
            color: #fff;
        }

        .btn-warning:hover {
            background: #d68910;
            color: white;
        }

        .btn-danger {
            background: #c0392b;
            border: none;
            color: #fff;
        }

        .btn-danger:hover {
            background: #922b21;
        }

        .btn-primary {
            background: #800000;
            /* maroon */
            border: none;
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: #5a0000;
            color: #fff;
        }

        /* Responsive */
        .table-responsive {
            border-radius: 12px;
            overflow-x: auto;
        }

        /* User info untuk mobile */
        .user-info {
            text-align: left;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }

        .user-email-mobile {
            font-size: 12px;
            color: #666;
            margin-top: 2px;
            display: none;
        }

        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Password field styling */
        .password-field {
            font-family: monospace;
            font-size: 12px;
            background: #f8f9fa;
            padding: 4px 8px;
            border-radius: 4px;
            color: #666;
        }

        /* Header section responsive */
        .header-section {
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            font-size: 1.5rem;
            color: #800000;
        }

        /* ================ RESPONSIVE BREAKPOINTS ================ */

        /* Tablet Portrait */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 15px;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .custom-table th,
            .custom-table td {
                padding: 10px 8px;
                font-size: 13px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 3px;
            }

            .btn-sm {
                padding: 4px 8px;
                font-size: 12px;
            }

            /* Show email di bawah nama untuk tablet */
            .user-email-mobile {
                display: block;
            }
        }

        /* Mobile Landscape & Portrait */
        @media (max-width: 576px) {
            .header-section {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .page-title {
                font-size: 1.2rem;
                margin-bottom: 10px;
            }

            /* Hide kolom password di mobile */
            .hide-mobile {
                display: none;
            }

            .user-email-mobile {
                display: block;
            }

            .custom-table th,
            .custom-table td {
                padding: 8px 5px;
                font-size: 12px;
            }

            /* Button text hilang di mobile, hanya icon */
            .btn-text {
                display: none;
            }

            .btn {
                padding: 6px 8px;
            }

            .btn-sm {
                padding: 4px 6px;
            }

            /* Action buttons stack vertically di mobile */
            .action-buttons {
                flex-direction: column;
                gap: 2px;
            }

            /* Badge lebih kecil */
            .badge {
                padding: 4px 6px;
                font-size: 11px;
            }

            /* Table scroll improvement */
            .table-responsive {
                -webkit-overflow-scrolling: touch;
            }
        }

        /* Extra Small Mobile */
        @media (max-width: 480px) {
            .container-fluid {
                padding: 10px;
            }

            .page-title {
                font-size: 1.1rem;
            }

            .custom-table {
                font-size: 11px;
            }

            .custom-table th,
            .custom-table td {
                padding: 6px 3px;
            }

            /* Compact user info */
            .user-name {
                font-size: 13px;
            }

            .user-email-mobile {
                font-size: 11px;
            }

            /* Even smaller buttons */
            .btn {
                padding: 4px 6px;
                font-size: 11px;
            }

            .btn-sm {
                padding: 3px 5px;
            }
        }

        /* Ultra Small Screens */
        @media (max-width: 360px) {
            .page-title {
                font-size: 1rem;
            }

            .custom-table {
                font-size: 10px;
            }

            .custom-table th,
            .custom-table td {
                padding: 5px 2px;
            }

            /* Minimize action buttons */
            .action-buttons .btn {
                padding: 3px 4px;
                margin: 1px;
            }

            .badge {
                padding: 3px 5px;
                font-size: 10px;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .container-fluid {
                max-width: 1400px;
                margin: 0 auto;
            }

            .custom-table th,
            .custom-table td {
                padding: 16px;
                font-size: 15px;
            }

            .page-title {
                font-size: 1.8rem;
            }
        }

        /* Dark mode support (opsional) */
        @media (prefers-color-scheme: dark) {
            .custom-table {
                background: #1a1a1a;
                color: #fff;
            }

            .custom-table td {
                color: #e5e5e5;
                border-bottom-color: #333;
            }

            .custom-table tbody tr:hover {
                background: #2a1a1a;
            }

            .password-field {
                background: #2a2a2a;
                color: #ccc;
            }
        }
    </style>

</x-app-layout>
