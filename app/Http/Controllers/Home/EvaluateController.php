<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class EvaluateController extends Controller
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
    //前台登录
    public function evaluate(){

       //echo 123;

       //引入前台登录页面
       return view('home.Evaluate.evaluate');    
    }


    public function get_evaluate_info(Request $request){
        $data = $request->all();
        $good_id = Crypt::decrypt($data['goodsId_lock']);
        $evaluate_info = DB::table('evaluate')
            ->where('evaluate.good_id', '=', $good_id)
            ->get()
            ->toArray();
        foreach ($evaluate_info as &$v){
            $res = DB::table('user')
                ->where('id', '=', $v->user_id)
                ->first();
            $v->username = $res->username;
            $v->headimg = $res->headimg;
        }
        return json_encode(['code'=>200,'data'=>$evaluate_info]);
    }
}
