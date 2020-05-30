<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "User Admin";
        $role = 1;
        $data = User::where('role', 1)->get();
        // $path   = explode("/",$request->path());
        return view('admin.users.index', compact('title', 'data', 'role'));
    }

    public function auditor()
    {
        $title = "User auditor";
        $role = 2;
        $data = User::where('role', 2)->get();
        // $path   = explode("/",$request->path());
        return view('admin.users.index', compact('title', 'data', 'role'));
    }
    
    public function kontraktor()
    {
        $title = "User Kontraktor";
        $role = 3;
        $data = User::where('role', 3)->get();
        // $path   = explode("/",$request->path());
        return view('admin.users.index', compact('title', 'data', 'role'));
    }
    public function manajer()
    {
        $title = "User Manajer";
        $role = 4;
        $data = User::where('role', 4)->get();
        // $path   = explode("/",$request->path());
        return view('admin.users.index', compact('title', 'data', 'role'));
    }
    public function supervisor()
    {
        $title = "User Supervisor";
        $role = 5;
        $data = User::where('role', 5)->get();
        // $path   = explode("/",$request->path());
        return view('admin.users.index', compact('title', 'data', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $role)
    {
        $title = "Tambah User Auditor";
        return view('admin.users.tambah', compact('title', 'role'));
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
            'name_auditor'          =>'required',
            'telephone_auditor'     =>'required',
            'email_auditor'         =>'required|email',
            'password'              =>'required|confirmed|min:6',
        ]);

        User::create([
                'name'          => $request->name_auditor,
                'phone'         => $request->telephone_auditor,
                'state'         => $request->state_auditor,
                'email'         => $request->email_auditor,
                'company_name'  => $request->company_auditor,
                'password'      => $request->password,
                'role'          => $request->role_auditor
        ]);

        return redirect('/user')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = "User Auditor Edit";
        return view('admin.users.edit', compact('title','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name_auditor'=>'required',
            'telephone_auditor'=>'required',
            'email_auditor'=>'required',
            'password'              =>'required|confirmed|min:6'
        ]);

        User::where('id', $request->id)->Update([
                'name'          => $request->name_auditor,
                'phone'         => $request->telephone_auditor,
                'state'         => $request->state_auditor,
                'email'         => $request->email_auditor,
                'company_name'  => $request->company_auditor,
                'password'      => $request->password,
                'role'          => $request->role_auditor
        ]);

        return redirect('/user')->with('success', 'Data updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/user')->with('danger', 'Data Berhasil Dihapus');
    }
}
