<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Admin\AuthenticatesUsers;

class LoginController extends Controller
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
    /**
     * 用户登录
     *
     * @param Request $request
     * @return mixed
     * @author varro
     */
    public function login(Request $request)
    {
        if (empty($request->input())) {
            return view('home.Login.login');
        }

        $phone = $request->input('phone');
        $password = $request->input('password');

        if (empty($phone)) {
            return json_encode(['status' => 0, 'message' => '请输入手机号']);
        }

        //校验手机号码格式
        if (!preg_match('/^((13[0-9])|(17[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))[0-9]{8}$/', $phone)) {
            return json_encode(['status' => 0, 'message' => '手机号格式不正确']);
        }

        if (empty($password)) {
            return json_encode(['status' => 0, 'message' => '请输入密码']);
        }

        $userInfo = DB::table('user')->where('phone', $phone)->first();
        if (empty($userInfo)) {
            return json_encode(['status' => 0, 'message' => '手机号或密码不正确#1']);
        }
        if ($userInfo->password != md5($password.$userInfo->_token)) {
            return json_encode(['status' => 0, 'message' => '手机号或密码不正确#2']);
        }

        if ($userInfo->status != 1) {
            return json_encode(['status' => 0, 'message' => '该用户已冻结']);
        }

        $userData = [
            'user_id' => $userInfo->id,
            'username' => $userInfo->username,
            'phone' => $userInfo->phone
        ];
        Cookie::queue('user_id', $userInfo->id);
        Cookie::queue('username', $userInfo->username);
        Cookie::queue('phone', $userInfo->phone);
        session(['user_id'=>$userInfo->id]);
        session(['username'=>$userInfo->username]);
        session(['phone'=>$userInfo->phone]);
        return json_encode(['status' => 1, 'message' => '登录成功', 'data' => $userData]);
    }


    /**
     * 退出登录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login_out(Request $request){

        Cookie::queue('user_id', null, -1);
        Cookie::queue('username', null, -1);
        Cookie::queue('phone', null, -1);
        //引入前台忘记密码
        return view('home.Login.login');
    }

    public function logins(){
        //引入前台忘记密码
        return view('home.Login.login');
    }
    public function success(){
        //引入前台忘记密码
        return view('home.Login.success');
    }
}
