<x-app-layout>

    <style>
        .filter-container {
            background: linear-gradient(135deg, #6a1b29 0%, #8e2c3b 100%);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .filter-form {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4b1c1f;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background-color: white;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%234b1c1f' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
        }

        .form-select:focus {
            outline: none;
            border-color: #8e2c3b;
            box-shadow: 0 0 0 3px rgba(142, 44, 59, 0.2);
            transform: translateY(-1px);
        }

        .btn-modern {
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.875rem;
            box-shadow: 0 4px 14px 0 rgba(0, 0, 0, 0.25);
            border: none;
            cursor: pointer;
        }

        .btn-filter {
            background: linear-gradient(135deg, #6a1b29 0%, #8e2c3b 100%);
            color: white;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(142, 44, 59, 0.4);
        }

        .btn-print {
            background: linear-gradient(135deg, #b83250 0%, #d6455d 100%);
            color: white;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 50, 80, 0.4);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6a1b29 0%, #8e2c3b 100%);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }

        .stats-card.income::before {
            background: linear-gradient(90deg, #6a994e 0%, #a7c957 100%);
        }

        .stats-card.expense::before {
            background: linear-gradient(90deg, #b83250 0%, #d6455d 100%);
        }

        .stats-card.balance::before {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        }


        .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;

        }

        .stats-title {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stats-value {
            font-size: 1.875rem;
            font-weight: 700;
            line-height: 1.2;
            margin: 0;
        }

        .income-value {
            color: #6a994e;
        }

        .expense-value {
            color: #b91c1c;
        }

        .balance-value {
            color: #6a1b29;
        }

        .filter-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Tabel modern nuansa maroon & hitam */
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
            vertical-align: middle;
        }

        /* Hover baris */
        .custom-table tbody tr {
            transition: background 0.25s ease;
        }

        .custom-table tbody tr:hover {
            background: #fcebea;
            /* merah muda lembut */
        }

        /* Expense info styling */
        .expense-info {
            text-align: left;
        }

        .amount {
            font-weight: 600;
            color: #800000;
            font-size: 15px;
        }

        .mobile-details {
            display: none;
            margin-top: 5px;
            padding-top: 5px;
            border-top: 1px solid #eee;
        }

        .mobile-details.show {
            display: block;
        }

        .mobile-date,
        .mobile-transaction,
        .mobile-description {
            font-size: 12px;
            color: #666;
            margin: 2px 0;
        }

        .mobile-date {
            font-weight: 500;
        }

        .mobile-transaction {
            color: #800000;
            font-weight: 500;
        }

        /* Category badge */
        .category-badge {
            background: #ffe0e0;
            color: #800000;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid #d4a5a5;
        }

        /* Description cell */
        .description-cell {
            max-width: 150px;
            word-wrap: break-word;
            cursor: help;
        }

        /* Proof image styling */
        .proof-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 2px solid #ddd;
        }

        .no-proof {
            font-size: 12px;
            color: #999;
            font-style: italic;
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

        .btn-info {
            background: #17a2b8;
            border: none;
            color: #fff;
        }

        .btn-info:hover {
            background: #138496;
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

        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
            flex-wrap: wrap;
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

        /* Mobile details button - hidden by default */
        .mobile-details-btn {
            display: none;
        }

        /* Image Modal */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            position: relative;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 700px;
            text-align: center;
        }

        .modal-content img {
            max-width: 100%;
            max-height: 70vh;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #fff;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
        }

        /* ================ RESPONSIVE BREAKPOINTS ================ */

        /* Tablet Portrait */
        @media (max-width: 992px) {
            .hide-tablet {
                display: none;
            }

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

            .proof-image {
                width: 50px;
                height: 50px;
            }
        }

        /* Mobile Landscape */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 3px;
            }

            .btn-sm {
                padding: 4px 8px;
                font-size: 12px;
            }

            .mobile-details-btn {
                display: inline-block;
            }

            .amount {
                font-size: 14px;
            }

            .category-badge {
                font-size: 11px;
                padding: 3px 6px;
            }
        }

        /* Mobile Portrait */
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

            /* Hide kolom untuk mobile */
            .hide-mobile {
                display: none;
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

            /* Expense info layout untuk mobile */
            .expense-info {
                text-align: center;
            }

            .amount {
                font-size: 13px;
                font-weight: 700;
            }

            /* Action buttons stack vertically di mobile */
            .action-buttons {
                flex-direction: column;
                gap: 2px;
            }

            /* Category badge lebih kecil */
            .category-badge {
                font-size: 10px;
                padding: 2px 5px;
            }

            /* Table scroll improvement */
            .table-responsive {
                -webkit-overflow-scrolling: touch;
            }

            /* Mobile details styling */
            .mobile-details {
                font-size: 11px;
                text-align: left;
                background: #f8f9fa;
                padding: 5px;
                border-radius: 4px;
                margin-top: 3px;
            }

            .details-text {
                display: none;
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

            /* Compact expense info */
            .amount {
                font-size: 12px;
            }

            .mobile-details {
                font-size: 10px;
                padding: 3px;
            }

            /* Even smaller buttons */
            .btn {
                padding: 4px 6px;
                font-size: 11px;
            }

            .btn-sm {
                padding: 3px 5px;
            }

            .category-badge {
                font-size: 9px;
                padding: 2px 4px;
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

            .amount {
                font-size: 11px;
            }

            .category-badge {
                font-size: 8px;
                padding: 1px 3px;
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

            .proof-image {
                width: 80px;
                height: 80px;
            }

            .amount {
                font-size: 16px;
            }
        }

        /* Dark mode support */
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

            .category-badge {
                background: #2a1a1a;
                color: #ff9999;
                border-color: #555;
            }

            .mobile-details {
                background: #2a2a2a;
                color: #ccc;
            }

            .description-cell {
                color: #ccc;
            }

            .amount {
                color: #ff9999;
            }
        }
    </style>

    <!-- Filter Section -->
    {{-- (isi HTML filter dan card sama, tidak berubah sistemnya) --}}
    {{-- -- PASTE HTML YANG KAMU PUNYA DI SINI -- --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Laporan SMKN 13 Bandung') }}
        </h2>
    </x-slot>

    <div class="d-flex justify-content-between align-items-center mb-3 header-section">
        <h2 class="mb-0 page-title font-semibold">Data Laporan SMKN 13 Bandung</h2>
    </div>

    <!-- Filter Section -->
    <div class="filter-container">
        <h3 class="filter-title">📊 Filter Laporan Keuangan</h3>
        <form method="GET" action="{{ route('laporan.index') }}" class="filter-form">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="form-group">
                    <label class="form-label">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Bulan
                    </label>
                    <select name="month" class="form-select">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ (int) $month === $m ? 'selected' : '' }}>
                                {{ str_pad($m, 2, '0', STR_PAD_LEFT) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tahun
                    </label>
                    <select name="year" class="form-select">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach (range(date('Y') - 5, date('Y') + 1) as $y)
                            <option value="{{ $y }}" {{ (int) $year === $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a1.994 1.994 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        Kategori Pengeluaran
                    </label>
                    <select name="kategori" class="form-select">
                        <option value="">-- Semua Kategori --</option>
                        <option value="ATK" {{ request('kategori') === 'ATK' ? 'selected' : '' }}>ATK</option>
                        <option value="Listrik_Air" {{ request('kategori') === 'Listrik_Air' ? 'selected' : '' }}>
                            Listrik & Air</option>
                        <option value="Kegiatan_Siswa"
                            {{ request('kategori') === 'Kegiatan_Siswa' ? 'selected' : '' }}>
                            Kegiatan Siswa</option>
                        <option value="Gaji_Guru_Staff"
                            {{ request('kategori') === 'Gaji_Guru_Staff' ? 'selected' : '' }}>Gaji Guru & Staff
                        </option>
                        <option value="Perawatan_Fasilitas"
                            {{ request('kategori') === 'Perawatan_Fasilitas' ? 'selected' : '' }}>Perawatan Fasilitas
                        </option>
                        <option value="Konsumsi" {{ request('kategori') === 'Konsumsi' ? 'selected' : '' }}>Konsumsi
                        </option>
                        <option value="Transportasi" {{ request('kategori') === 'Transportasi' ? 'selected' : '' }}>
                            Transportasi</option>
                        <option value="Lainnya" {{ request('kategori') === 'Lainnya' ? 'selected' : '' }}>Lainnya
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z">
                            </path>
                        </svg>
                        Transaksi
                    </label>
                    <select name="transaksi" class="form-select">
                        <option value="">-- Semua Transaksi --</option>
                        <option value="Tunai" {{ request('transaksi') === 'Tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="Transfer" {{ request('transaksi') === 'Transfer' ? 'selected' : '' }}>Transfer
                        </option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button type="submit" class="btn-modern btn-filter">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z">
                        </path>
                    </svg>
                    Filter Data
                </button>

                <a href="{{ route('laporan.print', request()->all()) }}" class="btn-modern btn-print">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Print PDF
                </a>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-container">
        <div class="stats-card income">
            <div class="stats-icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                </svg>
            </div>
            <h3 class="stats-title">💰 Total Pemasukan</h3>
            <p class="stats-value income-value">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="stats-card expense">
            <div class="stats-icon" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                </svg>
            </div>
            <h3 class="stats-title">💸 Total Pengeluaran</h3>
            <p class="stats-value expense-value">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="stats-card balance">
            <div class="stats-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 7h6m-6 4h6m-6 4h6m-9 2a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H6z" />
                </svg>
            </div>
            <h3 class="stats-title">💎 Saldo Akhir</h3>
            <p class="stats-value balance-value">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

</x-app-layout>
