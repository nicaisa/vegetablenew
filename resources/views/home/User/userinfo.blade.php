@extends('home/layouts.head')

@section('header')
    <link rel="stylesheet" href="{{asset('/style/home/css/userInfo.css')}}" media="all" >
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
                        <li class="menu_group_list "><a href="{{route('myself')}}" class="hover"><i class="my-info"></i>我的资料</a></li>
                        <li class="menu_group_list"><a href="{{route('collect')}}"><i class="my-collection" class="#"></i>我的收藏</a></li>
                        <li class="menu_group_list"><a href="{{route('shop_cart')}}"><i class="my-card"></i>我的购物车</a></li>
                    </ul>
                    <p class="menu_tit">账号记录</p>
                    <ul class="menu_group ">
                        <li class="menu_group_list"><a href="{{route('myorder')}}"><i class="my-order"></i>我的订单</a></li>
                        <li class="menu_group_list"><a href="{{route('address')}}"><i class="my-address"></i>收货地址</a></li>
                    </ul>
                </div>
                <!-- 右边  我的资料 -->
                <div class="user_center_right">
                    <ul class="avatar_box_ul">
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/1.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/2.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/3.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/4.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/5.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/6.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/7.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/8.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/9.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/10.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/11.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/12.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/13.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/15.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/16.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/17.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/18.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/19.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/20.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/21.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/22.jpg')}}"></span></li>
                        <li class="avatar_box_list"><span><img src="{{asset('uploads/user/23.jpg')}}"></span></li>
                        <li class="avatar_box_list layui-upload" id="upload_avatar"><span><img src="{{asset('uploads/user/up_photo_01.png')}}">上传头像</span></li>
                        <li class="avatar_box_close"><b class="avatar_box_close_btn">关闭</b></li>
                        <p id="demoText"></p>
                    </ul>
                    <input type="hidden" name="_method" value="post"/>
                    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                    <input type="hidden" name="avatar" value="">
                    <div class="user_mian_bar">
                        <p class="user_mian_bar_tit "><span>我的资料</span></p>
                        <ul class="user_mian_bar_box">
                            <input type="hidden" name="headimg" value="{{'cache/'.$user_info->headimg}}">
                            <li class="user_mian_bar_list"><span class="txt">头像：</span><span class="inf"><img src="{{asset('uploads/user/'.$user_info->headimg)}}" id="avatar"> </span><img src="{{asset('uploads/user/5.jpg')}}" class="layui-upload-img" id="edit-avatar"></li>
                            <li class="user_mian_bar_list"><span class="txt">昵称：</span><span class="inf">{{$user_info->nickname}}</span><input name="nickname" type="text" ></li>
                            <li class="user_mian_bar_list">
                                <span class="txt">性别：</span>
                                <span class="inf" >@if($user_info->sex==1) 男@else 女@endif</span>
                                <div class="sex-box">
                                    <input name="sex" type="radio" value="1" @if($user_info->sex==1) checked @endif><label>男</label>
                                    <input name="sex" type="radio" value="0" @if($user_info->sex==1) checked @endif><label>女</label>
                                </div>
                            </li>
                            <li class="user_mian_bar_list"><span class="txt">电话：</span><span class="inf">{{$user_info->phone}}</span><input name="phone" type="text" ></li>
                            <li class="user_mian_bar_list"><span class="txt">用户名：</span><span class="inf">{{$user_info->username}}</span><input name="username" type="text" ></li>
                            <li class="user_mian_bar_list">
                                <span class="txt">生日：</span>
                                <span class="inf">@if(empty($user_info->birthday))未填写@else{{$user_info->birthday}}@endif</span>
                                <div class="layui-input-inline" >
                                    <input class="layui-input" id="birthday" name="birthday" placeholder="yyyy-MM-dd" type="text" value="yyyy-MM-dd">
                                </div>
                            </li>
                            <li class="user_mian_bar_list ">
                                <span class="txt">居住地：</span>
                                <span class="inf">@if(empty($user_info->address))未填写@else{{$user_info->address}}@endif</span>
                                <div class="address"><!--data-toggle="city-picker" -->
                                    <input id="abode" class="cityPicker" size="70" data-toggle="city-picker"  name="address" lay-verify="title"  autocomplete="off" placeholder="点击从下拉面板中选择省/市/区/县" class="layui-input" type="text" value="重庆/南岸区/内环以内" data-value="">
                                </div>
                            </li>
                            <li class="user_mian_bar_list btn_box"><a href="javascript:void(0)" class="chang_btn" >修改</a><a href="javascript:void(0)" class="chang_btn" onclick="seave_user();">保存</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script src="{{asset('style/home/js/address/city-picker.data.js')}}"></script>
    <script src="{{asset('style/home/js/address/city-picker.js')}}"></script>
    <script src="{{asset('style/home/js/userInfo.js')}}"></script>
    <script type="text/javascript">
        //设置底部
        $('footer').css({"position":'relative','top':$('.user_center_main_box ').outerHeight(true)+'px'});
        /*上传头像*/
        var img='';
       layui.use('upload', function(){
            var $ = layui.jquery
                ,upload = layui.upload;
            //普通图片上传
            var uploadInst = upload.render({
                elem: '#upload_avatar'
                ,url: "{{route('headimg_upload')}}"
                ,data:{
                    _token:"{{ csrf_token()}}",
                    _method:"post"
                }
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                       $('#edit-avatar').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    console.log(res);
                    //上传成功
                    //status=1代表上传成功,获取上传图片的名字
                    if(res.status ==  1){
                        var url=res.message;
                        url=url.substr(url.indexOf('cache'));
                        img=url;
                        $(".user_mian_bar_box input[name='headimg']").val(img);
                    }else{
                        //演示失败状态，并实现重传
                        var demoText = $('#demoText');
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function(){
                            uploadInst.upload();
                        });
                    }
                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });
        });
        /*修改个人信息*/
        function seave_user() {
            var url = '{{route('seave_user')}}';
            var nickname = $(".user_mian_bar_box input[name='nickname']").val();
            var phone = $(".user_mian_bar_box input[name='phone']").val();
            var username = $(".user_mian_bar_box input[name='username']").val();
            var sex = $(".user_mian_bar_box input[name='sex']").val();
            var birthday = $(".user_mian_bar_box input[name='birthday']").val();
            var address = $(".user_mian_bar_box input[name='address']").val();
            var headimg = $(".user_mian_bar_box input[name='headimg']").val();
            console.log(nickname,phone,username,sex,birthday,address);
//            return false;
            $.ajax(url,{
                data:{
                    '_token': '{{csrf_token()}}',
                    'nickname': nickname,
                    'phone': phone,
                    'sex': sex,
                    'birthday': birthday,
                    'username': username,
                    'headimg': headimg,
                    'address': address
                },
                type:'post',
                success: function (data) {
                    console.log(data);
                },
                dataType:'json'
            });
        }
    </script>
@endsection

