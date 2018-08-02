<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>重置登录密码-生鲜网</title>
		<link rel="stylesheet" href="layui/css/layui.css">
		<link rel="stylesheet" href="css/plulic.css" />
		<link rel="shortcut icon" href='img/index/logo.png' rel='icon' type='image/x-icon'/>
	</head>
	<body class="forget-password authenticate">
		<div id="header">
			<div class="header-layout">
				<h1 class="logo" id="logo"><a href=""></a></h1>
				<h2 class="logo-title"> 重置登录密码 </h2>
				<ul class="header-nav">
		    		<li class="nav-first"><a href="register.html" target="_blank"> 注册 </a></li>
					<li><a href="login1.html" target="_blank"> 登录 </a></li>
					<li><a href="" target="_blank">  </a></li>
	        	</ul>
			</div>
		</div>
		<div id="content">
			<div class="content-layout">
				<div class="maincenter">
					<ol class="ui-step ui-step-3" style="overflow: visible">
		                <li class="ui-iconfontstep-start  ui-iconfontstep-done ">
					        <!--<em>
					        	<i class="iconfont" title="菱形"></i>
					        	<strong></strong>
					        	<i class="ui-iconfontstep-stepNum">1</i>
					        </em>
					        <span>验证身份</span>-->
					        <div class="ui-step-line">-</div>
				            <div class="ui-step-icon">
				                <i class="iconfont success"></i>
				                <i class="ui-step-number">1</i>
				                <strong ></strong>
				                <span class="ui-step-text">验证身份</span>
				            </div>
					    </li>
				         <li class=" ui-step-active" >
				            <div class="ui-step-line">-</div>
				            <div class="ui-step-icon">
				                <i class="iconfont active"></i>
				                <i class="ui-step-number">2</i>
				                <span class="ui-step-text">找回密码</span>
				            </div>
				        </li>
		                <li class="ui-step-end">
				            <div class="ui-step-line">-</div>
				            <div class="ui-step-icon">
				                <i class="iconfont"></i>
				                <i class="ui-step-number">√</i>
				                <span class="ui-step-text">完成</span>
				            </div>
		        		</li>
		    		</ol>
					<div class="maincenter-box" style="margin-top: 50px;">
						<form class="ui-form">
							<input name="_form_token" value="9" type="hidden">
							<input name="securityId" value="" type="hidden">
							<div class="ui-form-item">
				                <label class="ui-label ui-label-reset">账户名</label>
								<p class="ui-form-text"><span class="ui-text-amount">157******55</span></p>
				            </div>
				            <div class="ui-form-item">
				            	<label class="ui-label">新的登录密码</label>
				            	<span class="alieditContainer" id="newPwd_container">
				            		<input tabindex="" id="newPwd_rsainput" name="newPwd_rsainput" class="ui-input i-text"  autocomplete="off" value="" type="password"/>
				            	</span>
				            	<p class="ui-form-explain" style="display: none;">
				            		<i class="ui-form-icon"></i>
                        			必须是8-20位英文字母、数字或符号，不能是纯数字或纯字母
                    			</p>
				            </div>
				            <div class="ui-form-item">
				            	<label class="ui-label">确认新的登录密码</label>
				            	<span class="alieditContainer" id="newPwdConfirm_container">
				            		<input tabindex="" id="newPwdConfirm_rsainput" name="newPwdConfirm_rsainput" class="ui-input i-text" autocomplete="off" value="" type="password">
				            	</span>
				            	<div class="ui-form-explain"></div>
				            </div>
				            <div class="ui-form-item ui-form-item-last ">
								<div class="ui-button ui-button-morange" id="J-submit-btn">
				                    <input value="下一步" class="ui-button-text layui-btn layui-btn-xs ui-button ui-button-morange" seed="" type="submit" style="height: 25px;line-height: 20px;">
				                </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/address/jquery.min.js"></script>
		<script type="text/javascript">
			$("#newPwd_rsainput").on("blur",function(){
				var val=$(this).val();
				checkPwd(val,$(this));
			})
			$("#newPwdConfirm_rsainput").on("blur",function(){
				var val=$(this).val(),newval=$("#newPwd_rsainput").val();
				checkPwd(val,$(this));
				equal(val,newval,$(this));
				/*if(val!=newval){
					$(this).addClass("error").parent().siblings(".ui-form-explain").eq(0).html("前后密码不一致，请重新输入").slideDown()
				}else if(checkPwd(val,$(this))){
					window.location.href="reset-password-success.html";
				}*/
			})
			$("#J-submit-btn").on("click",function(){
				var newPwd=$("#newPwd_rsainput"),pwd=$('#newPwdConfirm_rsainput');
				var val=pwd.val(),newval=newPwd.val();
				checkPwd(newval,newPwd);
				checkPwd(val,pwd);
				equal(val,newval,pwd);
				if(equal(val,newval,pwd)){
					window.location.href="reset-password-success.html";
				}
				
			})
			function checkPwd(val,obj){
				if(val == ""||val==null){
					return checkNull(obj,'密码不能为空')
				}else{
					return checkPassword(obj,val,'必须是8-20位英文字母、数字或符号');
				}
			}
			//检查input是否为空
			function checkNull(obj,tishi){
				showTishi(obj,tishi);
				return false;
			}
			//检查密码是否符合要求
			function checkPassword(obj,str,tishi){
				//var regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/ 
				var regex = /^[a-z0-9_-]{6,18}$/; 
				if(!regex.test(str)){
					showTishi(obj,tishi);
					return false;
				}else{
					obj.removeClass("error").parent().siblings(".ui-form-explain").eq(0).html("").slideUp();
					return true;
				}
			}
			//判断前后密码是否一致
			function equal(val,newval,obj){
				if(val!=newval){
					showTishi(obj,'前后密码不一致，请重新输入');
					return false;
				}else{
					return true;
				}
			}
			//显示提示
			function showTishi(obj,tishi){
				obj.addClass("error").parent().siblings(".ui-form-explain").eq(0).html(''+tishi+'').slideDown();
			}
		</script>
	</body>
</html>
