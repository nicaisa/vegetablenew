<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/4/26
 * Time: 13:58
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private $stale = 'JHjksslj22PK445';

    /**
     * 我的资料
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myself(Request $request){
        $user_id = $request->cookie('user_id');
        $userID_md5 = md5($user_id.$this->stale);
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
        return view('home.User.userinfo', compact('user_info','cart_count','goods_type'));
    }

    /**
     * 修改我的资料
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function seave_user(Request $request){
        $user_id = $request->cookie('user_id');
        $data = $request->all();
        $headimg = substr($data['headimg'],6);
        $user_info = DB::table('user')
            ->join('user_info', 'user_info.user_id', '=', 'user.id')
            ->where('user_id', '=', $user_id)
            ->first();
        if (empty($user_info)){
            return json_encode(['code'=>0,'message'=>'未找到该用户!']);
        }else{
            $userParams = [
                'username' => $data['username'],
                'headimg' => $headimg,
                'phone' => $data['phone']
            ];
            $user_infoParams = [
                'sex' => $data['sex'],
                'address' => $data['address'],
                'nickname' => $data['nickname'],
                'birthday' => $data['birthday']
            ];

            $savePath = public_path()."\uploads\user\cache\\";  //临时头像路径
            $updatePath = public_path()."\uploads\user\\";      //保存头像路径

            //文件不存在
            if (!file_exists($savePath.$headimg)){
                $headimg = $user_info->headimg;
            }else{
                $upload_result = copy($savePath.$headimg,$updatePath.$headimg);
                if (!$upload_result){
                    return json_encode(['code'=>0,'message'=>'头像修改失败!']);
                }
            }

            $user_res = DB::table('user')
                ->where('id', '=', $user_id)
                ->where('status', '=', 1)
                ->update($userParams);
            $user_info_res = DB::table('user_info')
                ->where('user_id', '=', $user_id)
                ->update($user_infoParams);
            if ($user_res && $user_info_res){
                return json_encode(['code'=>1,'message'=>'修改成功!']);
            }else{
                return json_encode(['code'=>0,'message'=>'修改失败!']);
            }
        }
    }

    /**
     * 上传头像
     * @param Request $request
     * @return string
     */
    public function headimg_upload(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES["file"]["tmp_name"];
        $file_error = $_FILES["file"]["error"];
        if ($file_error > 0) { // 出错
            $status = 0;
            $message = $file_error;
        }else{
            $file_name_arr = explode('.', $file_name);
            //临时图片名称
            $new_file_name = $user_id.'headimg' . md5($user_id.'headimg') .'.'. $file_name_arr[1];
            //保存路径
            $savePath = public_path()."\uploads\user\cache\\";
            //若保存目录不存在, 递归创建目录
            if (!is_dir($savePath)) {
                mkdir($savePath, 0755, true);
            }
            $file_path = $savePath . $new_file_name;

            //保存图片
            $upload_result = move_uploaded_file($file_tmp, $file_path);
            //此函数只支持 HTTP POST 上传的文件
            if ($upload_result) {
                $status = 1;
                $message = $file_path;
            } else {
                $status = 0;
                $message = "文件上传失败，请稍后再尝试";
            }
        }
        return json_encode(['status' => $status, 'message' => $message]);
    }




