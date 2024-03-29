@extends('layouts.main')

@section('title', 'Create Buku')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Transaksi Pengembalian Buku</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('pengembalian.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Nama Anggota Yang Akan Mengembalikan Buku</label>
                                <select name="id_anggota" id="id_anggota" class="form-control select2" required>
                                    <option value="" selected disabled>--Pilih Anggota--</option>
                                    @foreach ($anggota as $item)
                                        <option value="{{ $item->id_anggota_peminjaman }}">{{ $item->nama }} |
                                            {{ $item->id }}</option>
                                    @endforeach
                                </select>
                                @error('id_anggota')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-success">
                                <b>
                                    Pengembalian Buku
                                </b>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">Nomor Isbn Buku</label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" id="id" class="form-control" name="id"
                                                required>
                                            <input type="text" id="isbn" class="form-control" name="isbn"
                                                placeholder="Ex : ISBN ***" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                                                    data-target="#modalBuku">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Judul Buku</label>
                                        <input type="text" readonly id="judul" class="form-control" name="judul">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Jumlah Buku</label>
                                        <input type="number" class="form-control" name="jumlah" id="jumlah" readonly>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="" style="visibility: hidden">Kode Peminjaman</label>
                                        <input type="hidden" class="form-control" name="id_peminjaman" id="id_peminjaman"
                                            readonly>
                                    </div>

                                    <div class="form-group col-md-3">
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

    <div class="modal fade bd-example-modal-sm" id="confirmasiAll" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Yakin Hapus Semua Data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-sm" name="hapusAllOk" id="hapusAllOk">Hapus</button>
                </div>
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
                            <th>Isbn</th>
                            <th>Judul</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah</th>
                            <th>Id Peminjaman</th>
                            <th>#</th>
                        </thead>
                        <tbody>
                            @foreach ($buku as $i => $data)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $data->no_isbn }}</td>
                                    <td>{{ $data->judul_buku }}</td>
                                    <td>{{ $data->tahun_terbit }}</td>
                                    <td>{{ $data->jumlah_buku }}</td>
                                    <td>{{ $data->id_peminjaman }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" id="pilih"
                                            data-id="{{ $data->id_buku_pinjam }}" data-isbn="{{ $data->no_isbn }}"
                                            data-judul="{{ $data->judul_buku }}"
                                            data-jumlah-buku="{{ $data->jumlah_buku }}"
                                            data-id-peminjaman="{{ $data->id_peminjaman }}">
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
                var item_id = $(this).data('id');
                var item_isbn = $(this).data('isbn');
                var item_judul = $(this).data('judul');
                var item_jumlah_buku = $(this).data('jumlah-buku');
                var item_id_peminjaman = $(this).data('id-peminjaman');
                $('#id').val(item_id);
                $('#isbn').val(item_isbn);
                $('#judul').val(item_judul);
                $('#jumlah').val(item_jumlah_buku);
                $('#id_peminjaman').val(item_id_peminjaman);
                $('#modalBuku').modal('hide');
            })
        });
    </script>
@endpush
