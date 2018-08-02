@extends('home/layouts.head')

@section('header')
        <link rel="stylesheet" href="{{asset('/style/home/css/userInfo.css')}}" media="all" >
        <link rel="stylesheet" href="{{asset('/style/home/css/city-picker.css')}}" media="all" >
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
                            <li class="menu_group_list"><a href="{{route('myorder')}}"><i class="my-order"></i>我的订单</a></li>
                            <li class="menu_group_list"><a href="{{route('address')}}" class="hover"><i class="my-address"></i>收货地址</a></li>
                        </ul>
                    </div>
                    <!-- 右边  我的资料 -->
                    <div class="user_center_right">
                        <div class="user_mian_bar">
                            <p class="user_mian_bar_tit "><span>收货地址</span></p>
                            <div class="form-box">
                                <div></div>
                                <div class='item item-title '>
                                    <span class="item-label tsl">新增收货地址</span>
                                    <i></i>
                                </div>
                                <input type="hidden" id="address_id" value="{{ $address_id }}">

                                <form class="layui-form">
                                    <div class="layui-form-item" data-info="所在地区">
                                        <label class="layui-form-label">所在地区<i>*</i></label>
                                        <div class="layui-input-block"><!--data-toggle="city-picker" -->
                                            <input id="city-picker" class="cityPicker" size="70" data-toggle="city-picker"  name="title" lay-verify="title"  autocomplete="off" placeholder="点击从下拉面板中选择省/市/区/县" class="layui-input" type="text" value="北京/朝阳区/三环以内" data-value="">
                                            <!--<input id="set" type="button" value="重置" class="layui-btn layui-btn-normal">-->
                                        </div>
                                    </div>
                                    <div class="layui-form-item layui-form-text" data-info="详细地址">
                                        <label class="layui-form-label">详细地址<i>*</i></label>
                                        <div class="layui-input-block">
                                            <textarea id="detail-text" placeholder="请输入内容" class="layui-textarea"></textarea>
                                        </div>
                                    </div>
                                    <div class="layui-form-item" data-info="收货人">
                                        <label class="layui-form-label">收货人姓名<i>*</i></label>
                                        <div class="layui-input-block">
                                            <input name="title" lay-verify="title" autocomplete="off" placeholder="长度不超过25个字符" class="layui-input" type="text">
                                        </div>
                                    </div>
                                    <div class="layui-inline" data-info="手机">
                                        <label class="layui-form-label">手机号码<i>*</i></label>
                                        <div class="layui-input-inline">
                                            <input  id="phone" name="phone" lay-verify="required|phone" autocomplete="off" class="layui-input" type="tel">
                                        </div>
                                    </div>
                                    <div class="layui-inline set-default-address">
                                        <img src="{{asset('/style/home/img/checkbox_false.png')}}" >
                                        <label class="layui-form-label" >设置为默认收货地址</label>
                                    </div>
                                </form>
                                <div  class="form-item set">
                                    <button class="btn" id="save-address">保存</button>
                                    <button class="btn" id="clear-address">重置</button>
                                </div>
                            </div>
                            <div class="deliver-address">
                                <div class="caption mtb10">已保存了{{count($address)}}条地址，还能保存{{20-count($address)}}条地址</div>
                                <table class="layui-table" lay-skin="line">
                                    <colgroup>
                                        <col width="100">
                                        <col width="150">
                                        <col width="200">
                                        <col width="80">
                                        <col width="200">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>收货人</th>
                                        <th>所在地区</th>
                                        <th>详细地址</th>
                                        <th>手机</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>

                                    @if($address)
                                    <tbody>
                                    @foreach($address as $v)
                                    <tr>
                                        <td>{{$v->name}}</td>
                                        <td>{{str_replace(',',' ',$v->region)}}</td>
                                        <td>{{$v->address}}</td>
                                        <td>{{$v->tel}}</td>
                                        <td>
                                            <div class="btn-box">
                                                <input hidden  value="{{ $v->address_id }}">
                                                <button class="layui-btn layui-btn-xs modify"><i class="layui-icon"></i></button>
                                                <button class="layui-btn layui-btn-xs layui-btn-danger delete"><i class="layui-icon"></i></button>
                                            </div>
                                            @if($v->default==1)
                                                <span class="note">默认地址</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    @endif
                                </table>
                                <input hidden id="csrf-token" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
@stop
@section('script')
        <script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.data.js')}}"></script>
        <script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.js')}}"></script>
        <script type="text/javascript" src="{{asset('/style/home/js/userInfo.js')}}"></script>
        <script type="text/javascript">
            //设置底部
            $('footer').css({"position":'relative','top':$('.user_center_main_box ').outerHeight(true)+'px'});
        </script>
@endsection
