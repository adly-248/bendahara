<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Kategory') }}
      </h2>
    </x-slot>

    <div class="container">
      <br>
      <h2>Tambah Data Kategory</h2>
      <br>
      <form action="{{ route('kategory.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="nama_kategori" class="form-label">Nama Kategori</label>
          <input type="text" name="nama_kategori" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="dibuat_oleh" class="form-label">Dibuat Oleh</label>
          <select name="dibuat_oleh" class="form-control" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kategory.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </x-app-layout>

