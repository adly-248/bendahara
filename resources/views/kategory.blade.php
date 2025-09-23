<div>
  <!-- Scripts -->
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
          lengthMenu: 'Tampilkan _MENU_ data',
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

</div>
