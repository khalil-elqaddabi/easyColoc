<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'userCount'     => User::count(),
            'activeUsers'    => User::whereNull('banned_at')->whereNotNull('email_verified_at')->count(),
            'colocCount' => Colocation::count(),
            'totalExpenses'  => Expense::count(),
            'totalPayments' => Payment::count(),
        ]);
    }
}
