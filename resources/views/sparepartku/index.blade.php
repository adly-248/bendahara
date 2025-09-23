<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Sparepart') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <h2 class="mb-3">Daftar Sparepart</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ url('sparepartku/create') }}" class="btn btn-primary mb-3" style="float: right;">Tambah sparepart</a>

        <table id="slideTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Sparepart ID</th>
                    <th>Nama sparepart</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategory id</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sparepart as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->sparepart_id }}</td>
                    <td>{{ $row->nama_sparepart }}</td>
                    <td>{{ $row->harga }}</td>
                    <td>{{ $row->stok }}</td>
                    <td>{{ $row->kategori_id }}</td>
                    <td><img src="{{ asset('sparepart/' . $row->image) }}" alt="Gambar Sparepart" width="150"></td>
                    <td>
                        <a href="{{ url('sparepartku/'.$row->sparepart_id.'/edit') }}"
                            class="btn btn-warning btn-sm">Edit</a>

                        <form
                            action="{{ url('sparepartku/'.$row->sparepart_id) }}"
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
