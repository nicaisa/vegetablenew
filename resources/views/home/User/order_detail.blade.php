@extends('home/layouts.head')

@section('header')
    <link rel="stylesheet" href="{{asset('/style/home/css/userInfo.css')}}">
    <link rel="stylesheet" href="{{asset('/style/home/css/shopcard.css')}}">
    <link rel="stylesheet" href="{{asset('/style/home/css/city-picker.css')}}"  media="all"/><!--地址联动样式-->
    <style>
        th,tr{text-align: left;}
        footer{position: relative;top:1026px;}
    </style>
    @stop
    @section('content')

<section>
    <div class="user_center_main">
        <!--  用户信息框分为 左边右边  -->
        <div class="user_center_main_box layui-clear">
            <!-- 左边  -->
            <div class="user_center_left">
                <p class="menu_tit">账号信息</p>
                <ul class="menu_group ">
                    <li class="menu_group_list "><a href="{{route('myself')}}"><i class="my-info"></i>我的资料</a></li>
                    <li class="menu_group_list"><a href="{{route('collect')}}"><i class="my-collection" class="#"></i>我的收藏</a></li>
                    <li class="menu_group_list"><a href="{{route('shop_cart')}}"><i class="my-card"></i>我的购物车</a></li>
                </ul>
                <p class="menu_tit">账号记录</p>
                <ul class="menu_group ">
                    <li class="menu_group_list"><a href="{{route('myorder')}}" class="hover"><i class="my-order"></i>我的订单</a></li>
                    <li class="menu_group_list"><a href="{{route('address')}}"><i class="my-address"></i>收货地址</a></li>
                </ul>
            </div>
            <!-- 右边  订单信息详情 -->
            <div class="user_center_right" style="height: 1300px">
                <div class="user_mian_bar" style="width:773px">
                    <p class="user_mian_bar_tit "><span>订单详情</span></p>
                    <table class="layui-table" lay-even="" lay-skin="nob">
                        <colgroup>
                            <col width="300">
                            <col width="400">
                            <col>
                        </colgroup>
                        <tbody>
                        <tr>
                            <td>时间</td>
                            <td>{{date('Y-m-d H:i:s', $order_info->create_time)}}</td>
                        </tr>
                        <tr>
                            <td>订单编号</td>
                            <td>{{$order_info->order_id}}</td>
                        </tr>
                        <tr>
                            <td>收货人</td>
                            <td>{{$order_info->Consignee}}</td>
                        </tr>
                        <tr>
                            <td>电话</td>
                            <td>{{$order_info->tel}}</td>
                        </tr>
                        <tr>
                            <td>收货地址</td>
                            <td>{{$order_info->region}}</td>
                        </tr>
                        <tr>
                            <td>收货详细地址</td>
                            <td>{{$order_info->address}}</td>
                        </tr>
                        <tr>
                            <td>总价</td>
                            <td>&#165;{{$order_info->total_price}}</td>
                        </tr>
                        <tr>
                            <td>状态</td>
                            @if($order_info->state == 1)
                                <td>未付款</td>
                            @elseif($order_info->state == 2)
                                <td>待发货</td>
                            @elseif($order_info->state == 3)
                                <td>已发货</td>
                            @elseif($order_info->state == 4)
                                <td>已收货</td>
                            @else
                                <td>已完成</td>
                            @endif
                        </tr>
                        <tr>
                            <td>留言</td>
                            @if(empty($order_info->remark))
                                <td>没有留言</td>
                            @else
                                <td>{{$order_info->remark}}</td>
                            @endif
                        </tr>
                        <tr>
                            <td>物流</td>
                            <td>
                                <button class="layui-btn" style="background: #31950E;" name="wl" data-state="" data-order-id="{{$order_info->order_id}}">查看物流 </button>
                            </td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td>操作</td>--}}
                            {{--<td>--}}
                                {{--<button class="layui-btn" style="background: #31950E;" data-state="">--}}
                                {{--@if($order_info->state == 1)--}}
                                   {{--去支付--}}
                                {{--@elseif($order_info->state == 2)--}}
                                    {{--提醒发货--}}
                                {{--@elseif($order_info->state == 3)--}}
                                    {{--确认收货--}}
                                {{--@elseif($order_info->state == 4)--}}
                                    {{--去评价--}}
                                {{--@else--}}
                                    {{--已完成--}}
                                {{--@endif--}}
                                {{--</button>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        </tbody>
                    </table>
                    <div class="cart-layout-TB " style="width: 773px">
                        <div id="J_Cart" class="cart">
                            <div id="J_FilterBar" class="cart-filter-bar">
                                <div class="wrap-line">
                                </div>
                            </div>
                            <div id="J_CartMain" class="cart-main">
                                <div class="cart-table-th">
                                    <div class="wp">
                                        <div class="th th-item">
                                            <div class="td-inner">商品信息</div>
                                        </div>
                                        <div class="th th-price">
                                            <div class="td-inner">单价</div>
                                        </div>
                                        <div class="th th-amount">
                                            <div class="td-inner">数量</div>
                                        </div>
                                        <div class="th th-sum">
                                            <div class="td-inner">金额</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="" id="J_OrderList">
                                    <div id="J_OrderHolder_s_1782727258_1" style="height: auto;">
                                        <div class="J_Order layui-clear order-body">
                                            <div class="order-content">
                                                <div  class="item-list">
                                                    <div   class="bundle  bundle-last ">
                                                        <div  class="item-holder">
                                                            <div class="J_ItemBody item-body layui-clear item-normal  first-item ">
                                                                @foreach($order_goods_info as $value)
                                                                    <ul class="item-content layui-clear ">
                                                                        <li class="td td-item">
                                                                            <div class="td-inner">
                                                                                <div class="item-pic J_ItemPic img-loaded">
                                                                                    <a href="#" target="_blank" data-title="" class="J_MakePoint" data-point="tbcart.8.12" data-spm-anchor-id="a1z0d.6639537.1997196601.3">
                                                                                        <?PHP $imgs = explode(',',$value->img); ?>
                                                                                        <img src="{{asset('/uploads/goods/'.$imgs[0])}}" class="itempic J_ItemImg">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="item-info">
                                                                                    <div class="item-basic-info">
                                                                                        <a href="#" class="item-title J_MakePoint" target="_blank" title="">{{$value->name}}</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="td td-price">
                                                                            <div class="td-inner">
                                                                                <div class="item-price price-promo-">
                                                                                    <div class="price-content">
                                                                                        <div class="price-line">
                                                                                            <em class="price-original">￥{{$value->goods_price}}</em>
                                                                                        </div>
                                                                                        <div class="price-line">
                                                                                            <em class="J_Price price-now" tabindex="0">￥{{$value->goods_price}}</em>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="td td-amount">
                                                                            <div class="td-inner">
                                                                                <div class="amount-wrapper ">
                                                                                    <div class="item-amount ">
                                                                                        <em class="price-original">{{$value->goods_num}}</em>
                                                                                    </div>
                                                                                    <div class="amount-msg J_AmountMsg">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="td td-sum">
                                                                            <div class="td-inner">
                                                                                <em tabindex="0" class="J_ItemSum number">￥{{$value->total_price}}</em>
                                                                                <div class="J_ItemLottery"></div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="layui-timeline " id="wuLiu" style="width:773px;display: none;">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
    @stop
@section('script')
<script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.data.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('/style/home/js/userInfo.js')}}" charset="utf-8"></script>
<script>
    //设置底部
    $('footer').css({"position":'relative','top':$('.user_center_main_box ').outerHeight(true)+'px'});
    var url = '{{route('expressDetail')}}';
    var orderid = '{{$order_info->order_id}}';
    $.ajax(url,{
        data:{
            'orderid' : orderid,
            '_token': '{{csrf_token()}}'
        },
        type:'post',
        success: function (data) {
            console.log(data);
        },
        dataType:'json'
    });
    //查看物流
    $("button[name='wl']").on('click',function () {
        if($("#wuLiu").children().length==0){
            var orderId=$(this).attr("data-order-id");
            $.post("{{route('expressDetail')}}",{"orderid":orderId,'_token': '{{csrf_token()}}'},function (reg) {
                if(reg.status==1){
                    var data=reg.data.list,str='';
                    for(var i=0;i<data.length;i++){
                        str+="<li class='layui-timeline-item'>" +
                            " <i class=\"layui-icon layui-anim layui-anim-rotate layui-anim-loop layui-timeline-axis\"></i>" +
                            " <div class='layui-timeline-content layui-text'>" +
                            "<h3 class='layui-timeline-title'>"+data[i]['time']+"</h3>"+
                            " <div class='layui-timeline-title'>"+data[i]['status']+"</div>" +
                            " </div>" +
                            " </li>";
                    }
                    str+='<div onclick="hide(this)"><button class="layui-btn" style="background: #31950E;" data-state="">返回</button></div>';
                    $("#wuLiu").html(str).show().prev().hide().prev().hide();
                }
            },'json')
        } else {
            $("#wuLiu").show().prev().hide().prev().hide();
        }
    })
   function hide(obj) {
       $(obj).parent().hide().prev().show().prev().show()
   }

</script>
@endsection
