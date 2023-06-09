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
    <div class="container mt-3">
        <table>
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>
                    {{ date('d F Y') }}
                </td>
            </tr>
        </table>
    </div>
    <br>

    <div class="container">

        <table class="table table-bordered mb-4 table-striped">
            <tr>
                <th>No</th>
                <th style="text-align: center;">NISN</th>
                <th style="text-align: center;">Nama</th>
                <th style="text-align: center;">Jenis Kelamin</th>
                <th style="text-align: center;">Nohp</th>
                <th style="text-align: center;">Email</th>
                <th style="text-align: center;">Alamat</th>
            </tr>

            @foreach ($anggota as $no => $data)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $data->nisn }}</td>
                    <td>{{ $data->nama }}</td>
                    <td style="text-align: center;">{{ $data->jk == 'L' ? 'Laki - Laki' : 'Perempuan' }}</td>
                    <td style="text-align: center;">{{ $data->no_hp }}</td>
                    <td>{{ $data->email }}</td>
                    <td style="text-align: center;">{{ $data->alamat }}</td>
                </tr>
            @endforeach

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
