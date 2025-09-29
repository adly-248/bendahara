<x-app-layout>
    <div class="container mx-auto p-6">
        <h3 class="text-xl font-bold mb-4">Laporan Pengeluaran</h3>

        <!-- Form Filter -->
        <!-- Form Filter -->
        <form method="GET" action="{{ route('laporan.pengeluaran') }}" class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
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

                <!-- Tombol Filter -->
                <button type="submit" class="btn btn-primary w-full">Filter</button>

                <!-- Tombol Print PDF -->
                <a href="{{ route('laporan.pengeluaran.print', ['month' => request('month'), 'year' => request('year')]) }}"
                    target="_blank" class="btn btn-danger w-full">
                    Print PDF
                </a>
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
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->tanggal_pengeluaran }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $row->kategori)) }}</td>
                            <td>{{ $row->transaksi }}</td>
                            <td>{{ $row->keterangan ?? '-' }}</td> <!-- Tambahan -->
                            <td>Rp {{ number_format($row->jumlah_pengeluaran, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-app-layout>
