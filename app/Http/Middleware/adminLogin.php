<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Cookie;
use Redirect;
/*
 创建中间键
 */

class adminLogin
{
	/**
	     * Run the request filter.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
	    	//判断后台是否登录 
	        if (!$request->cookie('id'))
	        {
	           // dd(Session::all());
	        	//重定向到login页面
                return redirect('adminlogin');
	        }else{
	        	//返回请求参数
	        	return $next($request);

	        }

	        	

	    }

}