//我的订单------------------------------------------------------------------------------
    /**
     * 我的订单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myorder(Request $request){
        $user_id = $request->cookie('user_id');
        $data = $request->all();
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
        $order_info = DB::table('shop_orders')
            ->where('user_id', '=', $user_id)
            ->get()
            ->toArray();
        $order_count_res = DB::table('shop_orders')
            ->select('state',DB::raw('count(order_id) as count'))
            ->where('user_id', '=', $user_id)
            ->groupBy('state')
            ->get()
            ->toArray();
        $order_count = [];
        $order_count[0] = 0;
        foreach ($order_count_res as $v){
            $order_count[$v->state] = $v->count;
            $order_count[0] += $v->count;
        }
        for($i=0;$i<=5;$i++){
            if (!isset($order_count[$i])){
                $order_count[$i] = 0;
            }
        }
        if (!empty($order_info)){
            foreach ($order_info as &$v){
                $v->orderId_lock = str_replace('=','', Crypt::encrypt($v->order_id));
            }
        }
        return view('home.User.order',compact('order_info','user_info','cart_count','goods_type','order_count'));
    }

    /**
     * 获取订单列表
     * @param Request $request
     * @return string
     */
    public function get_order_list(Request $request){
        $user_id = $request->cookie('user_id');
        $data = $request->all();
        $type = $data['type'];
        if ($type==0){
            //查询收藏夹表数据
            $order_list = DB::table('shop_orders')
                ->where('user_id', '=', $user_id)
                ->get()
                ->toArray();

            $total=DB::table('shop_orders')
                ->where('user_id', '=', $user_id)
                ->count();
        }else{
            //查询收藏夹表数据
            $order_list = DB::table('shop_orders')
                ->where('user_id', '=', $user_id)
                ->where('state', '=', $type)
                ->get()
                ->toArray();

            $total=DB::table('shop_orders')
                ->where('user_id', '=', $user_id)
                ->where('state', '=', $type)
                ->count();
        }
        if (!empty($order_list)){
            foreach ($order_list as &$v){
                $v->orderId_lock = str_replace('=','', Crypt::encrypt($v->order_id));
            }
        }
        return json_encode(['code'=>1,'order_list' => $order_list, 'total'=>$total]);
    }


    /**
     * 确认收货
     * @param Request $request
     * @return string
     */
    public function ConfirmReceipt(Request $request){
        $user_id = $request->cookie('user_id');
        $data = $request->all();
        $order_id = $data['order_id'];

        //查询订单
        $orders_info = DB::table('shop_orders')
            ->where('user_id', '=', $user_id)
            ->where('order_id', '=', $order_id)
            ->where('state', '=', 3)
            ->first();
        if (empty($orders_info)){
            return json_encode(['code'=>0,'message'=>'该订单信息错误!']);
        }
        $orders_infoParams = [
            'state' => 4
        ];
        $orders_res = DB::table('shop_orders')
            ->where('user_id', '=', $user_id)
            ->where('order_id', '=', $order_id)
            ->where('state', '=', 3)
            ->update($orders_infoParams);

        if (empty($orders_res)){
            return json_encode(['code'=>0,'message'=>'该订单信息错误,请稍后再试!']);
        }else{
            return json_encode(['code'=>1,'message'=>'已确认收货!']);
        }
    }

    /**
     * 订单详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderDetail(Request $request)
    {
        $user_id = $request->cookie('user_id');
        $data = $request->all();
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
        //订单信息
        $order_id = Crypt::decrypt($data['order_id']);
        $order_info = DB::table('shop_orders')
            ->where('user_id', '=', $user_id)
            ->where('order_id', '=', $order_id)
            ->first();

        //订单商品信息
        $order_goods_info = DB::table('shop_order_goods')
            ->join('shop_goods', 'shop_order_goods.goods_id', '=', 'shop_goods.id')
            ->select('shop_order_goods.id', 'shop_order_goods.goods_num', 'shop_order_goods.total_price','shop_order_goods.goods_price', 'shop_goods.name', 'shop_goods.img' )
            ->where('user_id', '=', $user_id)
            ->where('order_id', '=', $order_id)
            ->get()
            ->toArray();
        return view('home.User.order_detail',compact('order_info','order_goods_info','user_info','cart_count','goods_type'));
    }


//我的收藏------------------------------------------------------------------------------
/**
 * 我的收藏
 * @param Request $request
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
public function collect(Request $request){
    $user_id = $request->cookie('user_id');
    $data = $request->all();
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
    return view('home.User.collect',compact('user_info','cart_count','goods_type'));
}

/**
 * 获取收藏列表
 * @param Request $request
 * @return string
 */
public function get_collect_list(Request $request){
    $user_id = $request->cookie('user_id');
    $data = $request->all();
    //查询收藏夹表数据
    $collect_list = DB::table('collect')
        ->join('shop_goods', 'shop_goods.id', '=', 'collect.goods_id')
        ->select('collect.id','collect.goods_id','collect.goods_type','shop_goods.img','shop_goods.price','shop_goods.describe','shop_goods.name')
        ->where('user_id', '=', $user_id)
        ->get()
        ->toArray();
    if(!empty($collect_list)){
        foreach ($collect_list as &$v) {
            $v->useimg = asset('uploads/goods/' . explode(',', $v->img)[0]);
            $v->goodsId_lock = str_replace('=', '', Crypt::encrypt($v->goods_id));
        }
    }
    $total=DB::table('collect')
        ->where('user_id','=',$user_id)
        ->count();
    return json_encode(['code'=>1,'collect_list' => $collect_list, 'total'=>$total]);
}

/**
 * 添加收藏
 * @param Request $request
 * @return array
 */
public function add_collect(Request $request){
    $user_id = $request->cookie('user_id');
    $data = $request->all();
    $goodsId = Crypt::decrypt($data['goodsId_lock']);
    $goods_type = $data['goods_type'];
    //商品信息
    $data=DB::table('shop_goods')
        ->where('id','=',$goodsId)
        ->first();
    if (empty($data)){
        $array=array('code'=>0,'message'=>'操作失败');
        return $array;
    }else{
        //查询收藏夹表数据
        $collect = DB::table('collect')
            ->where('user_id', '=', $user_id)
            ->where('goods_id', '=', $goodsId)
            ->first();
        if($collect){
            $array=array('code'=>2,'message'=>'该商品已在收藏夹中!');
            return $array;
        }
        $arr = [
            'user_id' => $user_id,
            'goods_id' => $goodsId,
            'goods_type' => $goods_type,
            'create_time' => time()
        ];
        $res =DB::table('collect')
            ->insert($arr);
        if ($res){
            $array=array('code'=>1,'message'=>'添加成功');
            return $array;
        }else{
            $array=array('code'=>1,'message'=>'添加成功');
            return $array;
        }
    }
}

/**
 * 移除收藏
 * @param Request $request
 * @return array
 */
