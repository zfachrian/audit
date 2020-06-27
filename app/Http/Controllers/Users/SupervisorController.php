<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\JenisAudit;

class SupervisorController extends Controller
{
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auditor = user::where('role', 2)->get();
        $jmlAuditor = $auditor->count();
        $updateAuditor = $auditor['0'];

        $diaudit = user::where('role', 3)->get();
        $jmlDiaudit = $diaudit->count();
        $updateDiaudit = $diaudit['0'];

        $skema = JenisAudit::get();
        $jmlSkema = $skema->count();
        $updateSkema = $skema['0'];

        $title = 'Dashboard - Admin';
        return view('admin.dashboard', compact('title', 'jmlDiaudit', 'jmlAuditor', 'jmlSkema', 'updateSkema', 'updateDiaudit', 'updateAuditor'));
    }
}
