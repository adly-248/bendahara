<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="{{asset('css/custom-table.css')}}">

    <!-- Laravel Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        $(document).ready(function() {
            $('#slideTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_  data',
                    zeroRecords: 'Tidak ada data ditemukan',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data tersedia',
                    paginate: {
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                }
            });
        });
    </script>
</head>

<body class="d-flex flex-column min-vh-100 font-sans antialiased">

    <!-- Header -->
    @include('layouts.navigation')

    @isset($header)
        <header class="bg-white shadow flex-shrink-0">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="d-flex flex-grow-1 overflow-hidden">
        <!-- Side Menu -->
        @include('layouts.sidemenu')

        <!-- Main Content -->
        <div class="flex-grow-1 overflow-auto p-3">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-white text-center py-3 flex-shrink-0" style="background-color: #800000;">
        <p>&copy; {{ date('Y') }} Bendahara SMKN 13 Bandung - Sistem Keuangan.</p>
    </footer>

</body>

</html>
