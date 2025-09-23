<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan - SMKN 13 Bandung</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #111;
        }

        h1,
        h2,
        h3 {
            margin: 0 0 8px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 12px;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .text-center {
            text-align: center;
        }

        .muted {
            color: #666;
        }

        .row {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .col {
            display: table-cell;
            vertical-align: top;
            padding: 8px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px 8px;
        }

        th {
            background: #f2f2f2;
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .small {
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="mb-4">
        <div class="title">Data Laporan SMKN 13 Bandung</div>
        <div class="subtitle">
            Periode: {{ str_pad((int) $month, 2, '0', STR_PAD_LEFT) }}/{{ $year }}
            {{-- &nbsp;|&nbsp; Kategori: {{ $kategori ? str_replace('_', ' ', $kategori) : 'Semua' }}
            &nbsp;|&nbsp; Transaksi: {{ $transaksi ?: 'Semua' }} --}}
        </div>
    </div>

    {{-- <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="small muted">Total Pemasukan</div>
                <div style="font-size:16px; font-weight:700;">
                    Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="small muted">Total Pengeluaran</div>
                <div style="font-size:16px; font-weight:700;">
                    Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="small muted">Saldo Akhir</div>
                <div style="font-size:16px; font-weight:700;">
                    Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div> --}}

    {{-- (Opsional) Ringkasan bulanan di tahun terkait --}}
    @if (($monthlyData ?? collect())->count() || ($monthlyPengeluaran ?? collect())->count())
        <h3 class="mb-2">Ringkasan per Bulan (Tahun {{ $year }})</h3>
        <table class="mb-4">
            <thead>
                <tr>
                    <th style="width: 120px;">Bulan</th>
                    <th class="right">Total Pemasukan</th>
                    <th class="right">Total Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalIn = 0;
                    $totalOut = 0;
                @endphp

                @for ($m = 1; $m <= 12; $m++)
                    @php
                        $in = isset($monthlyData[$m]) ? $monthlyData[$m] : 0;
                        $out = isset($monthlyPengeluaran[$m]) ? $monthlyPengeluaran[$m] : 0;
                        $totalIn += $in;
                        $totalOut += $out;
                    @endphp
                    <tr>
                        <td>{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="right">Rp {{ number_format($in, 0, ',', '.') }}</td>
                        <td class="right">Rp {{ number_format($out, 0, ',', '.') }}</td>
                    </tr>
                @endfor

                {{-- Tambahan baris total --}}
                <tr>
                    <th>Total 1 Tahun</th>
                    <th class="right">Rp {{ number_format($totalIn, 0, ',', '.') }}</th>
                    <th class="right">Rp {{ number_format($totalOut, 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
    @endif

    <div class="small muted">
        Dicetak pada: {{ $generatedAt->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
    </div>

</body>

</html>
