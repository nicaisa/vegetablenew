<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/5/9
 * Time: 10:02
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class homeLogin
{
    /**
     * 前端用户登录检测
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        //验证cookie是否登录
        if (empty($request->cookie('user_id')) ){
            return redirect('homelogin');
        }else{
            //验证用户状态是否正常
            $info = DB::table('user')
                ->join('user_info', 'user_info.user_id', '=', 'user.id')
                ->select('user.username','user.phone','user.headimg',
                    'user_info.sex', 'user_info.nickname', 'user_info.birthday', 'user_info.address')
                ->where('user.id', '=', $request->cookie('user_id'))
                ->where('status', '=', 1)
                ->first();
            if($info) {
                $mid_params = [
                    'username' => $info->username,
                    'headimg' => $info->headimg,
                    'sex' => $info->sex,
                    'nickname' => $info->nickname,
                    'phone' => $info->phone,
                    'user_info' => $info
                ];
                $request->attributes->add($mid_params);//添加参数
                return $next($request);
            }else{
                return redirect('homelogin');
            }

        }

    }
}