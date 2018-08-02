<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>忘记密码-生鲜网</title>
        <link rel="stylesheet" href="{{asset('style/home/css/plulic.css')}}" />
        <link rel="shortcut icon" href='{{asset('style/home/img/index/logo.png')}}' rel='icon' type='image/x-icon'/>
	</head>
	<body class="forget-password">
		<div id="header">
			<div class="header-layout">
				<h1 class="logo" id="logo"><a href=""></a></h1>
				<h2 class="logo-title"> 找回密码 </h2>
				<ul class="header-nav">
					<li class="nav-first"><a href="{{route('reg')}}" target="_blank"> 注册 </a></li>
					<li><a href="{{route('homelogin')}}" target="_blank"> 登录 </a></li>
					<li><a href="" target="_blank">  </a></li>
	        	</ul>
			</div>
		</div>
		<div id="content">
			<div class="content-layout">
				<div class="maincenter">
					<div class="maincenter-box">
						<div class="maincenter-box-tip">
							<p class="ui-tiptext ui-tiptext-message ft-14">
								<i class="ui-tiptext-icon iconfont" title=" 提示 "></i>
								 请输入你需要找回登录密码的账户名
							</p>
						</div>

							<input name="_tb_token_" type="hidden" value="">
							<input type="hidden" name="action" value="password_action">
							<input type="hidden" name="event_submit_do_find_password" value="notNull">
							<input id="fm-noc-ua" name="ua" type="hidden">
							<input id="fm-umid-token" name="umidToken" value="" type="hidden">
							<div class="ui-form-item">
								<label class="ui-label"> 登录名: </label>
								<input id="J-accName" name="" class="ui-input" type="text" placeholder=" 手机/会员名 " value="" >
								<span class="ui-form-other" style="display: none;"> 忘记会员名？可使用邮箱 </span>
								<div class="ui-form-explain"> </div>
							</div>
							<div class="ui-form-item ui-form-item-last">
								<input  value=" 确定 " class="ui-button ui-button-lorange" id="submitBtn" >

					</div>
				</div>
			</div>
		</div>
        <script type="text/javascript" src="{{asset('style/home/js/address/jquery.min.js')}}"></script>
		<script type="text/javascript">
			$("#J-accName").blur(function(){
				var val = $(this).val();
				checkLoginName(val,$(this));
			});
			//确定按钮
			$("#submitBtn").parent().click(function(){
				var name=$("#J-accName").val();
				if(checkLoginName(name,$("#J-accName"))){
                    $.post('{{route('authenticate')}}',{'phone':name, '_token': '{{csrf_token()}}'},function (reg) {
                        if(reg.status==0){
                            $("#J-accName").addClass("error").siblings(".ui-form-explain").eq(0).html(reg.message).slideDown();
                        } else if(reg.status==1) {
                            sessionStorage.setItem('phone',name);
                            window.location.href="{{route('aShow')}}";
                        }
                    },'json')

				}
			})
			function checkLoginName(val,obj){
				if(val == ""||val==null){
					return checkNull(obj,'手机号码不能为空')
				}else{
					return checkPhoneNumber(obj,val);
				}
			}
			//检查手机号码是否为空
			function checkNull(obj,tishi){
				obj.siblings(".ui-form-explain").eq(0).html(''+tishi+'').stop().slideDown();
				obj.addClass("error");
				return false;
			}
			//检查手机号码是否符合要求
			function checkPhoneNumber(obj,str){
				//var regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ 
				var regex = /^1[3|4|5|8][0-9]\d{8}$/; 
				if(!regex.test(str)){
					obj.siblings(".ui-form-explain").eq(0).html("手机号码错误").slideDown();
					obj.addClass("error");
					return false;
				}else{
					obj.siblings(".ui-form-explain").eq(0).html("").slideUp();
					obj.removeClass("error");
					return true;
				}
			}
		</script>
	</body>
</html>
