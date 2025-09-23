<x-app-layout>
    <div class="container mx-auto p-6">
        <h3 class="text-xl font-bold mb-4">Laporan Pemasukkan</h3>

        <!-- Form Filter -->
        <form method="GET" action="{{ route('laporan.pemasukkan') }}" class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filter Bulan -->
                <select name="month" class="form-control">
                    <option value="">-- Pilih Bulan --</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>

                <!-- Filter Tahun -->
                <select name="year" class="form-control">
                    <option value="">-- Pilih Tahun --</option>
                    @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>

                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table table-bordered w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Transaksi</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->tanggal_pemasukkan }}</td>
                            <td>{{ $row->kategori }}</td>
                            <td>{{ $row->transaksi }}</td>
                            <td>Rp {{ number_format($row->jumlah_pemasukkan, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>
