<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tindakan;
use App\Model\Audit;
use App\Model\Kategori;

class AuditTindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $title = "Data Tindakan";
        $audit = Audit::find($id);
        $kategori = kategori::select('*', 'kategori_soal.id as kat_id')
                            ->JOIN('jenis_audit as jenis', 'kategori_soal.jenis_id', '=', 'jenis.id')
                            ->where('kategori_soal.jenis_id', '=', $audit->jenis_id)
                            ->get();
        $tindakan = tindakan::where('audit_id', '=', $id)->get();
        
        $statusTindakan = '';
        if(sizeof($tindakan) == 0){
            $statusTindakan = 'false';
        }else{
            $statusTindakan = 'true';
        }
        
        // dd($statusTindakan);
        return view('admin.audit.tindakan', compact('title', 'kategori', 'audit', 'statusTindakan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $audit_id = $request->audit_id['1'];
        $item  = [];
        $item1 = [];
        $item2 = [];
        foreach($request->all() as $field => $data) { // $field is field name
            // dump($data);
            if (is_array($data) || is_object($data))
            {
                foreach($data as $key => $value) { // $key is item key
                    $item[$key][$field] = $value;
                    // if($field == 'audit_id'){
                    //     $item1[$key][$field] = $value;
                    // }elseif($field == 'kategori_id') {
                    //     $item1[$key][$field] = $value;
                    // }else{
                    //     $item2[$key][$field] = $value;
                    // }
                }
            }
        }

        tindakan::insert($item);

        return redirect('/AuditTindakan/'.$audit_id)->with('success', 'Data berhasil ditambahkan!');
        // $val = [$item1,$item2];
        // $item = [];
        // $j = 1;
        // $i = 1;
        // foreach($val as $data){
        //     // $data;
        //     // echo $j;
        //     $item = [$val['0'][$j],$val['1'][$i]];
             
        //     $j++;
        //     $i++;
        // }
        // dd($item);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
