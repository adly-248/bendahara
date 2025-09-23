<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kendaraan') }}
        </h2>
    </x-slot>

    <div class="container">
        <br>
        <h2>Tambah Kendaraan</h2>
        <br>
        <form action="{{ url('/kendaraan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="kendaraan_id" class="form-label">Kendaraan id</label>
                <input type="number" name="kendaraan_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer ID</label>
                <select class="form-select form-select-lg" name="customer_id" id="customer_id">
                    @foreach($customer as $row)
                        <option value="{{ $row->customer_id }}">{{ $row->username }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                <input type="text" name="jenis_kendaraan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                <input type="text" name="nomor_polisi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="merek" class="form-label">Merek</label>
                <input type="text" name="merek" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="text" name="tahun" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Sparepart</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
