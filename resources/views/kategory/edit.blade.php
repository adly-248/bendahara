<x-app-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Kategory') }}
      </h2>
    </x-slot>

    <div class="container">
      <h2>Edit Kendaraan</h2>
      <form action="{{ url('kategory/' .$kategory->id_kategori) }}" method="post" enctype="multipart/form-data">
        @method('put')
        {{ csrf_field() }}

        <div class="mb-3">
          <label for="id_kategori" class="form-label">Kategory ID</label>
          <input type="text" name="id_kategori" class="form-control" value="{{ $kategory->id_kategori }}" readonly>
        </div>


        <div class="mb-3">
          <label for="nama_kategori" class="form-label">Nama kategory</label>
          <input type="text" name="nama_kategori" class="form-control" value="{{ $kategory->nama_kategori }}" required>
        </div>

        <div class="mb-3">
          <label for="dibuat_oleh" class="form-label">Dibuat Oleh</label>
          <select name="dibuat_oleh" class="form-control" required>
            <option value="{{ $kategory->dibuat_oleh }}"></option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url('kategory') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </x-app-layout>
