<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Home\AuthenticatesUsers;
use Illuminate\Http\Request;//请求
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class CartController extends Controller
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
    //显示用户所对应的购物车商品
    public function shop_cart(Request $request){
        $user_id = $request->cookie('user_id');
        $cart=DB::table('shop_cart')
                    ->join('shop_goods','shop_cart.goods_id','=','shop_goods.id')
                    ->select('shop_cart.id','shop_cart.goods_img','shop_cart.goods_id','shop_cart.num','shop_goods.name','shop_goods.price','shop_cart.good_type')
                    ->where('user_id','=',$user_id)
                    ->get();
        if(!empty($cart)){
            foreach ($cart as &$v){
                $v->cartId_lock = str_replace('=','', Crypt::encrypt($v->id));
                $v->goodsId_lock = str_replace('=','', Crypt::encrypt($v->goods_id));
            }
        }
        $total=DB::table('shop_goods')
            ->join('shop_cart','shop_goods.type_id','=','shop_cart.good_type')
            ->count();
        $like=DB::table('shop_goods')
                   ->join('shop_cart','shop_goods.type_id','=','shop_cart.good_type')
                   ->paginate()
                   ->toArray();

        $user_info = $request->attributes->get('user_info');
        //商品分类
        $goods_type = DB::table('shop_type')
            ->where('status', '=', 1)
            ->get()
            ->toArray();
        //购物车商品数量
        $cart_count = DB::table('shop_cart')
            ->where('user_id', '=', $user_id)
            ->count();
       //引入前台购物车页面
       return view('home.Cart.cart',compact('user_info','cart_count','goods_type'))->with('cart',$cart)->with('like',$like['data']);
    }

    public function ajax_get_cart(Request $request){
        $data = $request->all();
        $user_id = $request->cookie('user_id');

        DB::enableQueryLog();
        $cart=DB::table('shop_cart')
            ->join('shop_goods','shop_cart.goods_id','=','shop_goods.id')
            ->select('shop_cart.id','shop_cart.goods_img','shop_cart.goods_id','shop_cart.num','shop_goods.name','shop_goods.price','shop_goods.stock','shop_cart.good_type')
            ->where('user_id','=',$user_id)
            ->get();

        $queries = DB::getQueryLog(); // 获取查询日志
        if(!empty($cart)){
            foreach ($cart as &$v){
                $v->cartId_lock = str_replace('=','', Crypt::encrypt($v->id));
                $v->goodsId_lock = str_replace('=','', Crypt::encrypt($v->goods_id));
                $v->goods_img_src = asset('/uploads/goods/'.$v->goods_img);
            }
        }
        $total=DB::table('shop_cart')
            ->where('user_id','=',$user_id)
            ->count();
        return json_encode(['cart'=>$cart,'total'=>$total,'queries'=>$queries ]);
    }

    /**
     * 加入购物车操作
     * @param Request $request
     * @return array
     */
    public function add_cart(Request $request){
        $user_id = $request->cookie('user_id');
        $data = $request->all();
        $good_id = Crypt::decrypt($data['goodsId_lock']);
        $goods_num = $data['goods_num'];

        $goods = DB::table('shop_goods')
            ->where('id', '=', $good_id)
            ->first();

        //判断数据是否存在
        if(empty($goods)){
            $array = array('code'=>0,'message'=>'该商品不存在');
            return $array;
        }
        //查询购物车表数据
        $cart = DB::table('shop_cart')
                    ->where('user_id', '=', $user_id)
                    ->where('goods_id', '=', $good_id)
                    ->first();
        //判断数据是否存在
        if(empty($cart)){
            //如果不存在直接添加数据
            $arr = [
                'user_id' => $user_id,
                'num' => $goods_num,
                'goods_id' => $good_id,
                'goods_img' => explode(',',$goods->img)[0],
                'price' => $goods->price,
                'good_type' => $goods->type_id,
                'add_time' => time()
            ];
            $res = DB::table('shop_cart')->insert($arr);
            if ($res) {
                $array=array('code'=>1,'message'=>'添加成功');
                return $array;
            }else{
                $array=array('code'=>0,'message'=>'添加失败');
                return $array;
            }
        //如果存在就直接修改数量，不增加数据
        }else{
            $update_array = [
                'num' => $cart->num+$goods_num,
                'add_time' => time()
            ];
            //执行修改语句
            $res = DB::table("shop_cart")
                ->where('id',$cart->id)
                ->where('user_id',$user_id)
                ->update($update_array);
            if($res){
                $array=array('code'=>1,'message'=>'添加成功');
                return $array;
            }else{
                $array=array('code'=>0,'message'=>'添加失败');
                return $array;
            }
        }
    }

    /**
     * 移除购物车操作
     * @param Request $request
     * @return array
     */
    public function delete_cart(Request $request){
        $user_id = $request->cookie('user_id');
        $data = $request->all();
        $cartId_lock = Crypt::decrypt($data['cartId_lock']);

        //查询购物车表数据
        $cart = DB::table('shop_cart')
                    ->where('user_id', '=', $user_id)
                    ->where('id', '=', $cartId_lock)
                    ->first();
        //判断数据是否存在
        if(empty($cart)){
            $array=array('code'=>0,'message'=>'删除失败');
            return $array;
        }else{
            $res = DB::table('shop_cart')
                ->where('user_id', '=', $user_id)
                ->where('id', '=', $cartId_lock)
                ->delete();
            if(empty($res)){
                $array=array('code'=>0,'message'=>'删除失败1');
                return $array;
            }else{
                $array=array('code'=>1,'message'=>'移除成功');
                return $array;
            }
        }
    }

    /**
     * 移除购物车
     * @param Request $request
     * @return array
     */
    public function delete_allcart(Request $request){
        $user_id = $request->cookie('user_id');
        $data = $request->all();
        $cart_ids = $data['cart_ids'];
        foreach ($cart_ids as $v){
            if ($v != 0){
                //查询购物车表数据
                $cart = DB::table('shop_cart')
                    ->where('user_id', '=', $user_id)
                    ->where('id', '=', $v)
                    ->first();
                //判断数据是否存在
                if(empty($cart)){
                    $array=array('code'=>0,'message'=>'删除失败');
                    return $array;
                }else{
                    $res = DB::table('shop_cart')
                        ->where('user_id', '=', $user_id)
                        ->where('id', '=', $v)
                        ->delete();
                    if(empty($res)){
                        $array=array('code'=>0,'message'=>'删除失败1');
                        return $array;
                    }
                }
            }
        }
        $array=array('code'=>1,'message'=>'移除成功');
        return $array;
    }
}
