<?php

namespace App\Http\Controllers;

use App\Models\PembayaranDenda;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranDendaController extends Controller
{
    public function index()
    {
        $pembayaran = DB::table('pembayaran_dendas')
            ->join('anggotas', 'pembayaran_dendas.id_anggota', '=', 'anggotas.id')
            ->join('pengembalians', 'pengembalians.id', '=', 'pembayaran_dendas.id_pengembalian')
            ->select('pengembalians.*', 'anggotas.nama', 'pembayaran_dendas.*')
            ->get();


        return view('pages.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $anggota = DB::table('pengembalians')
            ->join('anggotas', 'pengembalians.id_anggota', '=', 'anggotas.id')
            ->join('books', 'pengembalians.id_buku', '=', 'books.id')
            ->select('pengembalians.*', 'anggotas.nama')
            ->where('pengembalians.denda', '!=', 0)
            ->get();

        return view('pages.pembayaran.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_anggota' => 'required',
            'id_pengembalian' => 'required',
            'qty' => 'required|numeric',
            'jumlah_hari_terlambat' => 'required|numeric',
            'denda' => 'required|numeric',
            'jumlah_pembayaran' => 'required|numeric',
        ]);

        if ($data['jumlah_pembayaran'] !== $data['denda']) {

            flash()->addError('Jumlah Pembayaran Harus Sama Dengan Jumlah Denda');
            return redirect(route('pembayarandenda.create'));
        }

        PembayaranDenda::create([
            'id_anggota' => $data['id_anggota'],
            'tanggal_pembayaran' => Carbon::now()->toDateString(),
            'id_pengembalian' => $data['id_pengembalian'],
            'jumlah_pembayaran' => $data['jumlah_pembayaran'],
        ]);

        // Update denda in pengembalians table
        $pengembalian = Pengembalian::findOrFail($data['id_pengembalian']);
        $pengembalian->update([
            'denda' => 0,
        ]);

        flash('Data Pembayaran Denda berhasil disimpan dan denda di Pengembalian berhasil diupdate');
        return redirect()->route('pembayarandenda.index');
    }
}
