<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditorController extends Controller
{
    public function index()
    {
        $title = 'Dashboard - SO';
        return view('auditor.dashboard', compact('title'));
    }
}
