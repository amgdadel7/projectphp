<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class CustomAuthController extends Controller
{

    public function adualt()
    {
        return view('customAuth.index');
    }

    public function site()
    {
        return view('site');

    }

    public function admin()
    {
        return view('admin');
    }
    public function adminLogin(){
        return view('auth.adminLogin');
    }
    public function checkAdminLogin(){
        return view('');
    }
}
