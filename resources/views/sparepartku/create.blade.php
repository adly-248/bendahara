<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Sparepart') }}
      </h2>
    </x-slot>

    <div class="container">
      <br>
      <h2>Tambah Data Sparepart</h2>
      <br>
      <form action="{{ url('/sparepartku') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="sparepart_id" class="form-label">Sparepart id</label>
          <input type="number" name="sparepart_id" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="nama_sparepart" class="form-label">Nama Sparepart</label>
          <input type="text" name="nama_sparepart" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="text" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="stok" class="form-label">Stok</label>
          <input type="text" name="stok" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="kategori_id" class="form-label">Kategori Sparepart</label>
          <select class="form-select form-select-lg" name="kategori_id" id="kategori_id">
            @foreach($kategory as $row)
              <option value="{{ $row->kategori_id }}">{{ $row->nama_kategori }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Gambar Sparepart</label>
          <input type="file" name="image" class="form-control" required>
        </div>
  <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('sparepartku.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </x-app-layout>
