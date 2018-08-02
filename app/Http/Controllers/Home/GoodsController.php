<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Home\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;//请求
class GoodsController extends Controller
{

    //前台登录      showgood?id=3&goods_name=%E8%8F%A0%E8%90%9D
    public function show(Request $request){
        //商品类型
        $data = $request->all();
        $user_id = $request->cookie('user_id');
        if (!empty($user_id)){
            $user_info = \DB::table('user')
                ->join('user_info', 'user_info.user_id', '=', 'user.id')
                ->select('user.username','user.phone','user.headimg','user_info.sex', 'user_info.nickname', 'user_info.birthday', 'user_info.address')
                ->where('user.id', '=', $user_id)
                ->where('status', '=', 1)
                ->first();
            //购物车商品数量
            $cart_count = \DB::table('shop_cart')
                ->where('user_id', '=', $user_id)
                ->count();
        }else{
            $user_info = '';
            $cart_count = 0;
        }
        //商品分类
        $goods_type = \DB::table('shop_type')
            ->where('status', '=', 1)
            ->get()
            ->toArray();
        $good_type = isset($data['id'])?$data['id']:0;
        $goods_name = isset($data['goods_name']) ? $data['goods_name']: "";
        $type=\DB::table('shop_type')->get();
       return view('home.Goods.show',compact('good_type','type','goods_name','user_info','cart_count','goods_type'));
    }

    /**
     * 商品分类
     * @param Request $request
     * @return array
     */
    public function showgood(Request $request){
        $data = $request->all();
        //商品评价总数
        $ev_count=\DB::table('shop_goods')
            ->join('evaluate','good_id','=','shop_goods.id')
            ->count();
        $goods_name = isset($data['goods_name']) ? '%'.$data['goods_name'].'%' : "";
        $goods_type = isset($data['id']) ? $data['id']:0;
        \DB::enableQueryLog();
        $go_count=\DB::table('shop_goods')
            ->where(function ($where) use($goods_name){
                if(!empty($goods_name)){
                    $where
                        ->where('name', 'like',$goods_name);
                }
            })
            ->where(function ($where) use($goods_type){
                if(!empty($goods_type)){
                    $where
                        ->where('type_id', '=',$goods_type);
                }
            })
            ->where('status','=','1')
                      ->count();
        $good=\DB::table('shop_goods')
            ->where(function ($where) use($goods_name){
                if(!empty($goods_name)){
                    $where
                        ->where('name', 'like',$goods_name);
                }
            })
            ->where(function ($where) use($goods_type){
                if(!empty($goods_type)){
                    $where
                        ->where('type_id', '=',$goods_type);
                }
            })
            ->where('status','=','1')
            ->get();
        $queries = \DB::getQueryLog(); // 获取查询日志
        foreach ($good as &$v){
            $goodsId_lock = str_replace('=','', Crypt::encrypt($v->id));// uid加密
            $v->goodsId_lock = $goodsId_lock;
            $v->img_url = asset('/uploads/goods/'.explode(',',$v->img)[0]);
        }
        $arr=array('code'=>1,'ev_count'=>$ev_count,'go_count'=>$go_count,'good'=>$good,'queries'=>$queries);
        return $arr;
    }

    /**
     * 商品详情页
     * @param Request $request
     * @return $this
     */
    public function  goodsDeatil(Request $request){
        $goodsId = $request->all()['id'];
        $goodsId_lock = str_replace('=','', Crypt::encrypt($goodsId));// uid加密

        $user_id = $request->cookie('user_id');
        if (!empty($user_id)){
            $user_info = \DB::table('user')
                ->join('user_info', 'user_info.user_id', '=', 'user.id')
                ->select('user.username','user.phone','user.headimg','user_info.sex', 'user_info.nickname', 'user_info.birthday', 'user_info.address')
                ->where('user.id', '=', $user_id)
                ->where('status', '=', 1)
                ->first();
            //购物车商品数量
            $cart_count = \DB::table('shop_cart')
                ->where('user_id', '=', $user_id)
                ->count();
        }else{
            $user_info = '';
            $cart_count = 0;
        }
        //商品分类
        $goods_type = \DB::table('shop_type')
            ->where('status', '=', 1)
            ->get()
            ->toArray();
        //商品信息
        $data=\DB::table('shop_goods')
                    ->where('id','=',$request->all()['id'])
                    ->where('status', '=', 1)
                    ->get();
        //商品规格名称
        $go_rule=\DB::table('shop_goods')
                    ->join('shop_size','shop_goods.rule','=','shop_size.id')
                    ->where('shop_goods.id','=',$request->all()['id'])
                    ->where('shop_goods.status', '=', 1)
                    ->get();
        //商品评论信息
        $ev_count=\DB::table('evaluate')
                      ->where('good_id','=',$request->all()['id'])
                      ->count();
        //商品热卖总条数
        $hotcount=\DB::table('shop_goods')
                    ->join('shop_type','shop_goods.type_id','=','shop_type.id')
                    ->where('shop_type.id','=',$request->all()['typeid'])
                    ->where('shop_goods.status', '=', 1)
                    ->orderby('shop_goods.sales','desc')
                    ->count();
        //商品热卖数据
        $hot=\DB::table('shop_type')
            ->join('shop_goods','shop_goods.type_id','=','shop_type.id')
            ->where('shop_type.id','=',$request->all()['typeid'])
            ->where('shop_goods.status', '=', 1)
            ->orderby('shop_goods.sales','desc')
            ->paginate(4);
        return view("home.Goods.goods",compact('ev_count','user_info','cart_count','goods_type'))->with('data',$data[0])->with('go_rule',$go_rule[0])->with('hot',$hot)->with('goodsId_lock',$goodsId_lock);

    }

    /**
     * 商品减少库存
     * @param Request $request
     * @return array
     */
    public function goods_Minus(Request $request){
        $data = $request->all();
        $goods_ids = $data['goods_ids'];
        foreach ($goods_ids as $k=>$v){
            //查询商品表数据
            $goods = \DB::table('shop_goods')
                ->where('id', '=', $k)
                ->where('status', '=', 1)
                ->first();
            //判断商品库存是否存在
            if(empty($goods)){
                $array=array('code'=>0,'message'=>'修改失败');
                return $array;
            }else{
                $stock = $goods->stock - $v;    //减少后的库存
                $sales = $goods->sales + $v;    //增加后的销量
                $res = \DB::table('shop_goods')
                    ->where('id', '=', $k)
                    ->where('status', '=', 1)
                    ->update(['stock'=>$stock,'sales'=>$sales]);
                if(empty($res)){
                    $array=array('code'=>0,'message'=>'修改失败1');
                    return $array;
                }
            }
        }

        $array=array('code'=>1,'message'=>'修改成功');
        return $array;
    }

}
