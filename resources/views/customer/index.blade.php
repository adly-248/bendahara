<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Customer') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <h2 class="mb-3">Daftar Customer</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ url('customer/create') }}" class="btn btn-primary mb-3" style="float: right;">Tambah Customer</a>

        <table id="slideTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Customer ID</th>
                    <th>Username</th>
                    <th>password</th>
                    <th>Nama customer</th>
                    <th>No telp</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customer as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->customer_id }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->password }}</td>
                    <td>{{ $row->nama_customer }}</td>
                    <td>{{ $row->no_telp }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        <a href="{{ url('customer/'.$row->customer_id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>

                       <form action="{{ url('customer', ['customer_id' => $row->customer_id, 'username' => $row->username]) }}" method="POST" style="display:inline;">
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
