<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Transaksi Jual Sparepart') }}
      </h2>

      <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       </x-slot>
    <br>
    <div class="container">
      <h2>Form Transaksi Jual Sparepart</h2>
      <br>

   <body class="p-4">
       <div class="container">
           <div class="row mb-3">
               <div class="col-md-3">
                   <label>Id Transaksi</label>
                   <input type="text" id="idTransaksi" class="form-control">
               </div>
               <div class="col-md-3">
                   <label>Tanggal</label>
                   <input type="date" id="tanggal" class="form-control">
               </div>
               <div class="col-md-6">
                   <label>Keterangan</label>
                   <input type="text" id="keterangan" class="form-control">
               </div>
           </div>

           <div class="row mb-3">
              <div class="col-md-3">
                  <label>Id Kendaraan / Merek</label>
                  <select class="form-select form-select-lg" name="kendaraan_id" id="kendaraan_id">
                     <option value=""></option>
                     @foreach($kendaraan as $row)
                       <option value="{{ $row->kendaraan_id }}">{{ $row->kendaraan_id }} - {{ $row->merek }}</option>
                     @endforeach
                   </select>
              </div>
          </div>


           <div class="row mb-3">
               <div class="col-md-3">
                   <label>SparePart ID</label>
                   <select class="form-select form-select-lg" name="sparepart_id" id="sparepart_id">
                      <option value=""></option>
                      @foreach($sparepart as $row)
                        <option value="{{ $row->sparepart_id }}">{{ $row->sparepart_id }}</option>
                      @endforeach
                    </select>
               </div>

               <div class="col-md-3">
                   <label>Nama Sparepart</label>
                   <input type="text" id="nama_sparepart" class="form-control">
               </div>
               <div class="col-md-2">
                   <label>Harga</label>
                   <input type="number" id="harga" class="form-control">
               </div>
               <div class="col-md-2">
                   <label>Jumlah</label>
                   <input type="number" id="jumlah" class="form-control">
               </div>
           </div>

           <table class="table table-bordered mt-3">
               <thead>
                   <tr>
                       <th>No</th>
                       <th>Sparepart ID</th>
                       <th>Nama Sparepart</th>
                       <th>Harga</th>
                       <th>Jumlah</th>
                       <th>Total</th>
                       <th>Aksi</th>
                   </tr>
               </thead>
               <tbody id="tableBody"></tbody>
           </table>

           <h5>Total Harga: <span id="totalHarga" class="fw-bold text-danger">0</span></h5>

           <button class="btn btn-primary mt-3" id="proses">Proses</button>
           <button class="btn btn-success mt-3" id="print" style="display: none;">Cetak</button>
       </div>

  <script>


   $(document).ready(function(){

  let count = 0;
  let totalHargaAkhir = 0;
  let transaksiDetails = [];

  $('#sparepart_id').change(function(){
      let sparepartID = $(this).val();
      if(sparepartID) {
          $.ajax({
              url: "{{ url('/getSparepart') }}/" + sparepartID,
              type: "GET",
              dataType: "json",
              success: function(data) {
                  $('#nama_sparepart').val(data.nama_sparepart);
                  $('#harga').val(data.harga);
              },
              error: function() {
                  alert('Gagal mengambil data sparepart.');
              }
          });
      } else {
          $('#nama_sparepart, #harga').val('');
      }
  });

  $('#jumlah').keypress(function(e){
      if(e.which == 13){
          e.preventDefault();

          let sparepartID = $('#sparepart_id').val();
          let nama_sparepart = $('#nama_sparepart').val();
          let harga = parseFloat($('#harga').val());
          let jumlah = parseInt($('#jumlah').val());
          let total = harga * jumlah;

          if(sparepartID && nama_sparepart && harga && jumlah){
              count++;
              totalHargaAkhir += total;

              transaksiDetails.push({
                  sparepart_id: sparepartID,
                  quantity: jumlah,
                  harga: harga,
                  subtotal: total
              });

              $('#tableBody').append(`
                  <tr>
                      <td>${count}</td>
                      <td>${sparepartID}</td>
                      <td>${nama_sparepart}</td>
                      <td>${harga}</td>
                      <td>${jumlah}</td>
                      <td>${total}</td>
                      <td><button class='btn btn-danger btn-sm delete' data-index="${count - 1}">Delete</button></td>
                  </tr>
              `);

              $('#totalHarga').text(totalHargaAkhir);
              $('#sparepart_id').val('');
              $('#nama_sparepart, #harga, #jumlah').val('');
              $('#sparepart_id').focus();
          }
      }
  });

  $(document).on('click', '.delete', function(){
      let index = $(this).data('index');
      let row = $(this).closest('tr');
      let total = parseFloat(row.find('td:eq(5)').text());

      transaksiDetails.splice(index, 1);
      totalHargaAkhir -= total;
      $('#totalHarga').text(totalHargaAkhir);
      row.remove();
  });

  $('#proses').click(function(){
      let transaksiData = {
          idTransaksi: $('#idTransaksi').val(),
          kendaraan_id: $('#kendaraan_id').val(),
          tanggal: $('#tanggal').val(),
          keterangan: $('#keterangan').val(),
          total_harga: totalHargaAkhir,
          detail_transaksi: transaksiDetails
      };

      $.ajax({
          url: "{{ url('/transaksi/store') }}",
          type: "POST",
          data: JSON.stringify(transaksiData),
          contentType: "application/json",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response){
              alert(response.message);
              $('#print').show(); // Tampilkan tombol cetak setelah transaksi berhasil

          },
          error: function(xhr){
              alert("Gagal menyimpan transaksi.");
          }
      });
  });

  $('#print').click(function() {
      printReceipt();
      setTimeout(function() {
          location.reload();
      }, 3000); // Reload setelah 3 detik (3000 ms)
  });
  function printReceipt() {
      let receiptContent = `
          <h3 style="text-align:center;">Bengkel Sparepart</h3>
          <hr>
          <p><strong>ID Transaksi:</strong> ${$('#idTransaksi').val()}</p>
          <p><strong>Tanggal:</strong> ${$('#tanggal').val()}</p>
          <p><strong>Keterangan:</strong> ${$('#keterangan').val()}</p>
          <hr>
          <table border="1" width="100%" cellspacing="0" cellpadding="5">
              <tr>
                  <th>Sparepart ID</th>
                  <th>Nama Sparepart</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Total</th>
              </tr>`;

      transaksiDetails.forEach(item => {
          receiptContent += `
              <tr>
                  <td>${item.sparepart_id}</td>
                  <td>${$('#nama_sparepart').val()}</td>
                  <td>${item.harga}</td>
                  <td>${item.quantity}</td>
                  <td>${item.subtotal}</td>
              </tr>`;
      });

      receiptContent += `
          </table>
          <h4>Total Harga: Rp ${totalHargaAkhir}</h4>
          <hr>
          <p style="text-align:center;">Terima kasih telah percaya kami..!</p>`;

      let newWindow = window.open('', '_blank', 'width=400,height=600');
      newWindow.document.write('<html><head><title>Struk Transaksi</title></head><body>');
      newWindow.document.write(receiptContent);
      newWindow.document.write('</body></html>');
      newWindow.document.close();
      newWindow.print();
  }

  });

       </script>
   </body>
   <br>
    </div>
  </x-app-layout>
