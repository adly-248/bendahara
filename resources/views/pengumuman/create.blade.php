<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pengumuman') }}
        </h2>
    </x-slot>

    <div class="container">
        <br>
        <h2>Tambah Data Pengumuman</h2>
        <br>
        <form action="{{ route('pengumuman.store') }}" method="POST">
            @csrf

             <div class="mb-3">
                <label for="id" class="form-label">User ID</label>
                <select class="form-select form-select-lg" name="id" id="id">
                    @foreach ($user as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi</label>
                <input type="text" name="isi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_buat" class="form-label">Tanggal Buat</label>
                <input type="date" name="tanggal_buat" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
