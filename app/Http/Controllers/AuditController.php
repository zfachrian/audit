<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Audit;
use App\Model\JenisAudit;
use App\Model\Kategori;
use App\Model\Soal;
use App\Model\SoalNilai;
use App\Model\KategoriNilai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title  = "Data Audit";
        $data   = Audit::get();
        // echo json_encode($data);die();

        $diaudit  = Audit::select('audit.*', 'a.name as diaudit', 'a2.name as auditor', 'b.jenis_audit as jenis_audit'  )
                ->join('users as a', 'audit.diaudit', '=', 'a.id')
                ->join('users as a2', 'audit.auditor', '=', 'a2.id')
                ->join('jenis_audit as b', 'audit.jenis_id', '=', 'b.id')
                ->get();

        // $auditor  = Audit::select('name')
        //         ->join('users as a', 'audit.auditor', '=', 'a.id')
        //         ->get();

        // echo json_encode($diaudit);die();
        return view('admin.audit.index', compact('title', 'data', 'diaudit'));
    }

    public function audit($id)
    {
        $title = "Audit - List Kategori Audit";
        $data = Audit::find($id);
        // dd($data);
        $kategori = kategori::select('*', 'kategori_soal.id as kat_id')
                    ->LEFTJOIN('kategori_nilai as nilai', 'nilai.kategori_id', '=', 'kategori_soal.id')
                    ->where('kategori_soal.jenis_id', '=', $data->jenis_id, 'AND', 'nilai.audit_id', '=', $id)
                    ->get();
        // dd($kategori);
        return view('admin.audit.sumary', compact('title', 'data', 'kategori', 'id'));
    }

    public function soal($kategori, $audit_id)
    {
        $title = "Audit";
        $data = Kategori::find($kategori);
        $soal = soal::where('kategori_id',$kategori )->get();
        // dd($soal);
        $url = request()->segment(count(request()->segments()));
        return view('admin.audit.soal', compact('title', 'data', 'soal', 'kategori', 'audit_id', 'url'));
    }

    public function editSoal($kategori, $audit_id)
    {
        $title = "Audit";
        $data = Kategori::find($kategori);
        $totalPersen = KategoriNilai::where('kategori_id', '=', $kategori, 'AND', 'audit_id', '=', $audit_id )->get();
        $totalPersen = $totalPersen[0];
        $soal = Soal::select('*', 'soal.id as id_soal', 'nilai.keterangan as ket', 'nilai.id as id_nilai')
                    ->join('soal_nilai as nilai', 'nilai.soal_id', '=', 'soal.id')
                    ->join('kategori_nilai as a', 'a.kategori_id', '=', 'soal.kategori_id')
                    ->where('soal.kategori_id', '=', $kategori, 'AND', 'a.audit_id', '=', $audit_id)
                    ->get();
        // dd($soal);
        $url = request()->segment(count(request()->segments()));
        return view('admin.audit.soal', compact('title', 'data', 'soal', 'kategori', 'audit_id', 'totalPersen', 'url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Data Audit";
        $user = User::where('role', 3)->get();
        $data = JenisAudit::get();
        // $data = Audit::get();
        return view('admin.audit.tambah', compact('title', 'user', 'data'));
    }

public function storeSoal($soal, Request $request)
    {
        $jsoal = Soal::where('kategori_id', $soal)->get();
        $item = [];
        foreach($request->all() as $field => $data) { // $field is field name
            // dump($data);
            if (is_array($data) || is_object($data))
            {
                foreach($data as $key => $value) { // $key is item key
                    $item[$key][$field] = $value; 
                }
            }
        }
        // dd($item);
        SoalNilai::insert($item);

        $audit_id = ($item[1]['audit_id']);
        $total_diperiksa = array_sum($request->all()["diperiksa"]); 
        $total_tdksesuai = array_sum($request->all()["tdksesuai"]);
        $total_persen = (array_sum($request->all()["persentase"])/(count($request->all()["persentase"])));
        // dd($total_persen);        


        KategoriNilai::create([
            'audit_id'          => $audit_id,
            'kategori_id'       => $soal,
            'total_diperiksa'   => $total_diperiksa,
            'total_tdksesuai'   => $total_tdksesuai,
            'total_persentase'  => $total_persen
            // 'keterangan'        => $request->$keterangan
        ]);

        return redirect('/AuditSumary/'.$audit_id)->with('success', 'Data berhasil ditambahkan!');
    }

    public function storeEditSoal($katNilai, $soal, Request $request)
    {
        $jsoal = Soal::where('kategori_id', $katNilai)->get();
        $item = [];
        // dd($request->id_nilai);
        $item1 = [];
        $item2 = [];
        $item3 = [];
        foreach($request->all() as $field => $data) { // $field is field name
            // dump($data);
            if (is_array($data) || is_object($data))
            {
                foreach($data as $key => $value) { // $key is item key
                    $item[$key][$field] = $value; 
                    if($field == 'audit_id'){
                        $item1[$key][$field] = $value;
                    }elseif($field == 'soal_id') {
                        $item1[$key][$field] = $value;
                    }elseif($field == 'id_nilai') {
                        $item3[$key][$field] = $value;
                    }else{
                        $item2[$key][$field] = $value;
                    }
                }
            }
        }

            // $param = $item2;
            // echo json_encode($param);die();
        
        $i=1;
        foreach($jsoal as $item){
            // $param = $item1[$i];
            // $val = $item2[$i];
            // echo json_encode($update);die();
            // SoalNilai::updateOrInsert($param, $val);
            SoalNilai::where('id', $item3[$i])
                       ->update($item2[$i]);
        }
        $i++;
        die();
        // SoalNilai::where('id', $request->soal_id)->Update([$item]);
        $audit_id = ($item[1]['audit_id']);
        $total_diperiksa = array_sum($request->all()["diperiksa"]); 
        $total_tdksesuai = array_sum($request->all()["tdksesuai"]);
        $total_persen = (array_sum($request->all()["persentase"])/(count($request->all()["persentase"])));
        // dd($total_persen);        


        kategoriNilai::where('id', $katNilai)->Update([
            'audit_id'          => $audit_id,
            'kategori_id'       => $soal,
            'total_diperiksa'   => $total_diperiksa,
            'total_tdksesuai'   => $total_tdksesuai,
            'total_persentase'  => $total_persen
            // 'keterangan'        => $request->$keterangan
        ]);

        return redirect('/AuditSumary/'.$audit_id)->with('success', 'Data berhasil ditambahkan!');
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
        // echo json_encode($request);die();
        $request->validate([
            'jenis'               =>'required',
            'diaudit'             =>'required',
            'lingkup'             =>'required',
            'jenis_usaha'         =>'required',
            'tujuan'              =>'required',
            'jadwal'              =>'required'
        ]);

        audit::create([
            'jenis_id'        => $request->jenis,
            'diaudit'         => $request->diaudit,
            'lingkup_audit'   => $request->lingkup,
            'jenis_usaha'     => $request->jenis_usaha,
            'tujuan'          => $request->tujuan,
            'auditor'         => $request->auditor,
            'jadwal'          => $request->jadwal
        ]);

        return redirect('/audit')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function show(Audit $audit)
    {
        $title = "Audit";
        $data = Audit::get();
        return view('admin.audit.soal', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function edit(Audit $audit)
     {
        // echo json_encode($audit);die();
        $title = "Edit Data Audit";
        $user = User::where('role', 3)->get();
        $data = JenisAudit::get();
        // $data = Audit::get();
        return view('admin.audit.edit', compact('title', 'user', 'data', 'audit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audit $audit)
    {
        // dd($audit->id);
          $request->validate([
            'jenis'               =>'required',
            'diaudit'             =>'required',
            'lingkup'             =>'required',
            'jenis_usaha'         =>'required',
            'tujuan'              =>'required',
            'jadwal'              =>'required'
        ]);

        audit::where('id', $audit->id)->Update([
                'jenis_id'        => $request->jenis,
                'diaudit'         => $request->diaudit,
                'lingkup_audit'   => $request->lingkup,
                'jenis_usaha'     => $request->jenis_usaha,
                'tujuan'          => $request->tujuan,
                'auditor'         => $request->auditor,
                'jadwal'          => $request->jadwal
        ]);

        return redirect('/audit')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit)
    {
        audit::destroy($audit->id);
        return redirect('/audit')->with('danger', 'Data Berhasil Dihapus');
    }
}
