<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    //后台首页
    public function index(){
       //引入后台首页页面
       return view('admin.index');
    }
    public function welcome(){
        //引入后台默认显示页面
       return view('admin.welcome');  

    }
}
