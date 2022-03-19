<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
    public function  showUserName(){
        return 'Amjad Alhakimi';
    }

    public function getIndex(){
//        $data=[];
//        $data['id']=6;
//        $data['name'] = 'Amjad Adel Alhakimi';
//        return view('welcome',$data);

        $obj = new \stdClass();

        $obj -> name = 'Amjad Adel Alhakimi';
        $obj -> id =7;
        $obj -> gender = 'male';

        $data=['Amjad','Adel'];
        return view('welcome', compact('data'));

        return view('welcome', compact('obj'));
    }

    public function  getindexes(){
        return view ('landing');
    }
}
