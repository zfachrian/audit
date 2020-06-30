<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kategori;
use App\Model\Soal;

class SoalPTWController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo "create";
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
            'soal'            =>'required'
        ]);

        soal::create([
            'kategori_id'     => $request->kategori_id,
            'topik'           => $request->soal
        ]);

        $kategori_id = $request->kategori_id;
        $link = "/SoalPTW/";
        $url = $link.$kategori_id;
        return redirect($url)->with('success', 'Data Berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title  = "Data Soal";
        $kategori = Kategori::get();
        $kategori_id = $id;
        $soal = soal::where('kategori_id', $id)->get();

        return view('admin.soal.indexPTW', compact('title', 'kategori', 'soal', 'kategori_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        echo "edit";
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
            'soal'            =>'required'
        ]);

        soal::where('id', $id)->Update([
            'kategori_id'     => $request->kategori_id,
            'topik'           => $request->soal
        ]);

        $kategori_id = $request->kategori_id;
        $link = "/SoalPTW/";
        $url = $link.$kategori_id;
        return redirect($url)->with('success', 'Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //link
        $kategori = soal::where('id', $id)->get();
        $kategori_id = $kategori['0']['kategori_id'];
        $link = "/SoalPTW/";
        $url = $link.$kategori_id;
        //delete
        Soal::destroy($id);
        // dd($url);
        return redirect($url)->with('danger', 'Data Berhasil Dihapus');
    }
}
