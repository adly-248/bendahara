<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kendaraan') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <h2 class="mb-3">Daftar Kendaraan</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('kendaraan.create') }}" class="btn btn-primary mb-3" style="float: right;">Tambah Kendaraan</a>

        <table id="slideTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kendaraan ID</th>
                    <th>Customer ID</th>
                    <th>Jenis Kendaraan</th>
                    <th>Nomor Polisi</th>
                    <th>Merk</th>
                    <th>Tahun</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraan as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kendaraan_id }}</td>
                    <td>{{ $row->customer_id }}</td>
                    <td>{{ $row->jenis_kendaraan }}</td>
                    <td>{{ $row->nomor_polisi }}</td>
                    <td>{{ $row->merek }}</td>
                    <td>{{ $row->tahun }}</td>
                    <td><img src="{{ asset('kendaraan/' . $row->image) }}" alt="Gambar Sparepart" width="150"></td>
                    <td>
                        <a href="{{ url('kendaraan/'.$row->kendaraan_id.'/edit') }}"
                            class="btn btn-warning btn-sm">Edit</a>

                        <form
                            action="{{ url('kendaraan/'.$row->kendaraan_id) }}"
                            method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
