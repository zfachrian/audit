<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Audit;
use App\Model\JenisAudit;
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

        $diaudit  = Audit::select('name')
                ->join('users as a', 'audit.diaudit', '=', 'a.id')
                ->get();

        $auditor  = Audit::select('name')
                ->join('users as a', 'audit.auditor', '=', 'a.id')
                ->get();
    
        // echo json_encode($auditor);die();
        return view('admin.audit.index', compact('title', 'data', 'diaudit', 'auditor'));
    }

    public function audit()
    {
        $title = "Audit";
        // $data = Audit::get();
        return view('admin.audit.sumary', compact('title'));
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
            'jadwal'              =>'required'
        ]);

        audit::create([
                'jenis_id'        => $request->jenis,
                'diaudit'         => $request->diaudit,
                'lingkup_audit'   => $request->lingkup,
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
        // $data = Audit::get();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit)
    {
        //
    }
}