public function remove_collect(Request $request){
    $user_id = $request->cookie('user_id');
    $data = $request->all();
    $collect_id = $data['collect_id'];
    //商品信息

    //查询收藏夹表数据
    $collect = DB::table('collect')
        ->where('user_id', '=', $user_id)
        ->where('id', '=', $collect_id)
        ->first();
    if(empty($collect)){
        $array=array('code'=>0,'message'=>'收藏夹中未找到该商品!');
        return json_encode($array);
    }else{
        $res =DB::table('collect')
            ->where('user_id', '=', $user_id)
            ->where('id', '=', $collect_id)
            ->delete();
        if ($res){
            $array=array('code'=>1,'message'=>'成功移除!');
            return json_encode($array);
        }else{
            $array=array('code'=>0,'message'=>'移除失败!');
            return json_encode($array);
        }
    }
}


//收货地址------------------------------------------------------------------------------
/**
 * 收货地址
 * @param Request $request
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
public function address(Request $request){
    $user_id = $request->cookie('user_id');
    $data = $request->all();

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
    $address = DB::table('shop_address')
        ->where('user_id', '=', $user_id)
        ->get()
        ->toArray();
    if ($address){
        foreach ($address as &$v){
            $v->address_id =str_replace('=','', Crypt::encrypt($v->id));
        }
    }

    if(isset($data['address_id'])){
        $address_id = $data['address_id'];
    }else{
        $address_id = 0;
    }

    return view('home.User.address', compact('address','address_id','user_info','cart_count','goods_type'));
}

/**
 * 删除地址
 * @param Request $request
 * @return string
 */
public function delete_address(Request $request){
    $user_id = $request->cookie('user_id');
    $data = $request->all();
    $address_id = Crypt::decrypt($data['address_id']);
    //查询收藏夹表数据
    $address_info = DB::table('shop_address')
        ->where('user_id', '=', $user_id)
        ->where('id', '=', $address_id)
        ->first();
    if (empty($address_info)){
        return json_encode(['code'=>0,'message'=>'删除失败1']);
    }else{
        $res = DB::table('shop_address')
            ->where('user_id', '=', $user_id)
            ->where('id', '=', $address_id)
            ->delete();
        if (empty($res)){
            return json_encode(['code'=>0,'message'=>'删除失败1']);
        }else {
            return json_encode(['code' => 1, 'message' => '删除成功']);
        }
    }
}

/**
 * 保存地址
 * @param Request $request
 * @return string
 */
public function save_address(Request $request){
    $user_id = $request->cookie('user_id');
    $data = $request->all();
    $phone = $data['phone'];
    $name = $data['name'];
    $address = $data['detailarea'];     //详细地址
    $default = $data['default'];        //是否为默认地址
    $address_id = $data['address_id'];  //地址id  0为新增
    $region = implode(",", $data['arrList']);   //所在地区
    if(empty($address_id)){  //新增地址
        $address_data = [
            'user_id' => $user_id,
            'name' => $name,
            'address' => $address,
            'region' => $region,
            'default' => 0,
            'tel' => $phone,
            'create_time' => time(),
            'update_time' => time()
        ];
        $addid = DB::table('shop_address')->insertGetId($address_data);
        if (empty($addid)){
            return json_encode(['code'=>0,'message'=>'添加失败']);
        }else{
            if ($default==1){
                $res = self::address_default($user_id,$addid);
                if (!$res){
                    return json_encode(['code'=>0,'message'=>'添加失败'.$addid]);
                }
            }
            return json_encode(['code'=>200,'message'=>'添加成功']);
        }
    }else{
        $address_id = Crypt::decrypt($data['address_id']);
        //查询收藏夹表数据
        $address_info = DB::table('shop_address')
            ->where('user_id', '=', $user_id)
            ->where('id', '=', $address_id)
            ->first();
        if (empty($address_info)){
            return json_encode(['code'=>0,'message'=>'修改失败!地址id错误']);
        }else{
            $update_data = [
                'name' => $name,
                'address' => $address,
                'region' => $region,
                'default' => 0,
                'tel' => $phone,
                'update_time' => time()
            ];
            $res = DB::table('shop_address')
                ->where('user_id', '=', $user_id)
                ->where('id', '=', $address_id)
                ->update($update_data);
            if (empty($res)){
                return json_encode(['code'=>0,'message'=>'修改失败']);
            }
            if ($default==1){
                $res = self::address_default($user_id,$address_id);
                if (!$res){
                    return json_encode(['code'=>0,'message'=>'添加失败2'.$address_id]);
                }
            }
            return json_encode(['code'=>200,'message'=>'修改成功']);
        }
    }
}

/**
 * 修改默认地址
 * @param $user_id
 * @param $addid
 * @return bool
 */
public function address_default($user_id,$address_id){
    $res = DB::table('shop_address')
        ->where('user_id', '=', $user_id)
        ->where('default', '=', 1)
        ->update(['default' => 0]);
    $result = DB::table('shop_address')
        ->where('user_id', '=', $user_id)
        ->where('id', '=', $address_id)
        ->update(['default' => 1]);
    if ($res && $result){
        return true;
    }else{
        return false;
    }
}

}