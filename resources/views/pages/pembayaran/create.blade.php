@extends('layouts.main')

@section('title', 'Tambah Data Pembayaran Denda')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Transaksi Pembayaran Denda Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('pembayarandenda.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header bg-success">
                                <b>
                                    Pembayaran Denda
                                </b>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">Nama Anggota</label>
                                        <div class="input-group mb-3">
                                            <input type="text" id="nama" class="form-control" name="nama"
                                                required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                                    data-target="#modalBuku">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group col-md-3">
                                        <label for="" style="visibility: hidden">Id Anggota</label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" id="id_anggota" class="form-control" name="id_anggota"
                                                required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                                    data-target="#modalBuku">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group col-md-2">
                                        <label for="">Jumlah Pinjam</label>
                                        <input type="number" class="form-control" name="qty" id="qty" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Jumlah Hari Terlambat (Hari)</label>
                                        <input type="text" readonly id="jumlah_hari_terlambat" class="form-control"
                                            name="jumlah_hari_terlambat">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Jumlah Yang Harus Di Bayar</label>
                                        <input type="number" class="form-control" name="denda" id="denda" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Jumlah Pembayaran</label>
                                        <input type="number" class="form-control" name="jumlah_pembayaran"
                                            id="jumlah_pembayaran">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="" style="visibility: hidden">Id Anggota</label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" id="id_anggota" class="form-control" name="id_anggota"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="" style="visibility: hidden">Kode Pengembalian</label>
                                        <input type="hidden" class="form-control" name="id_pengembalian"
                                            id="id_pengembalian" readonly>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Aksi</label>
                                        <div class="input-group">

                                            <button type="submit" class="btn btn-primary" id="proses"><i
                                                    class="fas fa-save"></i>
                                                Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalBuku" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <th width="1%">No</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah Buku Pinjam</th>
                            <th>Jumlah Hari Terlambat</th>
                            <th>Denda</th>
                            <th>Kode Pengembalian</th>
                            <th>#</th>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $i => $data)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->jumlah_hari_terlambat }} Hari</td>
                                    <td>Rp. {{ number_format($data->denda, 0, '.', '.') }}</td>
                                    <td>{{ $data->id }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" id="pilih"
                                            data-id-anggota="{{ $data->id_anggota }}"
                                            data-nama-anggota="{{ $data->nama }}" data-qty="{{ $data->qty }}"
                                            data-jumlah-hari-terlambat="{{ $data->jumlah_hari_terlambat }}"
                                            data-denda="{{ $data->denda }}" data-id-pengembalian="{{ $data->id }}">
                                            <i class="fas fa-mouse-pointer"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#table').DataTable();
            $('#table-temp').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#pilih', function() {
                var item_id_anggota = $(this).data('id-anggota');
                var item_nama_anggota = $(this).data('nama-anggota');
                var item_qty = $(this).data('qty');
                var item_jumlah_hari_terlambat = $(this).data('jumlah-hari-terlambat');
                var item_denda = $(this).data('denda');
                var item_id_pengembalian = $(this).data('id-pengembalian');
                $('#id_anggota').val(item_id_anggota);
                $('#nama').val(item_nama_anggota);
                $('#qty').val(item_qty);
                $('#jumlah_hari_terlambat').val(item_jumlah_hari_terlambat);
                $('#denda').val(item_denda);
                $('#id_pengembalian').val(item_id_pengembalian);
                $('#modalBuku').modal('hide');
            })
        });
    </script>
@endpush
