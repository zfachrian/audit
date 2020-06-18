<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Audit;
use App\Model\JenisAudit;
use App\Model\Kategori;
use App\Model\Soal;
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
        $kategori = kategori::where('jenis_id',$data->jenis_id )->get();
        return view('admin.audit.sumary', compact('title', 'data', 'kategori'));
    }

    public function soal($kategori)
    {
        $title = "Audit";
        $data = Kategori::find($kategori);
        $soal = Soal::where('kategori_id', $kategori)->get();
        // dd($soal);
        return view('admin.audit.soal', compact('title', 'data', 'soal', 'kategori'));
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
        // dd($soal);
        // dd($request->all());
        // echo json_encode($request);die();
        $jsoal = Soal::where('kategori_id', $soal)->get();
        $i=0;
        foreach($jsoal as $item){
            // $request->validate([
            //     'kategori_id'               =>'required'
            // ]);

            $diperiksa  = "diperiksa".$i;
            $tdksesuai  = "tdksesuai".$i;
            $persen     = "persen".$i;
            $keterangan  = "keterangan".$i;

            soal::create([
                'total_diperiksa'   => $request->$diperiksa,
                'total_tdksesuai'   => $request->$tdksesuai,
                'persentase'        => $request->$persen,
                'keterangan'        => $request->$keterangan
            ]);

        }
        $i++;
        return redirect('/AuditSumary')->with('success', 'Data berhasil ditambahkan!');
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

        return redirect('/AuditSumary')->with('success', 'Data berhasil ditambahkan!');
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
