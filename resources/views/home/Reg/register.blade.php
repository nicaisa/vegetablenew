<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<title>注册 -生鲜网</title>
<link rel="stylesheet" href="{{asset('/style/home/css/register.css')}}">
<link rel="stylesheet" href="{{asset('/style/home/css/plulic.css')}}" />
<link href="{{asset('/style/home/img/index/logo.png')}}" rel='icon' type='image/x-icon'/>
</head>
<body>
<div class="body">
	<div class="regist-wrapper" id="registWrapper">
		<div class="regist-header ">
			<a href="#" class="logo zh"></a>
		</div>
		<div class="regist-content " data-id="registerForm">
			<div class="b-title">
				<h2>
					<span class="icon icon-mobile"></span>使用手机注册
				</h2>
			</div>
			<div class="ct-inner">
				<!--tab start-->
				<div class="tab">
					<!--手机注册-->
					<div id="mobile" class="regist-form" data-formType="mobile"  style="display:block;">
						<ul class="form-list">
							{{--$phone = $request->input('phone');--}}
							{{--$password = $request->input('password');--}}
							{{--$smsCode = $request->input('code');--}}
							<li>
								<div class="form-input">
									<div class="form-unit">
										<label class="input-tips J-placeholder" style="display: none;">手机号码</label>
										<input type="text"  name="phone" class="qc-log-input-text lg" placeholder="手机号码" data-id="phoneInput">
										<p class="form-input-help" style="text-align: left; color: rgb(225, 80, 74); font-size: 14px;display: none;"></p>
									</div>
								</div>
							</li>
							<li>
								<div class="form-input">
									<div class="form-unit">
										<label class="input-tips J-placeholder" >密码</label>
										<input type="password" name="password" class="qc-log-input-text lg" placeholder="密码" data-id="passwordInput">
										<p class="form-input-help J-errorTip J-promptTip" style="text-align: left; color: rgb(153, 153, 153); font-size: 14px; display: none;">请输入6-20个字符</p>
									</div>
								</div>
							</li>
							<li>
								<div class="form-input">
									<div class="form-unit">
										<label class="input-tips J-placeholder" >确认密码</label>
										<input type="password" class="qc-log-input-text lg" placeholder="确认密码" data-id="confirmPasswordInput">
										<p class="form-input-help J-errorTip J-promptTip" style="text-align: left; color: rgb(225, 80, 74); font-size: 14px;display: none;">两次输入的密码不一致，请重新输入</p>
									</div>
								</div>
							</li>
							<li>
								<div class="form-input fm-verify">
									<div class="form-unit">
										<label class="input-tips J-placeholder" >验证码</label>
										<input type="text" class="qc-log-input-text" placeholder="验证码" data-id="smsCodeInput" name="code">
										<button type="button" class="qc-log-btn xl" data-id="smsCodeBtn" hotrep="regist.fmverify.btn" id="getcode">获取验证码</button>
										<p class="form-input-help J-errorTip J-promptTip" style="text-align: left; color: rgb(225, 80, 74); font-size: 14px;display: none;">请正确输入6位数字验证码</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<!--手机注册 end-->
					<div class="form-ctrl-label-wrap">
						<label class="form-ctrl-label">
							<input type="checkbox" checked class="qc-log-checkbox J-agreement">
							<span>我已阅读并同意
								<a class="link" target="_blank" href="#" hotrep="register.terms.service.zh">服务协议</a>和
								<a class="link" target="_blank" href="#"  hotrep="register.privacy.policy.zh">隐私声明</a>
							</span>
						</label>
					</div>
					<div class="op-btn">
						<button type="button" class="qc-log-btn lg " id="commit" hotrep="regist.op.regist.btn">提交</button>
						<button type="button" class="qc-log-btn lg" id="commitLoading" style="display:none">
							<div class="m-loading">
								<div class="loading">
									<div class="one"></div>
									<div class="two"></div>
									<div class="three"></div>
								</div>
							</div>
						</button>
					</div>
				</div>
				<!--tab end-->
			</div>
		</div>
		<div class="regist">
			<p class="tag-line">
				已有账号？<a href="{{route('homelogin')}}" class="link">立即登录</a>
			</p>
		</div>
	</div>
	
</div>
<footer class="footer">
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
	<div>
		<p > Copyright &copy; 2017<script>
	            	new Date().getFullYear()>2017&&document.write("-"+new Date().getFullYear());
	            </script> 
	    <span>蒋中梅&nbsp;版权所有</span></p>
	</div>
</footer>
   
