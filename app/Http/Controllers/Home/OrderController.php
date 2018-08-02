<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class  OrderController extends Controller
{
    //三方支付appid
    protected $payAppId = '3086';

    //三方支付秘钥
    protected $paySecret= 'cbc6bda9aa63d870340b1f1a2e09bdc285987c5a';

    //支付地址
    protected $payUrl = 'http://www.w8pay.com/apisubmit';

    //支付回调地址
    protected $notifyUrl = 'http://fvheart.krymee.top/order/payNotify';

    //及时回调地址
    protected $hrefUrl = 'http://fvheart.krymee.top/home';

    //物流查询地址
    protected $expressUrl = 'http://wuliu.market.alicloudapi.com';

    //物流appid
    protected $expressAppCode = '585b12344b8244ec99fe99f543b5712e';

    protected $payType = [
        '1' => 'alipay', //阿里扫码支付
        '2' => 'weixin' //微信扫码支付
    ];

    //配送费
    protected $distribution_fee = 0.2;

    //前台登录
    public function order(){
       //引入前台登录页面
       return view('home.Order.order');    
    }

    /**
     * 确认订单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order_confirm(Request $request){
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
        $goods_type = DB::table('shop_type')
            ->where('status', '=', 1)
            ->get()
            ->toArray();
        $distribution_fee = $this->distribution_fee;
        $type = $data['type'];
        $goods_order = [];//商品信息
        $total_price = 0; //所有商品总价
        $cartIds = 'id:';//购物车id
        if ($type=='goods'){
        /*单独购买*/
            $good_id = Crypt::decrypt($data['goods_id']);
            $goods_num = $data['goods_num'];       //商品数量
            //商品信息
            $goods_info=DB::table('shop_goods')
                ->where('id','=',$good_id)
                ->first();
            $goods_order[0]['cartId_lock'] = str_replace('=','', Crypt::encrypt(0));              //购物车id
            $goods_order[0]['goods_id'] = $goods_info->id;          //商品id
            $goods_order[0]['goodsId_lock'] = str_replace('=','', Crypt::encrypt($goods_info->id));//商品id 加密
            $goods_order[0]['type_id'] = $goods_info->type_id;
            $goods_order[0]['goods_name'] = $goods_info->name;
            $goods_order[0]['goods_price'] = $goods_info->price;
            $goods_order[0]['good_thumb'] = asset('uploads/goods/'.explode(',',$goods_info->img)[0]);
            $goods_order[0]['goods_num'] = $goods_num;
            $totalPrice = ($goods_num * $goods_info->price);
        }elseif ($type=='cart'){
        /*购物车购买*/
            $totalPrice = $data['totalPrice'];                      //订单总价
            $arrGood = json_decode($data['arrGood'],true);      //商品id 商品数量
            foreach ($arrGood as $k=>$v){
                $cartId = Crypt::decrypt($v['cartId']);
                $goods_num = $v['num'];
                $goods_info = DB::table('shop_cart')
                    ->join('shop_goods', 'shop_cart.goods_id', '=', 'shop_goods.id')
                    ->select('shop_cart.goods_id','shop_goods.name','shop_goods.type_id','shop_goods.price','shop_goods.img')
                    ->where('shop_cart.user_id', '=', $user_id)
                    ->where('shop_cart.id', '=', $cartId)
                    ->first();
                if (empty($goods_info)){
                    echo '购物车没有此商品!';
                    return false;
                }

                $goods_order[$k]['cartId_lock'] = $v['cartId'];              //购物车id
                $goods_order[$k]['goods_id'] = $goods_info->goods_id;   //商品id
                $goods_order[$k]['goodsId_lock'] = str_replace('=','', Crypt::encrypt($goods_info->goods_id));//商品id 加密
                $goods_order[$k]['type_id'] = $goods_info->type_id;
                $goods_order[$k]['goods_name'] = $goods_info->name;
                $goods_order[$k]['goods_price'] = $goods_info->price;
                $goods_order[$k]['good_thumb'] = asset('uploads/goods/'.explode(',',$goods_info->img)[0]);
                $goods_order[$k]['goods_num'] = $goods_num;
                $total_price += ($goods_num * $goods_info->price);
            }
        }else{

        }
        /*查询地址*/
        $address = DB::table('shop_address')
            ->where('user_id', '=', $user_id)
            ->get()
            ->toArray();
        if ($address){
            foreach ($address as &$v){
                $v->address_id = str_replace('=','', Crypt::encrypt($v->id));
            }
        }
        return view('home.Order.confirm', compact('goods_order','cartIds','address', 'total_price', 'distribution_fee','user_info','cart_count','goods_type'));
    }

    /**
     * 提交订单
     * @param Request $request
     * @return string
     */
    public function order_submit(Request $request){
        $data = $request->all();
        $user_id = $request->cookie('user_id');
        $order_info = json_decode($data['order_info'],true);
        $total_price = floatval($data['total_price']);        //前台订单总价
        $addressId = Crypt::decrypt($data['addressId']);       //选择的收货地址id
        $order_goods_data = [];             //order_goods 信息
        $order_id = 'O'.str_random(3).$user_id.date('YmdHis');
        $distribution_fee = $this->distribution_fee;
        $totalPrice = 0 + $distribution_fee;    //后台计算订单总价
        $cart_ids = [];                         //购物车id
        $goods_ids = [];                         //购物车id
//        echo '<pre>';
//        var_dump($order_info);
//        exit();
        foreach ($order_info as $v){
            $cart_id = Crypt::decrypt($v['cartId']);
            $goods_id = Crypt::decrypt($v['goodsId']);
            $goods_num = $v['num'];
            $cart_ids[] = $cart_id;
            $goods_ids[$goods_id] = $goods_num;
            //查询商品信息
            $goods_info=DB::table('shop_goods')
                ->where('id','=',$goods_id)
                ->first();
            if (empty($goods_info)){
                return json_encode(['code' => 0, 'message' => '未找到该商品!']);
            }
            $goods_Price = $goods_num * $goods_info->price;
            $order_goods_data[] = [
                'user_id' => $user_id,
                'order_id' => $order_id,
                'goods_id' => $goods_id,
                'state' => 1,
                'goods_num' => $goods_num,
                'goods_price' => $goods_info->price,
                'total_price' => $goods_Price,
                'create_time' => time(),
                'update_time' => time(),
            ];
            $totalPrice += $goods_Price;
        }

        if(round($total_price,2) != round($totalPrice,2)){
            return json_encode(['code' => 0, 'message' => '商品总价不正确!'.$totalPrice.'不等于'.$total_price]);
        }

        //查询是否有默认收货地址
        $address = DB::table('shop_address')
            ->where('user_id', '=', $user_id)
            ->where('id', '=', $addressId)
            ->first();
        if (empty($address)){
            return json_encode(['code' => 0, 'message' => '请选择默认收货地址!']);
        }
        $order_data = [
            'user_id' => $user_id,
            'order_id' => $order_id,
            'state' => 1,
            'total_price' => $totalPrice,
            'region' => $address->region,
            'address' => $address->address,
            'tel' => $address->tel,
            'Consignee' => $address->name,
            'create_time' => time(),
            'update_time' => time(),
        ];

        $res = self::add_order_goods(['order'=>$order_data,'goods'=>$order_goods_data]);
        if ($res){
            //移除购物车
            request()->offsetSet('cart_ids', $cart_ids);
                $deletcart = new CartController();
                $cart_res = $deletcart->delete_allcart($request);
            //商品减少库存
            request()->offsetSet('goods_ids', $goods_ids);
                $goods_Minus = new GoodsController();
                $goods_res = $goods_Minus->goods_Minus($request);
            return json_encode(['code' => 1, 'message' => '订单创建成功!', 'order_id' => $order_id,'cart_res'=>$cart_res,'goods_res'=>$goods_res]);
        }else{
            return json_encode(['code' => 0, 'message' => '订单创建失败!']);
        }
    }


    /**
     * 插入订单
     * @param $data
     * @return bool
     */
    private function add_order_goods($data){
        $res = DB::table('shop_orders')->insert($data['order']);
        if (empty($res)){
            return false;
        }
        foreach ($data['goods'] as $v){
            $res = DB::table('shop_order_goods')->insert($v);
            if (empty($res)){
                return false;
            }
        }
        return true;
    }

    /**
     * 支付
     *
     * @param Request $request
     * @author varro
     */
    public function pay(Request $request)
    {
        $orderId = $request->input('order_id');
        $payType = $request->input('pay_type');
        if (empty($orderId)) {
            $this->jsonReturn(['status' => 0, 'message' => '订单号为空']);
        }

        $orderInfo = DB::table('shop_orders')->where('order_id', $orderId)->first();
        if (empty($orderInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '订单不存在']);
        }

        if ($orderInfo->pay_status != 0) {
            $this->jsonReturn(['status' => 0, 'message' => '订单已支付']);
        }

        if ($orderInfo->total_price <= 0) {
            $this->jsonReturn(['status' => 0, 'message' => '订单金额异常']);
        }

        //组建待签名参数数组
        $payOrder = [
            'version' => '1.0',
            'customerid' => $this->payAppId, //商户应用编号
            'total_fee' => number_format($orderInfo->total_price, 2, '.', ''), //订单金额
            'sdorderno' => $orderId, //商户订单号,不超过20位数
            'notifyurl' => $this->notifyUrl //异步通知地址
        ];

        //生成待签名字符串
        $signString =  urldecode(http_build_query($payOrder)) . "&" . $this->paySecret;

        $payOrder['sign'] = md5($signString);
        $payOrder['paytype'] = $this->payType[$payType] ?? $this->payType['2'];

        $this->jsonReturn(['status' => 1, 'message' => '下单成功', 'pay_url' => $this->payUrl . '?' . http_build_query($payOrder)]);
    }

    /**
     * 异步通知
     *
     * @param Request $request
     * @author varro
     */
    public function payNotify(Request $request)
    {
        $data = $request->all();
        error_log(date('Y-m-d H:i:s') . PHP_EOL . json_encode($data) . PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT'] . '/paynotify.log');

        $orderInfo = DB::table('shop_orders')->where('order_id', $data['sdorderno'])->first();
        if (empty($orderInfo)) {
            exit('error');
        }

        //待签名参数
        $signParams = [
            'customerid' => $this->payAppId, //商户id号
            'status' => $data['status'], //「订单状态」: 0失败, 1成功
            'sdpayno' => $data['sdpayno'], //支付金额
            'sdorderno' => $data['sdorderno'], //支付状态: 20支付成功, 其他为未知
            'total_fee' => number_format($data['total_fee'], 2, '.', ''), //订单金额
            'paytype' => $data['paytype'], //支付状态: 20支付成功, 其他为未知
        ];

        //签名方式: version={value}&customerid={value}&total_fee={value}&sdorderno={value}&notifyurl={value}&apikey
        $sign = md5(urldecode(http_build_query($signParams) . '&' . $this->paySecret));
        if ($data['sign'] != $sign) {
            exit('error');
        }

        if ($data['status'] != 1) {
            exit('error');
        }

        if ($orderInfo->pay_status == -1) {
            exit('error');
        }

        if ($orderInfo->pay_status == 1) {
            exit('ok');
        }

        if ($orderInfo->total_price != $data['total_fee']) {
            exit('error');
        }

        DB::table('shop_orders')->where('id', $orderInfo->id)->update(['pay_status' => 1, 'state' => 2]);
        exit('ok');
    }

    /**
     * 物流详情
     *
     * @param Request $request
     * @author varro
     */
    public function expressDetail(Request $request)
    {
        $orderId = $request->input('orderid');
        if (empty($orderId)) {
            $this->jsonReturn(['status' => 0, 'message' => '订单号为空']);
        }

        $orderInfo = DB::table('shop_orders')->where('order_id', $orderId)->first();
        if (empty($orderInfo)) {
            $this->jsonReturn(['status' => 0, 'message' => '订单号不存在']);
        }

        if (empty($orderInfo->logistics)) {
            $this->jsonReturn(['status' => 0, 'message' => '该订单未发货']);
        }

        $host = $this->expressUrl;
        $path = "/kdi";
        $method = "GET";
        $appCode = $this->expressAppCode;
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appCode);
        $query = "no=$orderInfo->logistics";
        $url = $host . $path . "?" . $query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $result = json_decode(curl_exec($curl), true);
        if (empty($result) || $result['status'] != 0) {
            $this->jsonReturn(['status' => 0, 'message' => $result['msg'] ?? '获取物流信息错误']);
        }

        $this->jsonReturn(['status' => 1, 'message' => $result['msg'], 'data' => $result['result']]);
    }
}
