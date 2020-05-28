<?php

namespace App\Http\Controllers\Users\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard - Admin';
        return view('admin.dashboard', compact('title'));
    }

    public function UserAuditor(Request $request)
    {
        $title = "User Auditor";
        $data = User::get();
        // $path   = explode("/",$request->path());
        return view('admin.users.auditor.index', compact('title', 'data'));
    }

    public function edit(Request $request, User $user)
    {
        $title = "User Auditor";
        return view('admin.users.auditor.edit', compact('title', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'id'                    => 'required',
            'name_auditor'          => 'required',
            'state_auditor'         => 'required',
            'email_auditor'         => 'email',
            'telephone_auditor'     => 'numeric'
        ]);
    }

}
