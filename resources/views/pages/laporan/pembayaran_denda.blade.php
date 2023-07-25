<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>{{ $title }}</title>
</head>

<body>
    @include('pages.laporan.header_laporan')
    <div class="container">
        <table>
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>
                    {{ date('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>Laporan Periode</td>
                <td>:</td>
                {{-- {{ $tglAwal }} - {{ $tglAkhir }} --}}
                <td style="text-align: center;">{{ strftime('%d %B %Y', strtotime($tglAwal)) }}</td>
                <td style="text-align: center;">&nbsp;- &nbsp;</td>
                <td style="text-align: center;">{{ strftime('%d %B %Y', strtotime($tglAkhir)) }}</td>
            </tr>
        </table>
    </div>
    <br>

    <div class="container">

        <table class="table table-bordered mb-4 table-striped">
            <tr>
                <th>No</th>
                <th style="text-align: center;">Nama Anggota</th>
                <th style="text-align: center;">Kelas</th>
                <th style="text-align: center;">Tanggal Pengmbalian Buku</th>
                <th style="text-align: center;">Jumlah Hari Terlambat</th>
                <th style="text-align: center;">Tanggal Pembayaran Denda</th>
                <th style="width: 15%;">Jumlah Pembayaran</th>
            </tr>

            @foreach ($laporanPembayaran as $laporan)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">{{ $laporan->nama }}</td>
                    <td style="text-align: center;">{{ $laporan->kelas }}</td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($laporan->tanggal_pengembalian)) }}</td>
                    <td style="text-align: center;">{{ $laporan->jumlah_hari_terlambat }} Hari</td>
                    <td style="text-align: center;">{{ date('d F Y', strtotime($laporan->tanggal_pembayaran)) }}</td>
                    <td style="text-align: left;">Rp. {{ number_format($laporan->jumlah_pembayaran, '2', ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: center;"><strong>Total Jumlah Pembayaran Denda :</strong></td>
                <td style="text-align: left;"><strong>Rp.
                        {{ number_format($laporanPembayaran->sum('jumlah_pembayaran'), 2, ',', '.') }}</strong></td>
            </tr>


        </table>

        <br>
        <br>

        <div class="float-end text-center" style="padding: 1cm;padding-top:0%">
            <!-- <h6 class="text-center" style="margin-bottom: 2cm;">{{ date('d F Y') }}</h6> -->
            <span>Kepala Pustaka</span><br><br><br><br>
            <span>( ..................................... )</span><br>

        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
