<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaksi = DB::table('transaksis')
            ->join('users', 'transaksis.user_id', '=', 'users.id')
            ->join('barangs', 'transaksis.barang_id', '=', 'barangs.id')
            ->join('perusahaans', 'transaksis.perusahaan_id', '=', 'perusahaans.id')
            ->select('transaksis.*', 'users.name AS uName', 'barangs.name AS bName', 'perusahaans.name AS pName')
            ->get();

        $barang = DB::table('barangs')->get();
        $perusahaan = DB::table('perusahaans')->get();

        return view('transaksi', ['transaksis' => $transaksi, 'barangs' => $barang, 'perusahaans' => $perusahaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'quantity' => 'required',
            'barang' => 'required',
            'perusahaan' => 'required',
        ]);

        $checkQtyBarang = DB::table('barangs')->where('barangs.id', '=', $request->barang)->first();

        if ($checkQtyBarang->qty < $request->quantity) {
            return redirect()->back()->with('failedOrder', 'Kuantitas tidak boleh melebihi stok!');
        }

        $transaksi = Transaksi::create([
            'user_id' => auth()->user()->id,
            'barang_id' => $request->barang,
            'qty' => $request->quantity,
            'perusahaan_id' => $request->perusahaan
        ]);

        Barang::where('id', $request->barang)
            ->update([
                'qty' => $checkQtyBarang->qty - $request->quantity
            ]);

        return redirect()->back()->with('successOrder', 'Create Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
        $transaksi = DB::table('transaksis')
            ->join('users', 'transaksis.user_id', '=', 'users.id')
            ->join('barangs', 'transaksis.barang_id', '=', 'barangs.id')
            ->join('perusahaans', 'transaksis.perusahaan_id', '=', 'perusahaans.id')
            ->select('transaksis.*', 'users.name AS uName', 'barangs.name AS bName', 'perusahaans.name AS pName')
            ->where('transaksis.id', '=', $transaksi->id)
            ->first();

        return view('transaksiDetail', ['transaksi' => $transaksi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
        Transaksi::destroy($transaksi->id);
        return redirect('/transaksi')->with('successDelete', 'Transaksi dihapus!');
    }

    public function export()
    {
        return Excel::download(new TransaksiExport, 'Transaksi.xlsx');
    }
}
