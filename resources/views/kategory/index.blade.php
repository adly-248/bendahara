<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kategory') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <h2 class="mb-3">Daftar Kategory</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ url('kategory/create') }}" class="btn btn-primary mb-3" style="float: right;">Tambah Kategory</a>

        <table id="slideTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kategory ID</th>
                    <th>Nama kategory</th>
                    <th>Dibuat Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategory as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->id_kategori }}</td>
                    <td>{{ $row->nama_kategori }}</td>
                    <td>{{ $row->dibuat_oleh }}</td>
                    <td>
                        <a href="{{ url('kategory/'.$row->id_kategori.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ url('kategory/'.$row->id_kategori) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
