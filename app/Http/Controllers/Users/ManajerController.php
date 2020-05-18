<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManajerController extends Controller
{
    public function index(){
        $title = 'Dashboard - Manajer';
        return view('manajer.dashboard', compact('title'));
    }
}
