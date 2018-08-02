<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
	//后台登陆
	Route::get('login', 'Admin\LoginController@login')->name('login');
	//登陆的处理操作
	Route::post('check','Admin\LoginController@check')->name('check');
	//退出登录
	Route::get('logout','Admin\LoginController@logout')->name('logout');
	//验证码
	Route::get('code/{tmp}', 'Admin\LoginController@code')->name('code');
	//设置中间件路由防止未登录者直接访问页面,路由群组里面的东西都是需要登录后才能访问的
    Route::group(["middleware" =>'login'], function() {
	 	//后台首页
	 	Route::get('admin', 'Admin\IndexController@index')->name('Admin');
	 	//后台默认显示
	 	Route::get('admin/welcome', 'Admin\IndexController@welcome')->name('welcome');
	 	//-----------------------------------------管理员后台模块----------------------------------------------------------
	 	//管理员路由
	 	Route::get('admin/index','Admin\AdminController@index')->name('adminshow');
	 	//管理员查询
	 	Route::get('admin/like','Admin\AdminController@like')->name('adminlike');
	 	//管理员添加
	 	Route::post('admin/store','Admin\AdminController@store')->name('store');
	 	//管理员修改状态路由ajaxstatus是ajax那边传值的路径
	 	Route::post('admin/ajaxstatus','Admin\AdminController@ajaxstatus')->name('ajaxstatus');
	 	 //管理员删除方法
	 	Route::any("admin/del",'Admin\AdminController@del')->name('del');
       	//-----------------------------------------用户后台模块----------------------------------------------------------
	 	//用户路由
	 	Route::get('admin/User','Admin\UserController@index')->name('user');
	 	//用户添加方法
	 	Route::post("user/store",'Admin\UserController@store')->name('add_s');
	 	//用户修改方法
	 	Route::any("admin/User/edit",'Admin\UserController@edit')->name('edit');
	 	//用户详情方法
	 	Route::get("info/{id}",'Admin\UserController@info')->name('info');
	 	//用户修改状态路由ajaxstatus是ajax那边传值的路径
	 	Route::post('user/ajaxstate','Admin\UserController@ajaxstate')->name('ajaxstate');
        //-----------------------------------------商品后台模块----------------------------------------------------------
	 	//商品管理首页
	 	Route::any("admin/Goods/index",'Admin\GoodsController@index')->name('goods');
	 	//商品管理添加显示页面
	 	Route::get("admin/Goods/add",'Admin\GoodsController@store')->name('add');
	 	//商品管理添加操作页面
	 	Route::post("admin/Goods/addgoods",'Admin\GoodsController@addgoods')->name('addgoods');
	 	Route::any("Goods/goodstatus",'admin\GoodsController@goodstatus')->name('goodstatus');
	 	 //上传图片方法
	 	Route::post("Goods/goodsimg",'admin\GoodsController@goodsimg')->name('goodsimg');
	    //-----------------------------------------轮播图后台模块----------------------------------------------------------
	 	//轮播图管理显示页面
	 	Route::get("Silder/index",'admin\SilderController@index')->name('silder');
	 	//轮播图管理添加页面
	 	Route::get("Silder/store",'admin\SilderController@store')->name('sadd');
	 	//轮播图片添加数据
	    Route::post("Silder/add",'admin\SilderController@add')->name('addsilder');
	 	 //上传图片方法
	 	Route::post("Silder/upload",'admin\SilderController@upload')->name('upload');
	 	//轮播图修改状态路由ajaxstatus是ajax那边传值的路径
	 	Route::post('Silder/status','admin\SilderController@status')->name('status');
	 	//轮播图修改信息
	 	Route::any("Silder/upsilder",'admin\SilderController@upsilder')->name('upsilder');
	 	//---------------------------------------商品类型--------------------------------------------------------------------
	 	//商品类型管理显示页面
	 	Route::get("Type/index",'admin\TypeController@index')->name('type');
	 	//商品修改状态
	 	Route::any("Type/typestatus",'admin\TypeController@typestatus')->name('typestatus');
	 	//商品类型添加方法
	 	Route::post("Type/addtype",'admin\TypeController@addtype')->name('addtype');
	 	//商品类型添加页面
	 	Route::get("Type/store",'admin\TypeController@store')->name('addshow');
	    //轮播图修改信息
	 	Route::any("Type/uptype",'admin\TypeController@uptype')->name('uptype');
	 	//用户删除方法
        Route::get("Type/destory/{id}",'admin\TypeController@destory')->name('destory');
	 	//---------------------------------------商品规格--------------------------------------------------------------------
	 	//商品规格管理显示页面
	 	Route::get("Size/index",'admin\SizeController@index')->name('size');
	 	//商品修改状态
	 	Route::any("Size/sizestatus",'admin\SizeController@sizestatus')->name('sizestatus');
	 	//商品类型添加方法
	 	Route::post("Size/addsize",'admin\SizeController@addsize')->name('addsize');
	 	//商品类型添加页面
	 	Route::get("Size/store",'admin\SizeController@store')->name('sizeshow');
	    //轮播图修改信息
	 	Route::any("Size/upsize",'admin\SizeController@upsize')->name('upsize');
	 	//用户删除方法
        Route::get("Type/destory/{id}",'admin\SizeController@destory')->name('delsize');
        Route::get("Code/code",'admin\CodeController@code')->name('code');

 });

    //----------------------------------------------前台路由---------------------------------------------------------------
       //前台首页
       Route::get('home', 'Home\IndexController@index')->name('Home');
       //前台登陆
       Route::get('homelogin', 'Home\LoginController@login')->name('homelogin');
       //前台注册
       Route::get('reg', 'Home\RegController@index')->name('reg');
       //前台忘记密码
       Route::get('forget', 'Home\LoginController@forget')->name('forget');
       //忘记密码修改成功
       Route::get('success', 'Home\LoginController@success')->name('success');
       //商品信息显示
       Route::get('Goods/index', 'Home\GoodsController@index')->name('goodshow');
       //根据商品id显示对应商品
       Route::any('typeimg', 'Home\IndexController@typeimg')->name('typeimg');
       //商品搜索和商品分类搜索页面
       Route::get('show', 'Home\GoodsController@show')->name('show');
       