@extends('home/layouts.head')

@section('header')
    <link rel="stylesheet" href="{{asset('/style/home/css/userInfo.css')}}" media="all" >
    <link rel="stylesheet" href="{{asset('/style/home/css/order.css')}}" />
    <link rel="stylesheet" href="{{asset('/style/home/css/city-picker.css')}}"  media="all"/><!--地址联动样式-->
    <style>
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
                <!-- 右边  我的订单 -->
                <div class="user_center_right">
                    <div class="user_mian_bar">
                        <p class="user_mian_bar_tit "><span>我的订单</span></p>
                    </div>
                    <div class="order-box" style="margin: 10px 50px 0px 50px;">

                        <div class="order-tit">
                            <div class="order-tit-list">
                                <a class="order-tit-text order-tit-selected" href="javascript: getArr(0)">所有订单<var class="order_count-0">{{$order_count[0]}}</var></a>
                                <span class="order-tit-line">|</span>
                            </div>
                            <div class="order-tit-list">
                                <a class="order-tit-text" href="javascript: getArr(1)">待付款<var class="order_count-1">{{$order_count[1]}}</var></a>
                                <span class="order-tit-line">|</span>
                            </div>
                            <div class="order-tit-list">
                                <a class="order-tit-text" href="javascript: getArr(2)">待发货<var class="order_count-2">{{$order_count[2]}}</var></a>
                                <span class="order-tit-line">|</span>
                            </div>
                            <div class="order-tit-list">
                                <a class="order-tit-text" href="javascript: getArr(3)">待收货<var class="order_count-3">{{$order_count[3]}}</var></a>
                                <span class="order-tit-line">|</span>
                            </div>
                            <div class="order-tit-list">
                                <a class="order-tit-text" href="javascript: getArr(4)">待评价<var class="order_count-4">{{$order_count[4]}}</var></a>
                                <span class="order-tit-line">|</span>
                            </div>
                            <div class="order-tit-list">
                                <a class="order-tit-text" href="javascript: getArr(5)">已完成<var class="order_count-5">{{$order_count[5]}}</var></a>
                                <span class="order-tit-line">|</span>
                            </div>
                        </div>
                        <ul class="order-tishi layui-row layui-clear">
                            <li class="layui-col-sm5">宝贝</li>
                            <li class="layui-col-sm1">单价</li>
                            <li class="layui-col-sm1">数量</li>
                            <!--<li class="layui-col-sm1">商品操作</li>-->
                            <li class="layui-col-sm1">实付款</li>
                            <li class="layui-col-sm1">交易状态</li>
                            <li class="layui-col-sm3">交易操作</li>
                        </ul>
                        <div class="order-list-box" id="order_list_div">
                            {{--我的订单主体数据开始--}}
                            {{--结束--}}
                        </div>
                        <div id="orderPage"></div>
                    </div>
                </div>
            </div>
        </div>

            <input hidden id="order_page" value="1">
    </section>
