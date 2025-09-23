<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Customer') }}
      </h2>
    </x-slot>

    <div class="container">
      <br>
      <h2>Tambah Data Customer</h2>
      <br>
      <form action="{{ route('customer.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="customer_id" class="form-label">customer id</label>
          <input type="number" name="customer_id" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="nama_customer" class="form-label">Nama Customer</label>
          <input type="text" name="nama_customer" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="no_telp" class="form-label">No Telepon</label>
          <input type="text" name="no_telp" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </x-app-layout>
