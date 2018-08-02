<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Home\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;//请求

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
    //前台首页SELECT `id`, `type_id`, `name`, `price`, `img`, `status`, `stock`, `describe`, `addtime`, `sales`, `volume`, `rule`, `_token` FROM `shop_goods` WHERE 1
    public function index(Request $request){
        $request->all();
        $user_id = $request->cookie('user_id');
        if (!empty($user_id)){
            $user_info = DB::table('user')
                ->join('user_info', 'user_info.user_id', '=', 'user.id')
                ->select('user.username','user.phone','user.headimg','user_info.sex', 'user_info.nickname', 'user_info.birthday', 'user_info.address')
                ->where('user.id', '=', $user_id)
                ->where('status', '=', 1)
                ->first();
            //购物车商品数量
            $cart_count = DB::table('shop_cart')
                ->where('user_id', '=', $user_id)
                ->count();
        }else{
            $user_info = '';
            $cart_count = 0;
        }
        //商品分类
        $goods_type = DB::table('shop_type')
            ->where('status', '=', 1)
            ->get()
            ->toArray();
        //获取商品分类名称
        $type=\DB::table('shop_type')->get();
        //hover商品类型名称触发相对应商品图片
        $id = isset( $request->all()['id']) ? $request->all()['id'] : 3;

        $typeimg=\DB::table('shop_goods')
            ->where('type_id', '=',$id)
            ->paginate(4);
        //查询轮播图片
        $silder=\DB::table('silder')->get();
        return view('home.index',compact('user_info','cart_count', 'goods_type'))->with('type',$type)->with('good',$typeimg)->with('silder',$silder);

   }
    //中部分类
    public  function typeimg(Request $request ){
        $id=$request->all()['id'];

        $typeimg=\DB::table('shop_goods')
            ->where('type_id', '=',$id)
            ->paginate(4);
        if($typeimg) {
            $arr = array('code' => 1,'id'=>$id,'typeimg'=>$typeimg);
            return $arr;
        }
     }
}