@stop
@section('script')

    <script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.data.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('/style/home/js/userInfo.js')}}" charset="utf-8"></script>
    <script>

        //去支付
        function toPay(order_id) {
            var id=order_id;
            var payway = 1;
            var url='{{ route('pay') }}';
            $.post(url,{'order_id':id, 'payway':payway, '_token': '{{csrf_token()}}'},function (reg) {
                if(reg.status==1){
                    window.location.href=reg.pay_url;
                }else{
                    alert(reg.message);
                }
            },'json')
        }
        //确认收货
        function ConfirmReceipt(order_id) {
            var id=order_id;
            var url='{{ route('ConfirmReceipt') }}';
            $.post(url,{'order_id':id, '_token': '{{csrf_token()}}'},function (reg) {
                if(reg.code==1){
                    alert(reg.message);
                    location.reload();
                }else{
                }
            },'json')
        }


        $(".commodity-operate>button").on("click",function () {
            if($(this).attr("data-state")==1){//"去支付"跳转到确认支付页面
                var goods_id=$(this).attr("data-goodId");
                var url = '{{route('order_confirm')}}'+'?goods_id='+goods_id;
                var goods_num = 1;
                url += '&goods_num='+goods_num;
            }
        })
        function orderDetail(order_id) {
            location.href = '{{route('orderDetail')}}'+'?order_id='+order_id;
        }
        //设置底部
        //$('footer').css({"position":'relative','top':$('.user_center_main_box ').outerHeight(true)+'px'});
        function getArr(type) {
            /*查询 */
            var url = '{{route('get_order_list')}}';
            var page = $("#order_page").val();
            $.ajax(url,{
                data:{
                    '_token': '{{csrf_token()}}',
                    'type': type,
                    'page': page
                },
                type:'post',
                success: function (result) {
                    var count = result.total;
                    var data = result.order_list;
                    $(".order_count-"+type).html(count);    //订单数
                    layui.use(['laypage', 'layer'], function(){
                        var laypage = layui.laypage,layer = layui.layer;
                        laypage.render({
                            elem: 'orderPage'//指向存放分页的容器
                            ,count: count//数据总数
                            ,limit: 5//每页显示的条数
                            ,layout: ['count', 'prev', 'page', 'next', 'skip']//自定义排版。可选值有：count（总条目输区域）、prev（上一页区域）、page（分页区域）、next（下一页区域）、limit（条目选项区域）、 、skip（快捷跳页区域）
                            ,curr: location.hash.replace('#page=', '') //获取hash值为fenye的当前页
                            ,hash: 'page' //自定义hash值
                            ,theme: '#30940E'//自定义主题
                            ,jump: function(obj){
                                $("#order_page").val(obj.curr);
                                document.getElementById('order_list_div').innerHTML = function(){
                                    var arr = [],
                                        thisData = data.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                    var order_Html = '';
                                    layui.each(thisData, function(index, item){
                                        var order_id=item.order_id;//订单号
                                        var orderId_lock=item.orderId_lock;//订单号加密
                                        var create_time=item.create_time;//下单时间
                                        var total_price=item.total_price;//订单金额
                                        var Consignee=item.Consignee;//收货人
                                        var address=item.region+item.address;//收货地址
                                        var state=item.state;//订单状态
                                        var user_state = '';
                                        var order_state = '';
                                        switch (state){
                                            case 1:user_state = '未付款';
                                                order_state = '<button data-state="1" data-goodid="" onclick="toPay(\''+order_id+'\')">\n' +
                                                    '              去支付\n' +
                                                    '          </button>';
                                                break;
                                            case 2:user_state = '待发货';
                                                order_state = '<button data-state="1" data-goodid="" >\n' +
                                                    '              催促发货\n' +
                                                    '          </button>';
                                                break;
                                            case 3:user_state = '待收货';
                                                order_state = '<button data-state="1" data-goodid="" onclick="ConfirmReceipt(\''+order_id+'\')">\n' +
                                                    '              确认收货\n' +
                                                    '          </button>';
                                                break;
                                            case 4:user_state = '已收货';
                                                order_state = '<button data-state="1" data-goodid="" >\n' +
                                                    '              去评价\n' +
                                                    '          </button>';
                                                break;
                                            case 5:user_state = '已完成';
                                                order_state = '<button data-state="1" data-goodid="" >\n' +
                                                    '              已完成\n' +
                                                    '          </button>';
                                                break;
                                        }

                                        var tel=item.tel;//联系电话
                                        order_Html += '<div class="order-list">\n' +
                                            '     <div class="layui-row" style="cursor: pointer;margin-top: 10px">\n' +
                                            '         <div onclick="orderDetail(\''+orderId_lock+'\')">\n' +
                                            '             <div class="layui-col-sm5">\n' +
                                            '                 <div>\n' +
                                            '                     <label>订单编号：</label>\n' +
                                            '                     <var>'+order_id+'</var>\n' +
                                            '                 </div>\n' +
                                            '                 <div>\n' +
                                            '                     <label>下单时间：</label>\n' +
                                            '                     <time>'+create_time+'</time>\n' +
                                            '                 </div>\n' +
                                            '                 <div>\n' +
                                            '                     <label>订单金额：</label>\n' +
                                            '                     <var>'+total_price+'</var>\n' +
                                            '                 </div>                                            </div>\n' +
                                            '             <div class="layui-col-sm5">\n' +
                                            '                 <div>\n' +
                                            '                     <label>收货人：</label>\n' +
                                            '                     <var>'+Consignee+'</var>\n' +
                                            '                 </div>\n' +
                                            '                 <div>\n' +
                                            '                     <label>收货地址：</label>\n' +
                                            '                     <var>'+address+'</var>\n' +
                                            '                 </div>\n' +
                                            '                 <div>\n' +
                                            '                     <label>联系电话：</label>\n' +
                                            '                     <var>'+tel+'</var>\n' +
                                            '                 </div>\n' +
                                            '             </div>\n' +
                                            '         </div>\n' +
                                            '         <div class="layui-col-sm2" style="float:right;margin-top: -80px">\n' +
                                            '             <div class="layui-row">\n' +
                                            '                 <div class="commodity-status">\n' +
                                            '                     <span data-state="1">\n' +
                                            '                       '+user_state+'\n' +
                                            '                     </span>\n' +
                                            '                 </div>\n' +
                                            '             </div>\n' +
                                            '             <div class="layui-row">\n' +
                                            '                 <div class="commodity-operate">\n' +
                                            '                     <button data-state="1" data-goodid="">\n' +
                                            '                        '+order_state+'\n' +
                                            '                     </button>\n' +
                                            '                 </div>\n' +
                                            '             </div>\n' +
                                            '         </div>\n' +
                                            '     </div>\n' +
                                            '  </div>'
                                    });
                                    arr.push(order_Html);
                                    return arr.join('');
                                }();
                            }
                        });
                    });
                },
                dataType:'json'
            });
        }

        getArr(0);
    </script>
@endsection
