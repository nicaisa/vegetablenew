<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>生鲜网</title>
    <link rel="stylesheet" href="{{asset('/style/home/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('/style/home/css/index.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('/style/home/css/public.css')}}" media="all" >
    <link href="{{asset('/style/home/img/index/logo.png')}}" rel='icon' type='image/x-icon'/>
    <style>
        footer{position: relative;top:1026px;}
    </style>
    @yield('header')
</head>
<body class="vegetableInfo">
<nav>
    <ul class="layui-nav layui-row">
        @if(empty($user_info))
        <li class="layui-nav-item layui-col-xs2 layui-col-sm2 layui-col-md1 login">
            <a href="{{route('homelogin')}}">请登录</a>
        </li>
        <li class="layui-nav-item layui-col-xs1 layui-col-sm1 layui-col-md1 reg">
            <a href="{{route('reg')}}">注册</a>
        <li class="layui-nav-item layui-col-xs1 layui-col-sm2 layui-col-md1 home" id="my-home">
            <a href="{{route('Home')}}">首页</a>
        </li>
        @else
        <li class="layui-nav-item layui-col-xs1 layui-col-sm1 layui-col-md1 user-center" >
            <a href="{{route('myself')}}">个人中心<span class="layui-badge-dot"></span></a>
        </li>
        <li class="layui-nav-item layui-col-xs1 layui-col-sm1 layui-col-md1 my"  id="my">
            <a href=""><img src="{{asset('/uploads/user/'.$user_info->headimg)}}" class="layui-nav-img"><var>{{$user_info->username}}</var></a>
            <dl class="layui-nav-child">
                <dd><a href="{{route('myself')}}">我的信息</a></dd>
                <dd><a href="{{route('home.logout')}}">退出</a></dd>
            </dl>
        </li>
        @endif
        <li class="layui-nav-item layui-col-xs3 layui-col-sm3 layui-col-md1 my-card" style="margin-right: 0px;" id="my-card">
            <a href="{{route('shop_cart')}}"><img src="{{asset('/style/home/img/index/icon-shop-cart.png')}}" class="layui-nav-img" >购物车@if(!empty($user_info))<span class="layui-badge" >{{$cart_count}}</span>@endif</a>
        </li>
        <li class="layui-nav-item layui-col-xs3 layui-col-sm2 layui-col-md1 my-order" id="my-order">
            <a href="{{route('myorder')}}"><img src="{{asset('/style/home/img/index/icon-order.png')}}" class="layui-nav-img">我的订单</a>
        </li>
        <li class="layui-nav-item layui-col-xs1 layui-col-sm1 layui-col-md1 my-collect" id="my-collect">
            <a href="{{route('collect')}}"><img src="{{asset('/style/home/images/wdsc.png')}}" class="layui-nav-img">我的收藏</a>
        </li>
        <li class="layui-nav-item layui-col-xs3 layui-col-sm2 layui-col-md1 net-nav">
            <a href="">
                <img src="{{asset('/style/home/img/index/icon-fen.png')}}" class="layui-nav-img" style="vertical-align: middle;width: 20px;height: 20px">
                网站导航
            </a>
            <dl class="layui-nav-child" style="text-indent: 10px;">
                @if(!empty($goods_type))
                    @foreach($goods_type as $v)
                <dd><a href="{{route('show',['id'=>$v->id])}}">{{$v->name}}</a></dd>
                    @endforeach
                @endif
            </dl>
        </li>
    </ul>
</nav>

@yield('content')
<footer class="footer" >
    <ul class="layui-clear">
        <li>
            <span>服务保证</span>
            <ul>
                <li>正品保证</li>
                <li>绿色新鲜</li>
                <li>按时送达</li>
                <li>7&#215;15小时客户服务</li>
            </ul>
        </li>
        <li>
            <span>支付方式</span>
            <ul>
                <li>在线支付</li>
                <li>货到付款</li>
                <li>分期付款</li>
                <li>转账付款</li>
            </ul>
        </li>
        <li>
            <span>商家服务</span>
            <ul>
                <li>商家入驻</li>
                <li>广告服务</li>
                <li>服务市场</li>
                <li>培训中心</li>
            </ul>
        </li>
        <li>
            <span>物流配送</span>
            <ul>
                <li>免配送费</li>
                <li>211限时达</li>
                <li>专人配送</li>
                <li>EMS</li>
            </ul>
        </li>
        <li><div><img src="{{asset('/style/home/img/index/bg-code.png')}}"></div></li>
    </ul>
    <div class="lg-footer J-loginLanguage">
        <!--copyright start-->
        <div class="copyright">
            <p class="tag-line">
                Copyright &copy; 2017<script>
                    new Date().getFullYear()>2017&&document.write("-"+new Date().getFullYear());
                </script>
                <span>蒋中梅&nbsp;版权所有</span>
            </p>
        </div>
    </div>
</footer>
<script type="text/javascript" src="{{asset('/style/home/layui/layui.js')}}" ></script>
<script type="text/javascript" src="{{asset('/style/home/js/address/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/style/home/js/public/base.js')}}"></script><!--小广告-->
<script src="{{asset('/style/home/js/public/adaptive.js')}}" charset="utf-8"></script><!--rem-->
<script src="{{asset('/style/home/js/public/config.js')}}" charset="utf-8"></script><!--rem-->
@yield('script')
</body>
</html>
