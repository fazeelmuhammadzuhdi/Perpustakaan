@extends('layouts.main')

@section('title', 'Data Pembayaran Denda')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pembayaran Denda</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="row justify-content-between">
                            @if (auth()->user()->role == 'admin')
                                <div class="col-md-auto">
                                    <a href="{{ route('pembayarandenda.create') }}" class="btn btn-warning"><i
                                            class="fas fa-plus-square">
                                            Tambah Data Pembayaran Denda</i>
                                    </a>
                                </div>
                            @endif
                            <div class="col-md-auto">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#filterModal">Laporan Pembayaran Denda</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Hari Terlambat</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Jumlah Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jumlah_hari_terlambat }} Hari</td>
                                            <td>{{ date('d F Y', strtotime($item->tanggal_pembayaran)) }}
                                            </td>
                                            <td>Rp. {{ number_format($item->jumlah_pembayaran, 0, '.', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.laporan.modal_laporan_pembayaran_denda')

@endsection
@push('after-script')

    @if (session('success') == true)
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.tableDetailPengembalian').DataTable();
        });
    </script>
@endpush
