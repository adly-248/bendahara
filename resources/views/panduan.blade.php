<x-app-layout>
    <style>
        .video-frame {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 720px;
            /* batas lebar video */
            margin: 0 auto;
            /* center di container */
        }

        .panduan-container {
            background: linear-gradient(135deg, #f5f7fa, #e4ecf7);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
            width: auto;
        }

        .panduan-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .panduan-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            text-align: center;
        }

        .panduan-subtitle {
            font-size: 1rem;
            color: #555;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .video-frame {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Tabel modern nuansa maroon & hitam */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            bordeoverr-radius: 10px;
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
            /* merah muda lembut */
        }

        /* Income info styling */
        .income-info {
            text-align: left;
        }

        .income-amount {
            font-weight: 600;
            color: #006400;
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
        .mobile-transaction {
            font-size: 12px;
            color: #666;
            margin: 2px 0;
        }

        .mobile-date {
            font-weight: 500;
        }

        .mobile-transaction {
            color: #006400;
            font-weight: 500;
        }

        /* Category badge untuk pemasukkan */
        .income-badge {
            background: #e8f5e8;
            color: #006400;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid #b3d9b3;
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

            .income-amount {
                font-size: 14px;
            }

            .income-badge {
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

            /* Income info layout untuk mobile */
            .income-info {
                text-align: center;
            }

            .income-amount {
                font-size: 13px;
                font-weight: 700;
            }

            /* Action buttons stack vertically di mobile */
            .action-buttons {
                flex-direction: column;
                gap: 2px;
            }

            /* Category badge lebih kecil */
            .income-badge {
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
                background: #f0f8f0;
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

            /* Compact income info */
            .income-amount {
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

            .income-badge {
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

            .income-amount {
                font-size: 11px;
            }

            .income-badge {
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

            .income-amount {
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

            .income-badge {
                background: #1a2a1a;
                color: #90ee90;
                border-color: #555;
            }

            .mobile-details {
                background: #2a2a2a;
                color: #ccc;
            }

            .income-amount {
                color: #90ee90;
            }
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Video Panduan Web Bendahara SMKN 13 Bandung') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="panduan-container">
            <h3 class="panduan-title">Panduan Penggunaan Web Bendahara</h3>
            <p class="panduan-subtitle">
                Berikut adalah video panduan cara menggunakan aplikasi bendahara sekolah:
            </p>

            <div class="ratio ratio-16x9 video-frame">
                <iframe width="986" height="522" src="https://www.youtube.com/embed/k5LgdbYGRUs"
                    title="WEBSITE BENDAHARA " frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</x-app-layout>
