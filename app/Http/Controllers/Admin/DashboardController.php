<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $employee = Auth::guard('employee')->user();
        return view('admin.dashboard',[
            'admin' => $employee
        ]);
    }
}
