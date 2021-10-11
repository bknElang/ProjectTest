<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\PerusahaanExport;
use Maatwebsite\Excel\Facades\Excel;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $perusahaan = DB::table('perusahaans')->get();

        return view('perusahaan', ['perusahaans' => $perusahaan]);
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
            'name' => 'required',
            'address' => 'required',
        ]);

        $perusahaan = Perusahaan::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('successOrder', 'Create Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        //
        return view('perusahaanDetail', ['perusahaan' => $perusahaan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        //
        Perusahaan::where('id', $perusahaan->id)
            ->update([
                'name' => $request->name,
                'address' => $request->address
            ]);

        return redirect()->back()->with('success', 'Data perusahaan telah di-Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        //
        Perusahaan::destroy($perusahaan->id);
        return redirect('/perusahaan')->with('successDelete', 'Perusahaan dihapus!');
    }

    public function export()
    {
        return Excel::download(new PerusahaanExport, 'Perusahaan.xlsx');
    }
}
