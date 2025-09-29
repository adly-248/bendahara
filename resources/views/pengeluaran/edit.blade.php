<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pengeluaran') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger custom-card mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="custom-card bg-white">
            <h2 class="h4 fw-semibold mb-4">Edit Pengeluaran</h2>

            <form action="{{ url('pengeluaran/' . $pengeluaran->id_pengeluaran) }}" method="post"
                enctype="multipart/form-data">
                @method('put')
                {{ csrf_field() }}

                <!-- ID Pengeluaran -->
                <div class="mb-3">
                    <label for="id_pengeluaran" class="form-label">Pengeluaran ID</label>
                    <input type="text" name="id_pengeluaran" class="form-control"
                        value="{{ $pengeluaran->id_pengeluaran }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="jumlah_pengeluaran" class="form-label">Jumlah Pengeluaran</label>

                    <!-- input tampilan -->
                    <input type="text" id="jumlah_pengeluaran" class="form-control"
                        value="{{ 'Rp ' . number_format($pengeluaran->jumlah_pengeluaran, 0, ',', '.') }}" required>

                    <!-- input hidden untuk angka asli -->
                    <input type="hidden" name="jumlah_pengeluaran" id="jumlah_pengeluaran_hidden"
                        value="{{ $pengeluaran->jumlah_pengeluaran }}">
                </div>

                <!-- Tanggal Pengeluaran -->
                <div class="mb-3">
                    <label for="tanggal_pengeluaran" class="form-label">Tanggal Pengeluaran</label>
                    <input type="date" name="tanggal_pengeluaran" class="form-control"
                        value="{{ $pengeluaran->tanggal_pengeluaran }}" required>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="ATK" {{ $pengeluaran->kategori == 'ATK' ? 'selected' : '' }}>ATK</option>
                        <option value="Listrik_Air" {{ $pengeluaran->kategori == 'Listrik_Air' ? 'selected' : '' }}>
                            Listrik & Air</option>
                        <option value="Kegiatan_Siswa"
                            {{ $pengeluaran->kategori == 'Kegiatan_Siswa' ? 'selected' : '' }}>Kegiatan Siswa</option>
                        <option value="Gaji_Guru_Staff"
                            {{ $pengeluaran->kategori == 'Gaji_Guru_Staff' ? 'selected' : '' }}>Gaji Guru & Staff
                        </option>
                        <option value="Perawatan_Fasilitas"
                            {{ $pengeluaran->kategori == 'Perawatan_Fasilitas' ? 'selected' : '' }}>Perawatan Fasilitas
                        </option>
                        <option value="Konsumsi" {{ $pengeluaran->kategori == 'Konsumsi' ? 'selected' : '' }}>Konsumsi
                        </option>
                        <option value="Transportasi" {{ $pengeluaran->kategori == 'Transportasi' ? 'selected' : '' }}>
                            Transportasi</option>
                        <option value="Lainnya" {{ $pengeluaran->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="transaksi" class="form-label">Transaksi</label>
                    <select name="transaksi" id="transaksi" class="form-control" required>
                        <option value="">-- Pilih Transaksi --</option>
                        <option value="Tunai" {{ $pengeluaran->transaksi == 'Tunai' ? 'selected' : '' }}>Tunai
                        </option>
                        <option value="Transfer" {{ $pengeluaran->transaksi == 'Transfer' ? 'selected' : '' }}>Transfer
                        </option>
                    </select>
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ $pengeluaran->keterangan }}"
                        required>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                    <input type="file" name="image" class="form-control">

                    @if ($pengeluaran->bukti_pembayaran)
                        <div class="mt-2">
                            <small>Bukti lama:</small><br>
                            <img src="{{ asset('bukti_pembayaran/' . $pengeluaran->bukti_pembayaran) }}"
                                alt="Bukti Pembayaran" width="150">
                        </div>
                    @endif
                </div>


                <!-- Tombol -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('pengeluaran') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const inputRupiah = document.getElementById("jumlah_pengeluaran");
        const inputHidden = document.getElementById("jumlah_pengeluaran_hidden");

        // Format ulang pas user ketik
        inputRupiah.addEventListener("input", function() {
            let angka = this.value.replace(/[^,\d]/g, "");
            inputHidden.value = angka; // simpan angka mentah
            this.value = formatRupiah(angka, "Rp ");
        });

        // Fungsi format Rupiah
        function formatRupiah(angka, prefix) {
            let number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
            return prefix ? prefix + rupiah : rupiah;
        }
    </script>

</x-app-layout>

<style>
    /* Card styling */
    .custom-card {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
    }

    /* Form label styling */
    .custom-card label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    /* Input styling */
    .custom-card .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
    }

    .custom-card .form-control:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        border-color: #3b82f6;
    }

    /* Button styling */
    .custom-card .btn-primary {
        background-color: #3b82f6;
        border: none;
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
        border-radius: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .custom-card .btn-primary:hover {
        background-color: #2563eb;
    }

    .custom-card .btn-secondary {
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
        border-radius: 0.5rem;
    }
</style>
