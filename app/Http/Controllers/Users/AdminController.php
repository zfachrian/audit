<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

}
