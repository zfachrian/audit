<?php

namespace App\Http\Controllers;
use App\Model\Kategori;

use Illuminate\Http\Request;

class KategoriPTWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title  = "Data Kategori";
        $kategori = Kategori::where('jenis_id', '2')->get();
        $id_jenis = 2;
        return view('admin.kategori.indexPTW', compact('title', 'kategori', 'id_jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategoriSoal'              =>'required'
        ]);

        Kategori::create([
            'jenis_id'        => $request->id_jenis,
            'kategoriSoal'    => $request->kategoriSoal
        ]);

        return redirect('/KategoriPTW')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategoriSoal'              =>'required'
        ]);

        kategori::where('id', $id)->Update([
            'jenis_id'        => $request->id_jenis,
            'kategoriSoal'    => $request->kategoriSoal
        ]);

        return redirect('/KategoriPTW')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kategori::destroy($id);
        return redirect('/KategoriPTW')->with('danger', 'Data Berhasil Dihapus');
    }
}
