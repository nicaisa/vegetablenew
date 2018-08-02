<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class RegController extends Controller
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
     * 用户注册
     *
     * @param Request $request
     * @return view
     * @author varro
     */
    public function index(Request $request)
    {
        if (empty($request->input())) {
            //引入前台登录页面
            return view('home.Reg.register');
        }
        $phone = $request->input('phone');
        $password = $request->input('password');
        $smsCode = $request->input('code');

        if (empty($phone)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入手机号']);
        }

        if (empty($password)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入密码']);
        }

        if (empty($smsCode)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入验证码']);
        }

        $userInfo = DB::table('user')->where('phone', $phone)->first();
        if (!empty($userInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '该手机号已被注册']);
        }

        $smsInfo = DB::table('sms_code')->where('phone', $phone)->first();
        if (empty($smsInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '验证码错误, 请重新发送验证码#1']);
        }

        if ($smsInfo->code != $smsCode) {
            $this->jsonReturn(['status' => 0, 'message' => '验证码错误, 请重新发送验证码#2']);
        }

        $insertParams = [
            'username' => 'FVHEART会员',
            'password' => md5($password.$smsCode),
            'phone' => $phone,
            '_token' => $smsCode,
            'headimg' => 'headimg.jpg',
            'status' => 1
        ];

        $userId = DB::table('user')->insertGetId($insertParams);
        $insertParams_userinfo = [
            'user_id' => $userId,
            'creat_time' => time()
        ];

        $user_infoId = DB::table('user_info')->insert($insertParams_userinfo);
        if (!$userId || !$user_infoId) {
            $this->jsonReturn(['status' => 0, 'message' => '注册失败, 请稍后重试']);
        }

        $userData = [
            'user_id' => $userId,
            'username' => $insertParams['username'],
            'phone' => $insertParams['phone'],
        ];
        Cookie::queue('user_id', $userId);
        Cookie::queue('username', $insertParams['username']);
        Cookie::queue('phone', $insertParams['phone']);
        session(['user_id' => $userId]);
        session(['username' => $insertParams['username']]);
        session(['phone' => $insertParams['phone']]);

        $this->jsonReturn(['status' => 1, 'message' => '注册成功', 'data' => $userData]);
    }
    /**
     * 忘记密码
     *
     */
    public function forget()
    {
        return view('home.Login.forgetPassword');
    }


    /**
     * 查询用户是否存在
     * @param Request $request
     */
    public function authenticate(Request $request)
    {
        $phone = $request->input('phone');
        if (empty($phone)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入手机号']);
        }
        $userInfo = DB::table('user')->where('phone', $phone)->first();
        if (empty($userInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '用户不存在, 请重新输入手机号']);
        }else{
            $this->jsonReturn(['status' => 1, 'message' => '用户存在']);
        }
    }

    /**
     * 找回密码页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function authenticateShow(){
        return view('home.Login.authenticate');
    }


    public function reset(Request $request){
        $phone = $request->input('phone');
        $smsCode = $request->input('code');

        if (empty($phone)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入手机号']);
        }

        if (empty($smsCode)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入验证码']);
        }

        $smsInfo = DB::table('sms_code')->where('phone', $phone)->first();
        if (empty($smsInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '验证码错误, 请重新发送验证码#1']);
        }

        if ($smsInfo->code != $smsCode) {
            $this->jsonReturn(['status' => 0, 'message' => '验证码错误, 请重新发送验证码#2']);
        }
    }
    public function resetShow(){
        return view('home.Login.resetPassword');
    }



    public function resetSuccess(Request $request){
        $phone = $request->input('phone');
        $password = $request->input('new_password');
        $user = DB::table('user')->where('phone', $phone)->first();
        $smsInfo = DB::table('sms_code')->where('phone', $phone)->first();
        if (DB::table('user')->where('id', $user->id)->update(['password' => md5($password.$smsInfo->code), '_token' => $smsInfo->code])) {
            $this->jsonReturn(['status' => 1, 'message' => '密码修改成功, 请重新登录']);
        } else {
            $this->jsonReturn(['status' => 0, 'message' => '密码修改失败']);
        }
    }
    public function resetSuccessShow(){
        return view('home.Login.success');
    }
    /**
     * 忘记密码一个页面
     *
     * @param Request $request
     * @author varro
     */
    public function forget1(Request $request)
    {
        $phone = $request->input('phone');
        $password = $request->input('new_password');
        $smsCode = $request->input('code');

        if (empty($phone)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入手机号']);
        }

        if (empty($password)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入新密码']);
        }

        if (empty($smsCode)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入验证码']);
        }

        $userInfo = DB::table('user')->where('phone', $phone)->first();
        if (empty($userInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '用户不存在, 请重新输入手机号']);
        }

        $smsInfo = DB::table('sms_code')->where('phone', $phone)->first();
        if (empty($smsInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '验证码错误, 请重新发送验证码#1']);
        }

        if ($smsInfo->code != $smsCode) {
            $this->jsonReturn(['status' => 0, 'message' => '验证码错误, 请重新发送验证码#2']);
        }

        if (DB::table('user')->where('id', $userInfo->id)->update(['password' => md5($password.$smsInfo->code), '_token' => $smsInfo->code])) {
            $this->jsonReturn(['status' => 1, 'message' => '密码修改成功, 请重新登录']);
        }
    }

    /**
     * 发送验证码
     *
     * @param Request $request
     * @author varro
     */
    public function send(Request $request)
    {
        $time = time();
        $sms_code = rand(1000, 9999);
        $phone = $request->input('phone');

        if (empty($phone)) {
            $this->jsonReturn(['status' => 0, 'message' => '请输入手机号']);
        }

        //校验手机号码格式
        if (!preg_match('/^((13[0-9])|(17[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))[0-9]{8}$/', $phone)) {
            $this->jsonReturn(['status' => 0, 'message' => '手机号格式不正确']);
        }

        $smsInfo = DB::table('sms_code')->where('phone', $phone)->first();
        if (empty($smsInfo)) {
            if (!$this->sendSms($phone, $sms_code)) {
                $this->jsonReturn(['status' => 0, 'message' => '短信发送失败, 请稍后重试']);
            }

            DB::table('sms_code')->insert(['phone' => $phone, 'code' => $sms_code, 'create_time' => $time]);
            $this->jsonReturn(['status' => 1, 'message' => '发送成功']);
        }

        $sec = $time - $smsInfo->create_time;
        if ($sec <= 60) {
            $this->jsonReturn(['status' => 0, 'message' => '请在' . (60 - $sec) . '秒后重新发送']);
        }

        if (!$this->sendSms($phone, $sms_code)) {
            $this->jsonReturn(['status' => 0, 'message' => '短信发送失败, 请稍后重试']);
        }

        DB::table('sms_code')->where('phone', $phone)->update(['code' => $sms_code, 'create_time' => $time]);
        $this->jsonReturn(['status' => 1, 'message' => '发送成功']);
    }

    /**
     * 调用短信发送接口
     *
     * @param string $phone 用户手机号
     * @param string $smsCode 验证码
     * @return bool
     * @author varro
     */
    public function sendSms($phone, $smsCode)
    {
        $sendArray = [
            'mobile' => $phone,
            'tpl_id' => 74519,
            'tpl_value' => "#code#=$smsCode",
            'key' => '9d3a798c3bf0e3a55a3a9544ad54b438'
        ];

        $url = 'http://v.juhe.cn/sms/send?' . http_build_query($sendArray);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if ($result['error_code'] != 0) {
            return false;
        }

        return true;
    }
}

