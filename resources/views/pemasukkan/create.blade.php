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


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemasukkan') }}
        </h2>
    </x-slot>

    <div class="container custom-card">
        <br>
        <h2>Tambah Data Pemasukkan</h2>
        <br>
        <form action="{{ route('pemasukkan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="jumlah_pemasukkan" class="form-label">Jumlah Pemasukkan</label>
                <input type="text" name="jumlah_pemasukkan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_pemasukkan" class="form-label">Tanggal Pemasukkan</label>
                <input type="date" name="tanggal_pemasukkan" class="form-control" required>
            </div>

            {{-- <div class="mb-3">
                <label for="sumber" class="form-label">Sumber</label>
                <input type="text" name="sumber" class="form-control" required>
            </div> --}}

            <div class="mb-3">
                <label for="transaksi" class="form-label">Transaksi</label>
                <select name="transaksi" id="transaksi" class="form-control" required>
                    <option value="">-- Pilih Transaksi --</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="dana_bos_kinerja">Dana Bos Kinerja</option>
                    <option value="dana_bos_prestasi">Dana Bos Prestasi</option>
                    <option value="sumbangan_orang_tua">Sumbangan Orang Tua</option>
                    <option value="komite_sekolah">Komite Sekolah</option>
                </select>
            </div>

            {{-- <div class="mb-3">
                <label for="keterangan" class="form-label pt-89">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" required>
            </div> --}}

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pemasukkan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    {{-- Format Rupiah --}}
    {{-- <script>
    const inputRupiah = document.getElementById("jumlah_pemasukkan");

    inputRupiah.addEventListener("keyup", function(e) {
        inputRupiah.value = formatRupiah(this.value, "Rp ");
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
</script> --}}
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
