@extends('home/layouts.head')

@section('header')
    <link  rel="stylesheet" href="{{asset('/style/home/css/search.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('/style/home/css/userInfo.css')}}">
    <style>
        .view .product{width: 200px;}
        footer{position: relative;top:1026px;}
    </style>
@stop
@section('content')
    <section>
        <div style="display: none;">
            <input class="cityPicker" size="70" data-toggle="city-picker"  name="title" lay-verify="title"  autocomplete="off" placeholder="点击从下拉面板中选择省/市/区/县" class="layui-input" type="text" value="重庆/南岸区/内环以内" data-value="" style="display: none;">
        </div>
        <div class="user_center_main">
            <!--  用户信息框分为 左边右边  -->
            <div class="user_center_main_box layui-clear">
                <!-- 左边  -->
                <div class="user_center_left">
                    <p class="menu_tit">账号信息</p>
                    <ul class="menu_group ">
                        <li class="menu_group_list "><a href="{{route('myself')}}"><i class="my-info"></i>我的资料</a></li>
                        <li class="menu_group_list"><a href="{{route('collect')}}" class="hover"><i class="my-collection" class="#"></i>我的收藏</a></li>
                        <li class="menu_group_list"><a href="{{route('shop_cart')}}" ><i class="my-card"></i>我的购物车</a></li>
                    </ul>
                    <p class="menu_tit">账号记录</p>
                    <ul class="menu_group ">
                        <li class="menu_group_list"><a href="{{route('myorder')}}"><i class="my-order"></i>我的订单</a></li>
                        <li class="menu_group_list"><a href="{{route('address')}}"><i class="my-address"></i>收货地址</a></li>
                    </ul>
                </div>
                <!-- 右边  我的收藏 -->
                <div class="user_center_right"  style="width: 670px;">
                    <div class="user_mian_bar">
                        <p class="user_mian_bar_tit " style="width: 100px;"><span>我的收藏</span></p>
                        <div id="view" class="view layui-clear" style="width: 670px;">
                        </div>
                        <div id="collectPage"></div>
                        <input hidden id="collect_page" value="1">
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
    <script type="text/javascript" >
        //添加数据
        //var table = document.body.querySelector('.view');
        //var cells = document.body.querySelectorAll('.product');
        function getArr() {
            /*查询 */
            var url = '{{route('get_collect_list')}}';
            var page = $("#collect_page").val();
            console.log(page);
            $.ajax(url,{
                data:{
                    '_token': '{{csrf_token()}}',
                    'page': page
                },
                type:'post',
                success: function (result) {
                    var count = result.total;
                    var data = result.collect_list;
                    layui.use(['laypage', 'layer'], function(){
                        var laypage = layui.laypage,layer = layui.layer;
                        laypage.render({
                            elem: 'collectPage'//指向存放分页的容器
                            ,count: count//数据总数
                            ,limit: 9//每页显示的条数
                            ,layout: ['count', 'prev', 'page', 'next', 'skip']//自定义排版。可选值有：count（总条目输区域）、prev（上一页区域）、page（分页区域）、next（下一页区域）、limit（条目选项区域）、 、skip（快捷跳页区域）
                            ,curr: location.hash.replace('#page=', '') //获取hash值为fenye的当前页
                            ,hash: 'page' //自定义hash值
                            ,theme: '#30940E'//自定义主题
                            ,jump: function(obj){
                                $("#collect_page").val(obj.curr);
                                document.getElementById('view').innerHTML = function(){
                                    var arr = [],
                                        thisData = data.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                    var collect_Html = '';
                                    layui.each(thisData, function(index, item){
                                        var collect_id=item.id;//图片路径
                                        var imgSrc=item.useimg;//图片路径
                                        var type_id=item.goods_type;//商品分类
                                        var goodsid=item.goods_id;//商品id
                                        var price=item.price;//价格
                                        var goodsurl='{{route("goodsDeatil")}}'+'?id='+goodsid+'&typeid='+type_id;
                                        var introduce=item.describe;//介绍
                                        collect_Html += '<div class="product" style="height: 225px;">';
                                        collect_Html += '<div class="product-iWrap">';
                                        collect_Html +='<div class="productImg-wrap"><a  href="'+goodsurl+'">';
                                        collect_Html +='<img class="" src="'+imgSrc+'" width="210px" height="140px"></a>';
                                        collect_Html +='<p class="productPrice"><em title="'+price+'"><b>¥</b>'+price+'</em><button onclick="remove_collect('+collect_id+',this)" class="layui-btn layui-btn-danger layui-btn-xs" style="float: right;margin: 5px 5px 0px"><i class="layui-icon"></i></button></p>';
                                        collect_Html +=introduce;
                                        collect_Html +='</div></div>';
                                        collect_Html +='</div>';
                                    });
                                    arr.push(collect_Html);
                                    return arr.join('');
                                }();
                            }
                        });
                    });
                },
                dataType:'json'
            });
        }

        /* 移出收藏夹 */
        function remove_collect(collect_id,obj) {
            var url = '{{route('remove_collect')}}';
            var _this = obj;
            $.ajax(url,{
                data:{
                    '_token': '{{csrf_token()}}',
                    'collect_id': collect_id
                },
                type:'post',
                success: function (result) {
                    layer.alert(result.message, {
                        skin: 'layui-layer-lan'
                        ,closeBtn: 0
                        ,anim: 4 //动画类型
                    });
                    $(_this).parent().parent().parent().parent().css('display','none')
                },
                dataType:'json'
            });
        }
        getArr();
        //设置底部
        $('footer').css({"position":'relative','top':$('.user_center_main_box ').outerHeight(true)+'px'});
    </script>
@endsection