<script src="{{asset('/style/home/js/public/jquery-1.9.1.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('/style/home/js/public/eventUtil.js')}}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	//获取验证码
	$('#getcode').on('click',function () {
        var phone=$('input[name="phone"]').val();
        $.post('{{route('sendSms')}}',{'phone':phone,"_token":"{{csrf_token()}}"},function(reg){
            if(reg.status==1){//发送验证码成功
                $(this).siblings("p").eq(0).html("").stop().slideUp();
                alert(reg.message);
			} else if(reg.status==0) {
                $(this).siblings("p").eq(0).html(reg.message).css('color','rgb(225, 80, 74)').stop().slideDown();
			}
        },'json');
    })
	//提交
	$("#commit").click(function(){
        var phone=$('input[name="phone"]').val(),
            password=$('input[name="password"]').val(),
            code=$('input[name="code"]').val();
		if($("#mail input:eq(0)").val()==''){
			checkNull($("#mail input:eq(0)"));
		}else{
			
		}
		$.get('{{route('reg')}}',{'phone':phone,'password':password,'code':code,"_token":"{{csrf_token()}}"},function (reg) {
		    console.log(reg);
            alert(reg.message);
		    if(reg.status==1){
		        //console.log(data.data,111);
                var userEntity =reg.data;

				// 存储值：将对象转换为Json字符串
				sessionStorage.setItem('user', JSON.stringify(userEntity));

                window.location.href="{{route('Home')}}";
		   }

        },'json')
	});
	$("#mobile input:eq(0)").blur(function(){
		var val = $(this).val();
		if(val != ""){
			checkPhoneNumber($(this),val);
		}
	});
	function checkNull(obj){
		obj.siblings("p").eq(0).html("手机号码不能为空").stop().slideDown();
		obj.addClass("error");
	}
	function checkPhoneNumber(obj,str){
		//var regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ 
		var regex = /^1[3|4|5|7|8][0-9]\d{8}$/;
		//console.log(regex.test(str));
		if(!regex.test(str)){
			obj.siblings("p").eq(0).html("手机号码错误").slideDown();
			obj.addClass("error");
		}else{
			obj.siblings("p").eq(0).html("").slideUp();
			obj.removeClass("error");
			
		}
	}
	$("#mobile input:eq(1)").focus(function(){
		if($(this).val() == ""){
			$(this).siblings("p").eq(0).stop().slideDown();
		}else{
			$(this).siblings("p").eq(0).stop().slideUp();
		}
		
	});
	$("#mobile input:eq(1)").blur(function(){
		var val = $(this).val();
		if(val == ""){
			$(this).siblings("p").eq(0).stop().slideUp();
		}else{
			if(!val.match(/[\d|\w]{6,20}/)){
				$(this).siblings("p").eq(0).html("请输入6-20个字符").css('color','rgb(225, 80, 74)').stop().slideDown();
				$(this).addClass("error");
			}else{
				$(this).siblings("p").eq(0).html("").stop().slideUp();
				$(this).removeClass("error");
				/*var regex = /[\da-zA-Z\W+]/;
				if(regex.test(val)){
					
				}else{
					$(this).siblings("p").eq(0).html("密码需包含字母、数字、标点符号（如. / _等，除空格外）中的3种").css('color','rgb(225, 80, 74)').stop().slideDown();
				$(this).addClass("error");
				}*/
				
			}
		}
		
	});
	$("#mobile input:eq(2)").blur(function(){
		if($(this).val() == ""){
			$(this).siblings("p").eq(0).slideUp();
		}else{
			/*if($(this).val() == $("#mail input:eq(1)").val()){
				$(this).siblings("p").eq(0).slideUp();
				$(this).removeClass("error");
			}else{
				$(this).siblings("p").eq(0).slideDown();
				$(this).addClass("error");
			}*/
		}
		
	});
	
	$("#mobile ul:eq(1) input:eq(0)").blur(function(){
		console.log($(this));
		var str = $(this).val();
		var regex = /^1[3|4|5|8][0-9]\d{8}$/; 
		//console.log(regex.test(str));
		if(str != ''){
			if(!regex.test(str)){
				$(this).siblings("p").eq(0).slideDown();
				$(this).addClass("error");
			}else{
				$(this).siblings("p").eq(0).html("").slideUp();
				$(this).removeClass("error");
				
			}
		}
		
	});
	$("#smsCodeBtn").click(function(){
		var val = $("#mail ul:eq(1) input:eq(0)").val();
		if(val == ""){
			$(this).siblings("p").eq(0).html("请输入手机号码").slideDown();
			$(this).addClass("error");
		}else {
			$(this).siblings("p").eq(0).slideUp();
			$(this).removeClass("error");
		}
	});
	$("#mail ul:eq(1) input:eq(1)").blur(function(){
		console.log($(this));
		var str = $(this).val();
		//console.log(regex.test(str));
		if(str != ''){
			$(this).siblings("p").eq(0).html("").slideUp();
			$(this).removeClass("error");
		}
		
	});
</script>
</body>
</html>