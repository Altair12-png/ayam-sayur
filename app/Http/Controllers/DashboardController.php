<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
     
        $nama = Auth::User()->name;

        return view('#', compact('nama'));
    }
}
