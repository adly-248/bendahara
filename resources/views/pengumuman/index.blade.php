<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Informasi') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <h2 class="mb-3">Daftar Informasi</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ url('pengumuman/create') }}" class="btn btn-primary mb-3" style="float: right;">Tambah Pengumuman</a>

        <table id="slideTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID Pengumuman</th>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengumuman as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->id_pengumuman }}</td>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->judul }}</td>
                    <td>{{ $row->isi }}</td>
                    <td>
                        <a href="{{ url('pengumuman/'.$row->id_pengumuman.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ url('pengumuman/'.$row->id_pengumuman) }}" method="POST" style="display:inline;">
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
