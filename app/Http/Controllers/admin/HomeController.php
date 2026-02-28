<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
     public function dashboard()
    {
        $userCount   = user::count();
        

        return view('admin.dashboard', compact('userCount'));
    }
}
