<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $statusTindakan = '0';
        }else{
            $statusTindakan = '1';
        }
        // dd($kategori);
        
        $data_tindakan_collection = array();
        $i = 0;
        foreach ($kategori as $item){
            $audit_id = $id;
            $kategori_id = $item->kat_id;
            $kategoriSoal = $item->kategoriSoal;
            $data_tindakan_collection[$i]['audit_id'] = $audit_id;
            $data_tindakan_collection[$i]['kategori_id'] = $kategori_id;
            $data_tindakan_collection[$i]['kategoriSoal'] = $kategoriSoal;

            $data = DB::table('tindakan')
                            ->select('*', 'id as tindakan_id')
                            ->where('audit_id', '=', $id)
                            ->get();
            // dd($data);
            $data_tindakan_collection[$i]['tindakan_id']   = "";
            $data_tindakan_collection[$i]['what']   = "";
            $data_tindakan_collection[$i]['action'] = "";
            $data_tindakan_collection[$i]['who']    = "";
            $data_tindakan_collection[$i]['when']   = "";
            if(sizeof($data) != 0){
                $data_tindakan_collection[$i]['tindakan_id'] = $data[$i]->tindakan_id;
                $data_tindakan_collection[$i]['what'] = $data[$i]->what;
                $data_tindakan_collection[$i]['action'] = $data[$i]->action;
                $data_tindakan_collection[$i]['who'] = $data[$i]->who;
                $data_tindakan_collection[$i]['when'] = $data[$i]->when;
            }

            $i++;
        }

        // dd($data_tindakan_collection);
        return view('admin.audit.tindakan', compact('title', 'kategori', 'audit', 'data_tindakan_collection', 'statusTindakan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo 'store';
        // dd($request->all());
        // die();

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $tindakan_id  = [];
        $item1 = [];
        $item2 = [];
        foreach($request->all() as $field => $data) { // $field is field name
            // dump($data);
            if (is_array($data) || is_object($data))
            {
                foreach($data as $key => $value) { // $key is item key
                    $item[$key][$field] = $value;
                    if($field == 'audit_id'){
                        $item1[$key][$field] = $value;
                    }elseif($field == 'kategori_id') {
                        $item1[$key][$field] = $value;
                    }elseif($field == 'tindakan_id') {
                        $tindakan_id[$key][$field] = $value;
                    }else{
                        $item2[$key][$field] = $value;
                    }
                }
            }
        }
        // dd($item2);
        $i=1;
        foreach($item1 as $item){
            tindakan::where('id', $tindakan_id[$i])
                       ->update($item2[$i]);
            // echo $i;
            $i++;
        }
        $audit_id = $item1[1]['audit_id'];
        return redirect('/AuditTindakan/'.$audit_id)->with('success', 'Data berhasil diupdate!');
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
