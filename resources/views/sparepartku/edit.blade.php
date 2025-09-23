<x-app-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Sparepart') }}
      </h2>
    </x-slot>

    <div class="container">
      <h2>Edit Sparepart</h2>
      <br>
      <form action="{{ url('sparepartku/' .$sparepart->sparepart_id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        {{ csrf_field() }}

        <div class="mb-3">
          <label for="sparepart_id" class="form-label">Sparepart id</label>
          <input type="text" name="sparepart_id" class="form-control" value="{{ $sparepart->sparepart_id }}" readonly>
        </div>



        <div class="mb-3">
          <label for="nama_sparepart" class="form-label">Nama Sparepart</label>
          <input type="text" name="nama_sparepart" class="form-control" value="{{ $sparepart->nama_sparepart }}">
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="text" name="harga" class="form-control" value="{{ $sparepart->harga }}" required>
        </div>

        <div class="mb-3">
          <label for="stok" class="form-label">Stok</label>
          <input type="text" name="stok" class="form-control" value="{{ $sparepart->stok }}" required>
        </div>


        <div class="mb-3">
          <label for="kategori_id" class="form-label">Kategori Sparepart</label>
          <select class="form-select form-select-lg" name="kategori_id" id="kategori_id">
            <option value="{{ $sparepart->kategori_id }}">{{ $sparepart->kategori_id }}</option>
            @foreach($kategory as $row)
            <option value="{{ $row->kategori_id }}">{{ $row->nama_kategori }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Gambar Sparepart</label>
          <!-- Tampilkan gambar hanya jika ada -->
          @if ($sparepart->image)
          <img src="{{ asset('sparepart/' . $sparepart->image) }}" alt="Gambar Sparepart" width="150" class="mb-2">
          @endif
          <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url('sparepartku') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </x-app-layout>
