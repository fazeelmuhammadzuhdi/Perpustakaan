<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    public function index()
    {
        // $data['pengembalian'] = DB::table('pengembalians')
        //     ->join('anggotas', 'pengembalians.id_anggota', '=', 'anggotas.id')
        //     ->join('detail_peminjaman', 'pengembalians.id_buku', '=', 'detail_peminjaman.id')
        //     ->select('pengembalians.*', 'anggotas.*', 'detail_peminjaman.*')
        //     ->get();
        // $peminjaman = DB::table('peminjaman')->get();

        // $pengembalian = DB::table('pengembalians')
        //     ->join('anggotas', 'pengembalians.id_anggota', '=', 'anggotas.id')
        //     ->join('books', 'pengembalians.id_buku', '=', 'books.id')
        //     ->join('pembayaran_dendas', 'pengembalians.id', '=', 'pembayaran_dendas.id_pengembalian')
        //     ->select('pengembalians.*', 'anggotas.*', 'books.*', 'pembayaran_dendas.jumlah_pembayaran')
        //     // ->select('pengembalians.*', 'anggotas.*', 'books.*')
        //     ->orderBy('tanggal_pengembalian', 'asc')
        //     ->get();

        $pengembalian = DB::table('pengembalians')
            ->join('anggotas', 'pengembalians.id_anggota', '=', 'anggotas.id')
            ->join('books', 'pengembalians.id_buku', '=', 'books.id')
            ->leftJoin('pembayaran_dendas', 'pengembalians.id', '=', 'pembayaran_dendas.id_pengembalian')
            ->select(
                'pengembalians.*',
                'anggotas.*',
                'books.*',
                'pembayaran_dendas.jumlah_pembayaran'
            )
            ->orderBy('tanggal_pengembalian', 'asc')
            ->get();

        return view('pages.pengembalian.index', compact('pengembalian'));
    }

    public function tambah()
    {
        //ambil data anggota yang berelasi ke table peminjaman lalu tampilkan data anggota

        //mengambil data anggota yang berelasi ke table detail peminjaman lalu tampilkan berdasarkan status
        //get data detail peminjaman
        $detaiLPeminjaman = DB::table('detail_peminjaman')->get();
        $peminjaman = DB::table('peminjaman')->get();

        //menampilkan data anggota yang meminjam buku dan jika statusnya 0 maka tampilkan data anggota tersebut

        // $anggota = DB::table('peminjaman')
        //     ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
        //     ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
        //     ->selectRaw('peminjaman.*', 'anggotas.nama', 'detail_peminjaman.id_peminjaman', 'detail_peminjaman.status')
        //     ->groupBy('anggotas.nama')
        //     ->where('detail_peminjaman.status', 0)
        //     ->get();

        $anggota = DB::table('peminjaman')
            ->join('anggotas', 'peminjaman.id_anggota_peminjaman', '=', 'anggotas.id')
            ->join('detail_peminjaman', 'peminjaman.id', '=', 'detail_peminjaman.id_peminjaman')
            ->select('peminjaman.id', 'peminjaman.id_anggota_peminjaman', 'anggotas.nama', 'detail_peminjaman.status')
            ->where('detail_peminjaman.status', 0)
            ->groupBy('anggotas.nama', 'peminjaman.id', 'peminjaman.id_anggota_peminjaman', 'detail_peminjaman.status')
            ->get();


        // dd($anggota);

        // $anggota = DB::table('anggotas')
        //     ->join('peminjaman', 'anggotas.id', '=', 'peminjaman.id_anggota_peminjaman')
        //     // ->where('peminjaman.id', $detaiLPeminjaman->id_peminjaman)
        //     ->get();

        //selanjutnya menampilkan data buku yang dipinjam oleh anggota yang dipilih
        $buku = DB::table('books')
            ->join('detail_peminjaman', 'books.id', '=', 'detail_peminjaman.id_buku_pinjam')
            ->where('detail_peminjaman.status', 0)
            ->select('books.*', 'detail_peminjaman.*')
            // ->where('detail_peminjaman.id_peminjaman', $peminjaman->first()->id)
            ->get();

        // $buku = DB::table('books')->get();

        return view('pages.pengembalian.create', compact('anggota', 'buku', 'detaiLPeminjaman', 'peminjaman'));
    }

    // public function store(Request $r)
    // {
    //     $validator = Validator::make($r->all(), [
    //         'id_anggota' => 'required',
    //         'id' => 'required',
    //         'jumlah' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('tambah-pengembalian')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     //mencari denda berdasarkan keterlamabatan pengambalian buku masing masing anggota
    //     $selectedMemberId = $r->id_anggota;

    //     $peminjaman = DB::table('peminjaman')
    //         ->where('id_anggota_peminjaman', $selectedMemberId)
    //         ->get();

    //     foreach ($peminjaman as $p) {
    //         $idPeminjaman = $p->id;
    //         $tanggalWajibKembali = $p->tgl_kembali;
    //         $tanggalPengembalian = Carbon::now()->toDateString();
    //         $jumlahHariTerlambat = Carbon::parse($tanggalWajibKembali)->diffInDays($tanggalPengembalian);

    //         $denda = 0;

    //         if ($tanggalPengembalian >= $tanggalWajibKembali) {
    //             $denda = $r->jumlah * $jumlahHariTerlambat * 1000;
    //         } else {
    //             $denda = 0;
    //             $jumlahHariTerlambat = 0;
    //         }

    //         $getDataIdPeminjaman = $r->id_peminjaman;
    //         $getDataIdInTablePeminjaman = $p->id;

    //         if ($getDataIdPeminjaman == $getDataIdInTablePeminjaman) {
    //             $simpan = DB::table('pengembalians')->insert([
    //                 // $simpan = DB::table('pengembalians')->where('id_anggota', $p->id_anggota_peminjaman)->insert([
    //                 'id_anggota' => $r->id_anggota,
    //                 'id_buku' => $r->id,
    //                 'qty' => $r->jumlah,
    //                 'denda' => $denda,
    //                 'jumlah_hari_terlambat' => $jumlahHariTerlambat,
    //                 'tanggal_pengembalian' => $tanggalPengembalian,
    //             ]);
    //         }
    //     }

    //     if ($simpan == true) {
    //         $updateStatus = DB::table('detail_peminjaman')->where('id_peminjaman', $r->id_peminjaman)->where('id_buku_pinjam', $r->id)->update([
    //             'status' => 1,
    //         ]);

    //         $stok = DB::table('books')->where('id', $r->id)->update([
    //             "jumlah_buku" => DB::raw('jumlah_buku + ' . $r->jumlah),
    //         ]);
    //         return redirect(route('pengembalian'))->with('success', 'Succsess');
    //     } else {
    //         return redirect(route('pengembalian'))->with('error', 'Gagal');
    //     }
    // }

    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id_anggota' => 'required',
            'id' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('tambah-pengembalian')
                ->withErrors($validator)
                ->withInput();
        }

        // Inisialisasi variabel $simpan di luar lingkup loop foreach
        $simpan = false;

        //mencari denda berdasarkan keterlamabatan pengambalian buku masing masing anggota
        $selectedMemberId = $r->id_anggota;

        $peminjaman = DB::table('peminjaman')
            ->where('id_anggota_peminjaman', $selectedMemberId)
            ->get();

        foreach ($peminjaman as $p) {
            $idPeminjaman = $p->id;
            $tanggalWajibKembali = $p->tgl_kembali;
            $tanggalPengembalian = Carbon::now()->toDateString();
            $jumlahHariTerlambat = Carbon::parse($tanggalWajibKembali)->diffInDays($tanggalPengembalian);

            $denda = 0;

            if ($tanggalPengembalian >= $tanggalWajibKembali) {
                $denda = $r->jumlah * $jumlahHariTerlambat * 1000;
            } else {
                $denda = 0;
                $jumlahHariTerlambat = 0;
            }

            $getDataIdPeminjaman = $r->id_peminjaman;
            $getDataIdInTablePeminjaman = $p->id;

            if ($getDataIdPeminjaman == $getDataIdInTablePeminjaman) {
                $simpan = true; // Ubah nilai $simpan menjadi true jika data berhasil disimpan

                $simpan = DB::table('pengembalians')->insert([
                    'id_anggota' => $r->id_anggota,
                    'id_buku' => $r->id,
                    'qty' => $r->jumlah,
                    'denda' => $denda,
                    'jumlah_hari_terlambat' => $jumlahHariTerlambat,
                    'tanggal_pengembalian' => $tanggalPengembalian,
                ]);
            }
        }

        if ($simpan == true) {
            $updateStatus = DB::table('detail_peminjaman')->where('id_peminjaman', $r->id_peminjaman)->where('id_buku_pinjam', $r->id)->update([
                'status' => 1,
            ]);

            $stok = DB::table('books')->where('id', $r->id)->update([
                "jumlah_buku" => DB::raw('jumlah_buku + ' . $r->jumlah),
            ]);
            return redirect(route('pengembalian'))->with('success', 'Success');
        } else {
            return redirect(route('pengembalian.create'))->with('error', 'Anggota Tidak meminjam buku ini');
        }
    }
}
