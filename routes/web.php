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
	Route::get('login', 'Admin\LoginController@login')->name('adminlogin');
	//登陆的处理操作
	Route::post('check','Admin\LoginController@check')->name('check');
	//退出登录
	Route::get('logout','Admin\LoginController@logout')->name('logout');
	//验证码
	Route::get('code/{tmp}', 'Admin\LoginController@code')->name('code');
	//设置中间件路由防止未登录者直接访问页面,路由群组里面的东西都是需要登录后才能访问的
    Route::group(["middleware" =>'login'], function() {
	 	//后台首页
	 	Route::get('admin', 'Admin\IndexController@index')->name('admin');
	 	//后台默认显示
	 	Route::get('admin/welcome', 'Admin\IndexController@welcome')->name('welcome');
	 	//-----------------------------------------管理员后台模块----------------------------------------------------------
	 	//管理员路由
	 	Route::get('admin/showadmin','Admin\AdminController@index')->name('showadmin');
	 	//管理员查询
	 	Route::get('admin/like','Admin\AdminController@like')->name('adminlike');
	 	//管理员添加
	 	Route::post('admin/store','Admin\AdminController@store')->name('store');
        //管理员显示
        Route::get('admin/add','Admin\AdminController@add')->name('addadmin');
	 	//管理员修改状态路由ajaxstatus是ajax那边传值的路径
	 	Route::post('admin/ajaxstatus','Admin\AdminController@ajaxstatus')->name('ajaxstatus');
	 	 //管理员删除方法
	 	Route::any("admin/del",'Admin\AdminController@del')->name('del');
        //管理员显示方法
        Route::get("admin/show",'Admin\AdminController@show')->name('findadmin');
       	//-----------------------------------------用户后台模块----------------------------------------------------------
	 	//用户路由
	 	Route::get('admin/User','Admin\UserController@index')->name('user');
	 	//用户显示页面
        Route::get('user/show','Admin\UserController@show')->name('usershow');
	 	//用户添加方法
	 	Route::get("user/store",'Admin\UserController@store')->name('add_s');
	 	//用户修改方法
	 	Route::any("admin/User/edit",'Admin\UserController@edit')->name('edit');
	 	//用户详情方法
	 	Route::get("info/{id}",'Admin\UserController@info')->name('info');
	 	//用户修改状态路由ajaxstatus是ajax那边传值的路径
	 	Route::post('user/ajaxstate','Admin\UserController@ajaxstate')->name('ajaxstate');
        //-----------------------------------------商品后台模块----------------------------------------------------------
	 	//商品管理查询首页
	 	Route::any("admin/Goods/index",'Admin\GoodsController@index')->name('goods');
	 	//商品管理添加显示页面
	 	Route::get("admin/Goods/add",'Admin\GoodsController@store')->name('add');
        //商品管理显示页面
        Route::get("admin/Goods/show",'Admin\GoodsController@show')->name('showgoods');
	 	//商品管理添加操作页面
	 	Route::post("admin/Goods/addgoods",'Admin\GoodsController@addgoods')->name('addgoods');
	 	//商品状态
	 	Route::any("Goods/goodstatus",'admin\GoodsController@goodstatus')->name('goodstatus');
	 	 //上传图片方法
	 	Route::post("Goods/goodsimg",'admin\GoodsController@goodsimg')->name('goodsimg');
        //修改商品信息
        Route::any("Goods/upgoods",'admin\GoodsController@upgoods')->name('upgoods');
        //-----------------------------------------订单后台模块----------------------------------------------------------
        //商品订单首页
        Route::get("Order/show",'admin\OrderController@show')->name('ordershow');
        //商品订单查询操作
        Route::get("Order/index",'admin\OrderController@index')->name('order');
	    //-----------------------------------------轮播图后台模块----------------------------------------------------------
	 	//轮播图管理显示页面
        Route::get("Silder/index",'admin\SilderController@index')->name('silder');
        //轮播图管理操作
        Route::get("Silder/show",'admin\SilderController@show')->name('sildershow');
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
        //商品类型管理显示查询页面
        Route::get("Type/show",'admin\TypeController@show')->name('typeshow');
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
        //---------------------------------------商品购物车-----------------------------------------------------------------
        //商品购物车查询操作
        Route::get("admin/cart",'admin\CartController@show')->name('cartshow');
        //商品购物车现在页面
        Route::get("admin/indexcart",'admin\CartController@index')->name('cartindex');

        //---------------------------------------广告--------------------------------------------------------------------
        //广告管理
        Route::get("admin/advment",'admin\AdvController@show')->name('Advment');
        //广告查询显示
        Route::get("admin/index",'admin\AdvController@index')->name('showadv');
        //广告查询操作
        Route::get("adv/show",'admin\AdvController@show')->name('showgk');
        //广告修改状态
        Route::any("Type/advmentstatus",'admin\AdvController@advmentstatus')->name('advmentstatus');
        //广告添加方法
        Route::post("Adv/addadvment",'admin\AdvController@addadvment')->name('addadvment');
        //广告页面显示
        Route::get("Advment/store",'admin\AdvController@store')->name('advshow');
        //广告修改信息
        Route::any("Advment/upadv",'admin\AdvController@upadv')->name('upadv');
        //上传图片方法
        Route::post("Advment/upload",'admin\AdvController@upload')->name('uploadadv');
	 	//---------------------------------------商品规格--------------------------------------------------------------------
	 	//商品规格管理显示页面
	 	Route::get("Size/index",'admin\SizeController@index')->name('size');
	 	//商品规格修改状态
	 	Route::any("Size/sizestatus",'admin\SizeController@sizestatus')->name('sizestatus');
	 	//商品规格添加方法
	 	Route::post("Size/addsize",'admin\SizeController@addsize')->name('addsize');
	 	//商品规格添加页面
	 	Route::get("Size/store",'admin\SizeController@store')->name('sizeshow');
	    //规格修改信息
	 	Route::any("Size/upsize",'admin\SizeController@upsize')->name('upsize');
        Route::get("Size/show",'admin\SizeController@show')->name('showsize');
	 	//规格删除方法
        Route::get("Size/destory/{id}",'admin\SizeController@destory')->name('delsize');
        Route::get("Code/code",'admin\CodeController@code')->name('code');


 });

    //----------------------------------------------前台路由---------------------------------------------------------------
    //前台登陆
    Route::get('homelogin', 'Home\LoginController@login')->name('homelogin');
    //用户注册
    Route::any('reg', 'Home\RegController@index')->name('reg');
    //发送短信
    Route::any('sendSms', 'Home\RegController@send')->name('sendSms');
    //前台忘记密码
    Route::any('forget', 'Home\RegController@forget')->name('forget');
    //忘记密码 查询用户
    Route::post('authenticate', 'Home\RegController@authenticate')->name('authenticate');
    //找回密码页面
    Route::any('authenticateShow', 'Home\RegController@authenticateShow')->name('aShow');
    Route::post('reset', 'Home\RegController@reset')->name('reset');
    Route::any('resetShow', 'Home\RegController@resetShow')->name('rShow');
    Route::post('resetSuccess', 'Home\RegController@resetSuccess')->name('rs');
    Route::any('resetSuccessShow', 'Home\RegController@resetSuccessShow')->name('rss');


    //前台首页
    Route::get('home', 'Home\IndexController@index')->name('Home');
    //商品信息显示
    Route::get('Goods/index', 'Home\GoodsController@index')->name('goodshow');
    //根据商品id显示对应商品
    Route::get('typeimg', 'Home\IndexController@typeimg')->name('typeimg');
    //商品搜索和商品分类搜索页面
    Route::get('show', 'Home\GoodsController@show')->name('show');
    //显示商品
    Route::get('showgood', 'Home\GoodsController@showgood')->name('showgood');
    //商品详情
    Route::get('goodsDeatil', 'Home\GoodsController@goodsDeatil')->name('goodsDeatil');
    //商品评价
    Route::post('evaluate', 'Home\EvaluateController@get_evaluate_info')->name('evaluate');


    //支付
    Route::any('order/pay', 'Home\OrderController@pay')->name('pay');
    Route::any('order/payNotify', 'Home\OrderController@payNotify');
    //物流
    Route::any('order/expressDetail', 'Home\OrderController@expressDetail')->name('expressDetail');
    //发货
    Route::any('delivery', 'Admin\OrderController@delivery')->name('delivery');


    Route::group(["middleware" =>'homeLogin'], function() {
        //忘记密码修改成功
        //Route::get('success', 'Home\LoginController@success')->name('success');
        //退出登录
        Route::get('home/logout', 'Home\LoginController@login_out')->name('home.logout');
        //前台购物车显示页面
        Route::get('shop_cart', 'Home\CartController@shop_cart')->name('shop_cart');
		 //ajax获取购物车商品总数
        Route::any('shop_cart/ajax_get_cart', 'Home\CartController@ajax_get_cart')->name('ajax_get_cart');
		//前台购物车操作页面
		Route::post('add_cart', 'Home\CartController@add_cart')->name('add_cart');
		//删除购物车单个商品
		Route::post('shop_cart/delete_cart', 'Home\CartController@delete_cart')->name('delete_cart');
		//删除购物车所有商品
		Route::post('shop_cart/delete_allcart', 'Home\CartController@delete_allcart')->name('delete_allcart');

	  	//确定订单
		Route::any('order/confirm', 'Home\OrderController@order_confirm')->name('order_confirm');
		//提交订单
        Route::post('order/submit', 'Home\OrderController@order_submit')->name('order_submit');
        //我的订单
        Route::get('User/order', 'Home\UserController@myorder')->name('myorder');
        //ajax查询收藏列表
        Route::post('User/get_order_list', 'Home\UserController@get_order_list')->name('get_order_list');
        //订单详情
        Route::get('User/orderDetail', 'Home\UserController@orderDetail')->name('orderDetail');
        //确认收货
        Route::post('User/ConfirmReceipt', 'Home\UserController@ConfirmReceipt')->name('ConfirmReceipt');

        //收货地址
        Route::get('User/address', 'Home\UserController@address')->name('address');
        //修改收货地址
        Route::post('User/address/save_address', 'Home\UserController@save_address');
        //删除收货地址
        Route::post('User/address/delete_address', 'Home\UserController@delete_address')->name('delete_address');

        //我的资料
        Route::get('User/myself', 'Home\UserController@myself')->name('myself');
        //我的资料
        Route::post('User/seave_user', 'Home\UserController@seave_user')->name('seave_user');
        //上传我的头像
        Route::post('User/headimg_upload', 'Home\UserController@headimg_upload')->name('headimg_upload');

        //我的收藏
        Route::get('User/collect', 'Home\UserController@collect')->name('collect');
        //添加进我的收藏
        Route::post('User/add_collect', 'Home\UserController@add_collect')->name('add_collect');
        //ajax查询收藏列表
        Route::post('User/get_collect_list', 'Home\UserController@get_collect_list')->name('get_collect_list');
        //移除收藏夹
        Route::post('User/remove_collect', 'Home\UserController@remove_collect')->name('remove_collect');
});
