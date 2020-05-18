<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KontraktorController extends Controller
{
    public function index()
    {
        $title = 'Dashboard - Kontraktor';
        return view('kontraktor.dashboard', compact('title'));
    }
}
