<x-app-layout>

    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Pengumuman') }}
      </h2>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
      <h2>Edit Pengumuman</h2>
      <form action="{{ url('pengumuman/' .$pengumuman->id_pengumuman) }}" method="post" enctype="multipart/form-data">
        @method('put')
        {{ csrf_field() }}

        <div class="mb-3">
          <label for="id_pengumuman" class="form-label">Pengumuman ID</label>
          <input type="text" name="id_pengumuman" class="form-control" value="{{ $pengumuman->id_pengumuman }}" readonly>
        </div>

        <div class="mb-3">
                <label for="id" class="form-label">User</label>
                <select class="form-select form-select-lg" name="id" id="id">
                    @foreach($user as $row)
                        <option value="{{ $row->id }}" {{ $pengumuman->id_user == $row->id ? 'selected' : '' }}>
                            {{ $row->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <input type="text" name="judul" class="form-control" value="{{ $pengumuman->judul }}" required>
        </div>

        <div class="mb-3">
          <label for="isi" class="form-label">Isi</label>
          <input type="text" name="isi" class="form-control" value="{{ $pengumuman->isi }}" required>
        </div>

        <div class="mb-3">
          <label for="tanggal_buat" class="form-label">Tanggal Buat</label>
          <input type="date" name="tanggal_dibuat" class="form-control" value="{{ $pengumuman->tanggal_dibuat }}" required>
        </div>


        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url('pengumuman') }}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </x-app-layout>
