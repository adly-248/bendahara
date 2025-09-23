<x-app-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Customer') }}
      </h2>
    </x-slot>

    <div class="container">
      <h2>Edit Customer</h2>
    <br>
      <form action="{{ url('customer/' .$customer->customer_id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        {{ csrf_field() }}

        <div class="mb-3">
          <label for="customer_id" class="form-label">Customer id</label>
          <input type="text" name="customer_id" class="form-control" value="{{ $customer->customer_id }}" readonly>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="{{ $customer->username }}" readonly>
        </div>

        <div class="mb-3">
          <label for="nama_customer" class="form-label">Nama Customer</label>
          <input type="text" name="nama_customer" class="form-control" value="{{ $customer->nama_customer }}" required>
        </div>

        <div class="mb-3">
          <label for="no_telp" class="form-label">No. Telepon</label>
          <input type="text" name="no_telp" class="form-control" value="{{ $customer->no_telp }}" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" name="email" class="form-control" value="{{ $customer->email }}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" value="" required>
        </div>


        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url('kategory') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </x-app-layout>
