<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemasukkan') }}
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
            <h2 class="h4 fw-semibold mb-4">Edit Pemasukkan</h2>

            <form action="{{ url('pemasukkan/' . $pemasukkan->id_pemasukkan) }}" method="post"
                enctype="multipart/form-data">
                @method('put')
                {{ csrf_field() }}

                <!-- ID -->
                <div class="mb-3">
                    <label for="id_pemasukkan" class="form-label">Pemasukkan ID</label>
                    <input type="text" name="id_pemasukkan" class="form-control"
                        value="{{ $pemasukkan->id_pemasukkan }}" readonly>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah_pemasukkan" class="form-label">Jumlah Pemasukkan</label>
                    <input type="text" name="jumlah_pemasukkan" class="form-control"
                        value="{{ $pemasukkan->jumlah_pemasukkan }}" required>
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label for="tanggal_pemasukkan" class="form-label">Tanggal Pemasukkan</label>
                    <input type="date" name="tanggal_pemasukkan" class="form-control"
                        value="{{ $pemasukkan->tanggal_pemasukkan }}" required>
                </div>

                {{-- <!-- Sumber -->
                <div class="mb-3">
                    <label for="sumber" class="form-label">Sumber</label>
                    <input type="text" name="sumber" class="form-control" value="{{ $pemasukkan->sumber }}"
                        required>
                </div> --}}

                {{-- Transaksi --}}
                <div class="mb-3">
                    <label for="transaksi" class="form-label">Transaksi</label><br>
                    <select name="transaksi" class="border rounded px-3 py-2" style="width: 200px">
                        <option value="">-- Semua Transaksi --</option>
                        <option value="Tunai" {{ $pemasukkan->transaksi == 'Tunai' ? 'selected' : '' }}>Tunai
                        </option>
                        <option value="Transfer" {{ $pemasukkan->transaksi == 'Transfer' ? 'selected' : '' }}>Transfer
                        </option>
                    </select>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="dana_bos_kinerja"
                            {{ $pemasukkan->kategori == 'dana_bos_kinerja' ? 'selected' : '' }}>Dana Bos Kinerja
                        </option>
                        <option value="dana_bos_prestasi"
                            {{ $pemasukkan->kategori == 'dana_bos_prestasi' ? 'selected' : '' }}>Dana Bos Prestasi
                        </option>
                        <option value="sumbangan_orang_tua"
                            {{ $pemasukkan->kategori == 'sumbangan_orang_tua' ? 'selected' : '' }}>Sumbangan Orang Tua
                        </option>
                        <option value="komite_sekolah"
                            {{ $pemasukkan->kategori == 'komite_sekolah' ? 'selected' : '' }}>Komite Sekolah
                        </option>
                    </select>
                </div>

                {{-- <!-- Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ $pemasukkan->keterangan }}"
                        required>
                </div> --}}

                <!-- Tombol -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('pemasukkan') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const inputRupiah = document.querySelector('[name="jumlah_pemasukkan"]');

        inputRupiah.addEventListener("input", function() {
            let angka = this.value.replace(/[^,\d]/g, "").toString();
            this.value = formatRupiah(angka, "Rp ");
        });

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
            return prefix === undefined ? rupiah : rupiah ? prefix + rupiah : "";
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
