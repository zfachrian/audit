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
use Illuminate\Support\Facades\DB;

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

        // echo json_encode($diaudit);die();
        return view('admin.audit.index', compact('title', 'data', 'diaudit'));
    }

    public function audit($id)
    {
        $title = "Audit - List Kategori Audit";
        $data = Audit::find($id);
        // dd($data);

        $kategori = KategoriNilai::select('*', 'soal.id as kat_id')
                                ->join('kategori_soal as soal', 'kategori_nilai.kategori_id', '=', 'soal.id')
                                ->join('jenis_audit as jenis', 'soal.jenis_id', '=', 'jenis.id')
                                ->where('audit_id', '=', $id)
                                ->get();

        if(count($kategori) < 1){
        //    echo "kosong";
           $kategori = kategori::select('*', 'kategori_soal.id as kat_id')
                                ->JOIN('jenis_audit as jenis', 'kategori_soal.jenis_id', '=', 'jenis.id')
                                ->where('kategori_soal.jenis_id', '=', $data->jenis_id)
                                ->get();
        }else{
            $kategori = kategori::select('*', 'kategori_soal.id as kat_id')
                            ->LEFTJOIN('jenis_audit as jenis', 'kategori_soal.jenis_id', '=', 'jenis.id')
                            ->where('kategori_soal.jenis_id', '=', $data->jenis_id, 'AND', 'kategori_nilai.audit_id', '=', $id)
                            ->get();
        }
        // $kon = Kategori::where('jenis_id', $id)->get();
        // dd($kategori);

        $data_kategori_collection = array();
        $i = 0;
        foreach ($kategori as $item){
            $kategori_soal_id = $item->kat_id;
            $kategori_soal = $item->kategoriSoal;
            $data_kategori_collection[$i]['id'] = $kategori_soal_id;
            $data_kategori_collection[$i]['soal'] = $kategori_soal;

            $kategori_nilai = DB::table('kategori_nilai')
                            ->where('audit_id', '=', $id)
                            ->where('kategori_id', '=', $kategori_soal_id)
                            ->get();

            $data_kategori_collection[$i]['total_diperiksa'] = 0;
            $data_kategori_collection[$i]['total_tdksesuai'] = 0;
            $data_kategori_collection[$i]['total_persentase'] = 0;
            if(sizeof($kategori_nilai) != 0){
                $data_kategori_collection[$i]['total_diperiksa'] = $kategori_nilai[0]->total_diperiksa;
                $data_kategori_collection[$i]['total_tdksesuai'] = $kategori_nilai[0]->total_tdksesuai;
                $data_kategori_collection[$i]['total_persentase'] = $kategori_nilai[0]->total_persentase;
            }

            $i++;
        }

        // dd($data_kategori_collection);

        return view('admin.audit.sumary', compact('title', 'data', 'data_kategori_collection', 'id'));
    }

    public function soal($kategori, $audit_id)
    {
        $title = "Audit";
        $data = Kategori::find($kategori);
        // dd($data);
        $soal = soal::select('*', 'soal.id as id_soal')
                      ->where('kategori_id', '=', $kategori )
                      ->get();
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
        // $soal = Soal::select('*', 'soal.id as id_soal', 'nilai.keterangan as ket', 'nilai.id as id_nilai')
        $soal = Soal::select('*', 'soal.id as id_soal')
                    ->join('kategori_soal as kategori', 'soal.kategori_id', '=', 'kategori.id')
                    ->where('soal.kategori_id', '=', $kategori, 'AND', 'kategori.audit_id', '=', $audit_id)
                    ->get();
        // dd($totalPersen);

        $data_soal_collection = array();
        $i = 0;
        foreach ($soal as $item){
            $soal_id = $item->id_soal;
            $soal = $item->topik;
            $data_soal_collection[$i]['id_soal'] = $soal_id;
            $data_soal_collection[$i]['soal'] = $soal;

            $soal_nilai = DB::table('soal_nilai')
                            ->where('audit_id', '=', $audit_id)
                            ->where('soal_id', '=', $soal_id)
                            ->get();

                    // dd($soal_nilai);
            $data_soal_collection[$i]['diperiksa'] = 0;
            $data_soal_collection[$i]['tdksesuai'] = 0;
            $data_soal_collection[$i]['persentase'] = 0;
            if(sizeof($soal_nilai) != 0){
                $data_soal_collection[$i]['id_nilai'] = $soal_nilai[0]->id;
                $data_soal_collection[$i]['diperiksa'] = $soal_nilai[0]->diperiksa;
                $data_soal_collection[$i]['tdksesuai'] = $soal_nilai[0]->tdksesuai;
                $data_soal_collection[$i]['persentase'] = $soal_nilai[0]->persentase;
                $data_soal_collection[$i]['keterangan'] = $soal_nilai[0]->keterangan;
            }

            $i++;
        }
        // dd($data_soal_collection);

        $url = request()->segment(count(request()->segments()));
        return view('admin.audit.soalEdit', compact('title', 'data', 'data_soal_collection', 'kategori', 'audit_id', 'totalPersen', 'url'));
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
        $totalPersen = $total_persen;
        // dd($total_persen);


        KategoriNilai::create([
            'audit_id'          => $audit_id,
            'kategori_id'       => $soal,
            'total_diperiksa'   => $total_diperiksa,
            'total_tdksesuai'   => $total_tdksesuai,
            'total_persentase'  => $totalPersen
        ]);

        return redirect('/AuditSumary/'.$audit_id)->with('success', 'Data berhasil ditambahkan!');
    }

    public function storeEditSoal($soal, $katNilai, Request $request)
    {
        // dd($soal);
        // $jsoal = Soal::where('kategori_id', $katNilai)->get();
        $item = [];
        // dd($jsoal);
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
            // echo json_encode($request->all()["tdksesuai"]);die();

        $i=1;
        foreach($item2 as $item){
            SoalNilai::where('id', $item3[$i])
                       ->update($item2[$i]);
            // echo $i;
            $i++;
        }
        // die();
        // SoalNilai::where('id', $request->soal_id)->Update([$item]);
        $audit_id = ($item1[1]['audit_id']);
        $total_diperiksa = array_sum($request->all()["diperiksa"]);
        $total_tdksesuai = array_sum($request->all()["tdksesuai"]);
        $total_persen = (array_sum($request->all()["persentase"])/(count($request->all()["persentase"])));
        // dd($audit_id);


        kategoriNilai::where('id', '=', $katNilai)
                       ->Update([
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

    public function updateStatusManajer(Request $request, Audit $audit)
    {
        audit::where('id', $audit->id)->Update([
                'manajer'          => $request->manajer
        ]);

        return redirect('/audit')->with('success', 'Data berhasil diupdate!');
    }

    public function updateStatusSupervisor(Request $request, Audit $audit)
    {
        audit::where('id', $audit->id)->Update([
                'supervisor'          => $request->supervisor
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
