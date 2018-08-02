$().ready(function(){
    //------------------------------------------我的资料页面---------------------------------
    // #后写的是input框中的id的值,使用地址插件
    if(location.pathname.indexOf("myself")!=-1){
        if($(".cityPicker")){
            $(".cityPicker").citypicker();
        }
    }

    // 获取按钮框，并绑定点击事件，点击时触发
    //$("#set").click(function() {
    /*	对city-picker进行赋值
        注意：在执行赋值之前，必须执行reset和destroy操作*/
    // 获取输入框，并在点击按钮后清空输入框中内容
    /* $("#city-picker").citypicker("reset");
    $("#city-picker").citypicker("destroy");
    $("#city-picker").citypicker({
      province: '江苏省',
      city: '常州市',
      district: '溧阳市'
    });
});*/
    // $('.city-picker-span').css({'width':'500px !importent'})
    /*点击黑色笔显示输入框*/
    $('.user_avatar span i').click(function(){
        $('.user_inf_box_list.avatar_box').show();
    });
    /*右边 点击头像框里面的关闭按钮，关闭头像框*/
    $('.user_center_right .avatar_box_close_btn').click(function(){
        $(this).parent().parent().hide();
    });
    //点击“修改”后，显示用户头像，点击头像显示头像框修改用户头像
    $('#edit-avatar').on({
        click:function(){
            $('.user_center_right .avatar_box_ul').show().css({'z-index':'200','background':'#fff'});
        }
    })
    //点击“修改”后，显示用户头像，点击头像框里面的图片修改头像
    $('.user_center_right .avatar_box_ul>.avatar_box_list').on({
        click:function(){
            //上传用户头像
            if($('.user_center_right .avatar_box_ul>.avatar_box_list').length-1==$(this).index()){
               // var url="//"+location.host+location.pathname.substr(0,location.pathname.indexOf("myself"))+"headimg_upload";
            } else {
                $('#edit-avatar').attr('src',$(this).find('img').attr('src'));
            }
        }
    })
    /*点击绿色笔显示输入框*/
    $('.chang_user_name').click(function(){
        $(this).parent().hide().next().show().removeClass(".change_ni_hide").children('input.chang_ni_input').val($(this).prev('span.chang_ni_txt').html());
        //$(this).parent().siblings();
    });
    /*点击绿色√确认修改昵称*/
    $('.ok').click(function(){
        $(this).parent().hide().prev().show().children('span.chang_ni_txt').html( $(this).prev('input').val());
        //$(this).parent().hide().siblings().show();
    })
    /*点击返回显示昵称*/
    $('.return').click(function(){
        $(this).parent().hide().siblings().show();
    });
    /*在头像框中点击图片改变边框*/
    $('.avatar_box_list span img').click(function(){
        $('.avatar_box_list span').css({"border":"1px solid #ccc"})
        $(this).parent().css({"border":"2px solid #30940E"});
        $('.user_avatar_img>img').attr('src',$(this).attr('src'));
    });
    /*左边的点击事件*/
    $('.menu_group .menu_group_list a').click(function(){
        $('.menu_group .menu_group_list a').removeClass("hover");
        $(this).addClass("hover");
        $('.menu_group .menu_group_list a i').removeClass("hoverd");
        $(this).find('i').addClass('hoverd');
    });
    /*鼠标离开QQ的input框  有错*/
    $('.user_mian_bar_list .inf .ic_ok').blur(function(){
        $(this).show();
    });
    /*隐藏保存按钮*/
    $('.btn_box>a').eq(1).hide();
    $('.user_mian_bar_list').children('div.distpicker').hide();
    //右边 点击“修改”
    $('.btn_box').children('a').eq(0).on({
        click:function(){
            var _this=this;
            $('ul.user_mian_bar_box>li').each(function(){
                var _t=this;
                var  info=$(_t).children('span.inf').html();
                if(info){
                    if($(_t).children('input[type="text"]')){
                        $(_t).children('input[type="text"]').show().val(info).prev().hide();
                    }
                    if($(_t).children('#edit-avatar')){//获取头像
                        $(_t).children('#edit-avatar').attr('src',$('#avatar').attr('src')).show().prev().hide();
                    }
                    if($(_t).children('.sex-box')){//获取性别
                        var sex=$(_t).children('.sex-box').children('input[type="radio"]');
                        sex.each(function(){
                            var _tt=this;
                            if($(_tt).next().html().trim()==info.trim()){
                                $(_tt).next().addClass('check');
                            }else{
                                $(_tt).next().removeClass('check');
                            }
                        })
                        sex.parent().css({'display':'inline-block'}).prev().hide();
                    }
                    if($(_t).find('#birthday')){//获取生日
                        $(_t).find('#birthday').val($(_t).children('span.inf').html()).show().parent().show().prev().hide();
                    }
                    if($(_t).find('#abode')){//居住地
                        gethomeOrabode('abode',_t);
                    }
                    if($(_t).find('#home')){//家乡
                        gethomeOrabode('home',_t);
                    }
                    if($("#birthday").parent().prev().html()=="未填写"){
                        var birthday=new Date(),birth='';
                        var year=birthday.getFullYear(),
                            month=birthday.getMonth()+1,
                            date=birthday.getDate();
                        if(month<10){
                            month="0"+month;
                        }
                        if(date<10){
                            date="0"+date;
                        }
                        birth=year+'-'+month+'-'+date;
                        $("#birthday").val(birth);
                    }
                }

            })
            //显示“保存”，隐藏“修改”
            $(_this).hide().next().show();
        }
    })
    //获取家乡或者居住地
    function gethomeOrabode(id,_t){
        var cityList=$(_t).find('#'+id).next().children('.title').children('.select-item'),
            arrval=$(_t).children('span.inf').html().trim().split("/"),
            i=0;
        for(var v in arrval){
            if(arrval[v]==''){
                arrval.splice(v,1);
            }
        }
        console.log(arrval,13);
        $(_t).find('#'+id).parent().show().css({'marginBottom':'-30px'}).prev().hide();
        if(arrval[0]!='未填写'){
            cityList.each(function(){
                var _city=this;
                $(_city).html(arrval[$(_city).index()]);
                i++;
            })
        }else{
            cityList.each(function(){
                var _city=this;
                $(_city).html('未填写');
            })
        }
    }

    //点击选择性别按钮
    $('.sex-box').children('label').on({
        click:function(){
            $('.sex-box').children('label').removeClass('check');
            $(this).addClass('check');
        }
    })
    //点击保存
    $('.btn_box').children('a').eq(1).on({
        click:function(){
            var _this=this;
            $('ul.user_mian_bar_box>li').each(function(){
                var _t=this;
                if($(_t).children('input')){
                    $(_t).children('span.inf').html($(_t).children('input').val()==''?'未填写':$(_t).children('input').val()).show().next().hide();
                }
                //返回头像
                if($(_t).children('#edit-avatar')){
                    $(_t).children('span.inf').children('#avatar').attr('src',$('#edit-avatar').attr('src'));
                }
                //返回性别
                if($(_t).children('.sex-box')){
                    var sex=$(_t).children('.sex-box').children('input[type="radio"]');
                    sex.each(function(){
                        var _tt=this;
                        if($(_tt).next().attr('class')=='check'){
                            $(_t).children('span.inf').html($(_tt).next().html().trim()).attr("data-sex",$(_tt).val());
                        }
                    })
                }
                //返回生日
                if($(_t).find('#birthday')){
                    $(_t).children('span.inf').html($(_t).find('#birthday').val()==''?'未填写':$(_t).find('#birthday').val());
                }
                //返回居住地
                if($(_t).find('#abode')){
                    returnhomeOrabode('abode',_t);
                }
                //返回家乡
                if($(_t).find('#home')){
                    returnhomeOrabode('home',_t);
                }
            })
            $(_this).hide().prev().show();
            //如果右边头像框显示则隐藏
            if($('.user_center_right>.avatar_box_ul').css('display')=='block'){
                $('.user_center_right>.avatar_box_ul').hide();
            }
        }
    })
    //返回家乡或者居住地
    function returnhomeOrabode(id,_t){
        var cityList=$(_t).find('#'+id).next().children('.title').children('.select-item'),
            val=$(_t).children('span.inf').html(),
            str='';
        cityList.each(function(){
            var _city=this;
            if($(_city).html()=='未填写'){
                str='未填写';
            }else{
                str=str+' '+$(_city).html()+' ';
            }
            $(_t).children('span.inf').html(str);
        })

    }

    /*--------------------------------------------收货地址页面--------------------------------------*/

    //添加新的收货地址设置为 默认地址
    $('.set-default-address>img').on({
        click:function(){
            var src = $(this).attr('src');
            var png = src.substr(src.indexOf('img/'));
            var imgsrc=src.substr(0,src.indexOf('img/'));
            if(png == "img/checkbox_false.png"){
                $(this).attr('src',imgsrc+'img/checkbox_true.png');
            }else if(png == "img/checkbox_true.png"){
                $(this).attr('src',imgsrc+'img/checkbox_false.png');
            }

        }
    })
    // //table设置默认地址
    // $('.layui-table tr').on({
    //     mouseenter:function(){
    //         if($(this).children('td').last().find('span').hasClass('implicit')){
    //             $('.implicit').hide();
    //             $(this).find('.implicit').show();
    //             var _this=this;
    //             $(_this).find('.implicit').on({
    //                 click:function(){
    //                     var _t=this;
    //                     $('.layui-table tr').find('.note').each(function(){
    //                         var _tt=this;
    //                         if(!$(_tt).hasClass('implicit')){
    //                             $(_tt).addClass('implicit').html('设为默认');
    //                         }
    //                     })
    //                     $(_t).removeClass('implicit').html('默认地址');
    //                     $('.implicit').hide();
    //                 }
    //             })
    //         }
    //     },
    //     mouseleave:function(){
    //         $('.implicit').hide();
    //     }
    // })
    //点击编辑按钮，修改收货地址
    $('.btn-box>button.modify').on({
        click:function(){
            var _this=this;
            var address_id = $(_this).parent().find('input').val();
            $("#address_id").val(address_id);
            $('.layui-form>div').each(function(){
                var _t=this;
                var index=parseInt($(_t).index());
                if(index==0||index==1){
                    index=index+1;console.log(index);
                }else if(index==2){
                    index=index-2;console.log(index);
                }else{
                    index=index;console.log(index);
                }
                var val=$(_this).parent().parent().parent().children('td').eq(index).html();
                //点击编辑，获取所在地区
                if($(_t).find('input').attr('id')){
                    var id=$(_t).find('input').attr('id');
                    var cityList=$(_t).find('#'+id).next().children('.title').children('.select-item'),arrval=val.trim().split(' '),i=0;
                    for(var v in arrval){
                        if(arrval[v]==''){
                            arrval.splice(v,1);
                        }
                    }
                    if(arrval[0]!='未填写'){
                        cityList.each(function(){
                            var _city=this;
                            $(_city).html(arrval[$(_city).index()]);
                            i++;
                        })
                    }else{
                        cityList.each(function(){
                            var _city=this;
                            $(_city).html('未填写');
                        })
                    }
                }
                if($(_t).find('input')){
                    $(_t).find('input').val(val);
                }
                if($(_t).find('textarea')){
                    $(_t).find('textarea').text(val);
                }
            })
        }
    });
    //点击编辑，获取用户地区
    function getArea(){

    }
    //判断某个字符第n次出现的位置
    function find(str,cha,num){
        var x=str.indexOf(cha);
        for(var i=0;i<num;i++){
            x=str.indexOf(cha,x+1);
        }
        return x;
    }
    //点击删除按钮，删除本条记录
    $('.btn-box>button.delete').on({
        click:function(){
            if($(this).parent().next().html()=='默认地址'){
                $(this).parents('tbody').find('tr').eq(1).children('td').last().children('span').removeClass('implicit').html('默认地址').show();
            }
            var _this = this;
            var address_id = $(this).parent().find('input').val();                  //收货地址id
            var csrf_token = $("#csrf-token").val();//全局变量 post提交用
            var parm={
                'address_id':address_id,
                '_token': csrf_token
            };
            var url="//"+location.host+location.pathname+'/delete_address';
            $.post(url,parm,function (data) {
                if(data.code==1){
                    layer.alert(data.message, {
                        skin: 'layui-layer-molv'
                        ,closeBtn: 0
                        ,anim: 2 //动画类型
                    });
                    $(_this).parent().parent().parent().remove();
                }else{
                    alert(data.message);
                }
            },'json')
        }
    });
    //点击清空按钮
    $('#clear-address').on({
        click:function(){
            $('.layui-form>div').each(function(){
                var _t=this;
                //获取所在地区
                if($(_t).find('input').attr('id')){
                    var id=$(_t).find('input').attr('id');
                    var cityList=$(_t).find('#'+id).next().children('.title').children('.select-item');
                    cityList.each(function(){
                        var _city=this;
                        $(_city).html('未填写');
                    })
                }
                //地址id
                $("#address_id").val(0);
                //详细地址
                $("#detail-text").val('');
                //收货人
                $(_t).find("input[name='title']").val('');
                //电话
                $('#phone').val('');
                //地址id
                $('#type_address').val('');
            })
        }
    });

    var consigneeJsonStr = sessionStorage.getItem('consignee');
    if(consigneeJsonStr){
        consigneeEntity = JSON.parse(consigneeJsonStr);
        var areaa=consigneeEntity.areaa,//地区
            detail=consigneeEntity.detail,//详细地址
            name=consigneeEntity.name,//收货人
            phone=consigneeEntity.phone,//电话
			address_id=consigneeEntity.address_id;//收货地址id
        areaa=areaa.trim().split(' ');//详细地址
        $('.layui-form>div').each(function(){
            var _t=this;
            //获取所在地区
            if($(_t).find('input').attr('id')){
                var id=$(_t).find('input').attr('id');
                var cityList=$(_t).find('#'+id).next().children('.title').children('.select-item'),i=0;
                if(areaa[0]!='未填写'){
                    cityList.each(function(){
                        var _city=this;
                        $(_city).html(areaa[i]);
                        i++;
                    })
                }else{
                    cityList.each(function(){
                        var _city=this;
                        $(_city).html('未填写');
                    })
                }
            }
            //详细地址
            $("#detail-text").text(detail);
            //收货人
            if($(_t).find("input[name='title']")){
                $(_t).find("input[name='title']").val(name);
            }
            //电话
            $('#phone').val(phone);
        })
    }



    //点击保存按钮
    $("#save-address").on('click',function(){
        var _this=this,
            arrList = [],//地区
            detailarea ='',//详细地址
            name ='',//收货人名字
            phone ='',//收货人电话
            address_id=0,//收货地址id
            isdefault=0;//是否设为默认
        //获取地区
        $('.layui-form>div.layui-form-item').each(function(){
            var _t=this;
            var index=parseInt($(_t).index());
            //获取地区
            if($(_t).find('input').attr('id')=='city-picker'){
                var areaList=$('#city-picker').next('span.city-picker-span').children('span.title').children('span.select-item');
                areaList.each(function(){
                    var _tt=this;
                    var a=$(_tt).html();
                    arrList.push(a);
                })
            }
            if($(_t).find("input[name='title']")){
                name=$(_t).find("input[name='title']").val();
            }
        });


        detailarea = $("#detail-text").val();  //详细地址
        phone=$('#phone').val();        //收货人电话
        address_id=$('#address_id').val();        //地址id
        var src = $('.set-default-address>img').attr('src');
        var png = src.substr(src.indexOf('img/'));
        if(png == "img/checkbox_false.png"){
            isdefault = 0;
        }else if(png == "img/checkbox_true.png"){
            isdefault = 1;
        }
        var csrf_token = $("#csrf-token").val();//全局变量 post提交用

        var parm={
            'arrList':arrList,
            'detailarea':detailarea,
            'address_id':address_id,
            'name':name,
            'phone':phone,
            'default':isdefault,
            '_token': csrf_token
        };
        var url="//"+location.host+location.pathname+'/save_address';
        $.post(url,parm,function (data) {
			console.log(data);
			if(data.code==200){
			    alert(data.message);
			    // location.reload();
            }else{
                alert(data.message);
            }
        },'json')
    });
    //用户在pay-now.html页面，点击“修改本地地址”，跳转到修改收货地址页面（shipping-address.html），获取要修改的收货地址信息
    // 取值时：把获取到的Json字符串转换回对象
   //返回家乡或者居住地
    function returnhomeOrabode(id,_t){
        var cityList=$(_t).find('#'+id).next().children('.title').children('.select-item'),
            val=$(_t).children('span.inf').html(),
            str='';
        cityList.each(function(){
            var _city=this;
            if($(_city).html()=='未填写'){
                str='未填写';
            }else{
                str=str+' '+$(_city).html()+' ';
            }
            $(_t).children('span.inf').html(str);
        })
    }

    //调用layui的时间插件，设置生日和积分查询时间
    layui.use('laydate',function(){
        var laydate = layui.laydate;
        //常规用法(生日)
        laydate.render({
            elem: '#birthday',
            theme: '#30940E',//自定义主题颜色  （墨绿主题theme: 'molv'，格子主题theme: 'grid'）
            calendar: true//开启公历节日
        });
        //日期范围(积分查询日期)
        laydate.render({
            elem: '#integralDate',
            theme: '#30940E',//自定义主题颜色  （墨绿主题theme: 'molv'，格子主题theme: 'grid'）
            format: 'yyyy/MM/dd', //自定义日期格式
            range: '~',//range: '~' 来自定义分割字符,默认（-）range: true
            change: function(value, date){ //监听日期被切换
                //value得到日期生成的值，如：2017-08-18
                //date得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
                lay('#integralDate').html(value);
            }
        });
    })

    //--------------------------------------修改密码页面--------------------------------------
    //检查手机号
    $("#getCode input:eq(0)").blur(function(){
        var val = $(this).val();
        if(val == ""||val==null){
            checkNull($(this),'手机号码不能为空')
        }else{
            checkPhoneNumber($(this),val);
        }
    });
    //检查验证码
    $("#getCode input:eq(1)").blur(function(){
        var val = $(this).val();
        if(val == ""){
            checkNull($(this),'验证码不能为空')
        }
    });
    //获取验证码后提交
    $('#codeCommit').on({
        click:function(){
            var photo=$("#getCode input:eq(0)").val(),//手机号
                code=$("#getCode input:eq(1)").val();//验证码
            if(photo!=''&&code!=''){
                $(this).hide().next().show();
                $('#getCode').hide().next().show();
            }
        }
    })
    //新密码
    $("#changPwd input:eq(1)").on({
        focus:focusPwd(this),
        blur:blurPwd(this)
    })
    //确认密码
    $("#changPwd input:eq(2)").on({
        focus:focusPwd(this),
        blur:blurPwd(this)
    })
    //确认密码后提交
    $('#pwdCommit').on({
        click:function(){
            var newPwd=$("#pwdCommit input:eq(0)").val(),//新密码
                confirmPwd=$("#pwdCommit input:eq(1)").val();//确认密码
            if(newPwd==''){
                checkNull($("#pwdCommit input:eq(0)"),'新密码不能为空')
            }
            if(confirmPwd==''||newPwd!=confirmPwd){
                checkNull($("#pwdCommit input:eq(0)"),'新密码与确认密码不一致，请重新输入')
            }
            if(confirmPwd==newPwd){
                alert('修改密码成功')
            }
        }
    })
    //修改密码后提交

    //检查手机号码是否符合要求
    function checkPhoneNumber(obj,str){
        //var regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/
        var regex = /^1[3|4|5|8][0-9]\d{8}$/;
        //console.log(regex.test(str));
        if(!regex.test(str)){
            obj.siblings("p").eq(0).html("手机号码错误").slideDown();
            obj.addClass("error");
        }else{
            obj.siblings("p").eq(0).html("").slideUp();
            obj.removeClass("error");

        }
    }
    //新密码或确认密码得到焦点
    function focusPwd(_this){
        if($(_this).val() == ""){
            $(_this).siblings("p").eq(0).stop().slideDown();
        }else{
            $(_this).siblings("p").eq(0).stop().slideUp();
        }
    }
    //新密码或确认密码失去焦点
    function blurPwd(_this){
        var val = $(_this).val();
        if(val == ""){
            $(this).siblings("p").eq(0).stop().slideUp();
        }else{
            if(!val.match(/[\d|\w]{6,20}/)){
                $(_this).addClass("error").siblings("p").eq(0).html("请输入6-20个字符").css('color','rgb(225, 80, 74)').stop().slideDown();
            }else{
                $(_this).removeClass("error").siblings("p").eq(0).html("").stop().slideUp();
            }
        }
    }
    //检查input的value是否为空
    function checkNull(obj,tishi){
        obj.siblings("p").eq(0).html(''+tishi+'').stop().slideDown();
        obj.addClass("error");
    }
    //初始化修改密码页面的input的value为空
    (function initialize(){
        $("#getCode input:eq(0)").val('');//手机号置为空
        $("#getCode input:eq(1)").val('');//验证码置为空
        $("#pwdCommit input:eq(0)").val();//新密码置为空
        $("#pwdCommit input:eq(1)").val();//确认密码置为空
    })();
    //-------------------------------------我的订单页面---------------------------------------
    layui.use(['laypage', 'layer'], function(){
        var laypage = layui.laypage,layer = layui.layer;
        //测试数据
        var data = getIntegral();
        //调用分页
        laypage.render({
            elem: 'orderpage',//指向存放分页的容器
            count: data.length,//数据总数
            limit: 6,//每页显示的条数
            first: '首页',
            last: '尾页',
            prev: '<em>←</em>',
            next: '<em>→</em>',
            curr: location.hash.replace('#page=', ''), //获取hash值为fenye的当前页
            hash: 'page' ,//自定义hash值
            theme: '#30940E',//自定义主题
            jump: function(obj){

            }
        });
    });

    //-------------------------------------我的积分页面--------------------------------------
    function getIntegral(total=100) {
        var str = [];
        for (var i = 0; i < total; i++) {
            var data=[],imgSrc="img/index/AD0IgPCDBxAEGAAg45GqzQUoiJuxmAYwmgI48gE.png",//图片路径
                price=23.80,//价格
                introduce='现摘现货农家新鲜蔬菜水果玉米5斤带皮超甜黄金非转基因嫩玉米棒',//介绍
                shop='滋果果旗舰店',//店铺
                trebmls='391',//月成交
                evaluat='315';//评价
            str[i] ='<td>贤心'+i+'</td>';
            str[i] +='<td>汉族</td>';
            str[i] +='<td>1989-10-14</td>';
            str[i] +='<td>人生似修行</td>';
        }
        return str;
    }
    layui.use(['laypage', 'layer'], function(){
        var laypage = layui.laypage,layer = layui.layer;
        //测试数据
        var data = getIntegral();
        //调用分页
        laypage.render({
            elem: 'addIntegral',//指向存放分页的容器
            count: data.length,//数据总数
            limit: 6,//每页显示的条数
            first: '首页',
            last: '尾页',
            prev: '<em>←</em>',
            next: '<em>→</em>',
            curr: location.hash.replace('#page=', ''), //获取hash值为fenye的当前页
            hash: 'page' ,//自定义hash值
            theme: '#30940E',//自定义主题
            jump: function(obj){
                if(document.getElementById('tbody')){
                    document.getElementById('tbody').innerHTML = function(){
                        var arr = [],
                            thisData = data.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                        layui.each(thisData, function(index, item){
                            arr.push('<tr>'+ item +'</tr>');
                        });
                        return arr.join('');
                    }();
                }

            }
        });
    });


    /*	layui.use(['laypage', 'layer'], function(){
             var laypage = layui.laypage,layer = layui.layer;
              //总页数低于页码总数
              laypage.render({
                elem: 'pageBox',
                count: 100 ,//数据总数
                first: '首页',
                last: '尾页',
                prev: '<em>←</em>',
                next: '<em>→</em>'
              });
        })
        */

    //我的收藏页面
    /*function getArr(total=100) {
            var str = [];
            for (var i = 0; i < total; i++) {
                var data=[],imgSrc="img/index/AD0IgPCDBxAEGAAg45GqzQUoiJuxmAYwmgI48gE.png",//图片路径
                    price=23.80,//价格
                    introduce='现摘现货农家新鲜蔬菜水果玉米5斤带皮超甜黄金非转基因嫩玉米棒',//介绍
                    shop='滋果果旗舰店',//店铺
                    trebmls='391',//月成交
                    evaluat='315';//评价
                    str[i] = '<div class="product-iWrap">';
                    str[i] +='<div class="productImg-wrap"><a target="_blank" href="#">';
                    str[i] +='<img src="'+imgSrc+'"></a>';
                    str[i] +='<p class="productPrice"><em title="'+price+'"><b>¥</b>'+price+'</em></p>';
                    str[i] +='<p class="productTitle"><a href="#" target="_blank" title="'+introduce+'" >'+introduce+'</a></p>';
                    str[i] +='<div class="productShop" ><a class="productShop-name" href="#" target="_blank">'+shop+''+i+'</a></div>'	;
                    str[i] +='</div></div>';
            }
            return str;
        }
    layui.use(['laypage', 'layer'], function(){
            var laypage = layui.laypage,layer = layui.layer;
              //测试数据
              var data = getArr();
              //调用分页
              laypage.render({
                   elem: 'demo7'//指向存放分页的容器
                ,count: data.length//数据总数
                ,limit: 6//每页显示的条数
                ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']//自定义排版。可选值有：count（总条目输区域）、prev（上一页区域）、page（分页区域）、next（下一页区域）、limit（条目选项区域）、 、skip（快捷跳页区域）
                ,curr: location.hash.replace('#page=', '') //获取hash值为fenye的当前页
                ,hash: 'page' //自定义hash值
                ,theme: '#30940E'//自定义主题
                ,jump: function(obj){
                    if(document.getElementById('view')){
                        document.getElementById('view').innerHTML = function(){
                            var arr = [],
                            thisData = data.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                            layui.each(thisData, function(index, item){
                                  arr.push('<div class="product">'+ item +'</div>');
                            });
                            return arr.join('');
                          }();
                    }
                }
              });
        });
        */
});