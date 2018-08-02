<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>登录-生鲜网</title>
</head>
<link rel="stylesheet" href="{{asset('/style/home/css/plulic.css')}}" />
<link rel="stylesheet" href="{{asset('/style/home/css/shopcard.css')}}" />
<link rel="shortcut icon" href="{{asset('/style/home/img/index/logo.png')}}" type='image/x-icon'/>
<style>
	body, button, input, select, textarea {
		font: 12px/1.5 arial,tahoma,宋体;
		font-family: arial, tahoma, 宋体;
		line-height: 1.5;
	}
	body {
		color: #333;
	}
	a {
		color: #333;
		text-decoration: none;
		outline: 0;
	}
	.login-form {
		font-family: "Microsoft Yahei";
	}
	.clearfix{
		clear: both;
		zoom: 1;
	}
	.clearfix:after{
		height: 0px;
		content: '';
		overflow: hidden;
		zoom: 1;
		clear: both;
		display: block;
	}
	.header {
		width: 970px;
		height: 100px;
		margin: 0 auto;
	}
	.header .logo {
		float: left;
		width: 200px;
		height: 100%;
		background: url("{{asset('/style/home/img/index/logo.png')}}") no-repeat center;
	}
	.main {
		background: url("{{asset('/style/home/img/login/login-bg.jpg')}}") no-repeat center;
		height: 570px;
		min-width: 970px;
		_width: expression((document.documentElement.clientWidth||document.body.clientWidth)<970?"970px":"");/*兼容ie*/
	}
	.main .login-content {
		width: 970px;
		height: 100%;
		margin: 0 auto;
	}
	.main .login-content .login-form {
		float: right;
	}
	.login-form {
		position: relative;
		width: 360px;
		margin-top: 50px;
		background: #fff;
		box-shadow: 0 0 2px #ececec;
	}
	.login-form .login-tab {
		height: 50px;
		line-height: 20px;
		font-size: 16px;
		overflow: hidden;
		border-bottom: 1px solid #eee;
	}
	.login-form .login-tab .tab-item.on, .login-form .login-tab .tab-item:hover {
		color: #30940E;
	}
	.login-form .login-tab .tab-item {
		position: relative;
		float: left;
		height: 100%;
		width: 100%;
		text-decoration: none;
		text-align: center;
	}
	.login-form .login-tab .tab-item span {
		display: block;
		margin-top: 15px;
	}
	.login-form .login-tab .tab-item i {
		position: absolute;
		width: 50%;
		height: 3px;
		background: #30940E;
		bottom: -1px;
		left: 35%;
		margin-left: -35px;
	}
	.login-form .login-box {
		padding: 0 24px;
	}
	.login-form  i{
		background:url("{{asset('/style/home/img/login/sprite.png')}}") no-repeat;
	}
	.login-form .login-box .login-error {
		display: none;
		padding: 2px 10px;
		font-size: 12px;
		color: #323232;
		background: #fff0f0;
		border: 1px solid #ff3c3c;
		margin: 8px 0;
	}
	.login-form .login-box .login-error{
		padding:2px 10px;
		font-size:12px;
		color:#323232;
		background:#fff0f0;
		border:1px solid #ff3c3c;
		margin:8px 0;
	}
	.login-form .login-box .login-error i{
		float:left;
		width:16px;
		height:16px;
		margin:1px 8px 0 0;
		background-position:-140px -108px;
	}
	.login-form .login-box .login-error a{
		color:#2272c8;
	}
	.login-form .login-box .login-error a:hover{
		color:#30940E;
	}
	.login-form .login-box .login-blank{
		line-height: 40px;
		height: 40px;
		display: block;
	}
	.login-form .login-box .input-box {
		position: relative;
		border: 1px solid #ddd;
		color: #999;
		padding-left:36px;
		height: 36px;
		overflow: hidden;
	}
	.login-form .login-box .password-box,.login-form .login-box .username-box, .login-form .login-box .verify-box {
		margin-bottom: 20px;
	}

	.login-form .login-box .username-box {
		position: relative;
		clear: both;
	}
	.login-form .login-box .input-box  input {
		display: block;
		width: 100%;
		height: 100%;
		line-height: 36px;
		border: 0;
		font-size: 14px;
		*height: 36px;
		font-size: 12px;
		color: #ccc;
		cursor: text;
		text-indent: 10px;
	}
	.login-form .login-box .input-box  label {
		display: inline-block;
		text-indent: 50px;
		position: absolute;
		top: 0;
		left: 0px;
		width: 100%;
		height: 100%;
		line-height: 36px;
		font-size: 14px;
		color: #ccc;
		cursor: text;
	}
	.login-form .login-box .input-box .icon {
		width: 36px;
		height: 36px;
		position: absolute;
		top: 0;
		left: 0;

	}
	.login-form .login-box .input-box .username-icon {
		background-position:  -123px -67px ;

	}
	.login-form .login-box .input-box .password-icon {
		background-position:  0 -108px ;
	}
	.login-form .login-box .input-box .verify-icon {
		background-position:  -41px -108px ;
	}
	.login-form .login-box .input-box .clear {
		display: none;
		width: 32px;
		height: 36px;
		position: absolute;
		top: 0;
		right: 0;
		background-position: -82px -108px ;
		cursor: pointer;
	}
	.login-form .login-box .input-box .ok,.login-form .login-box .input-box .error  {
		display: none;
		position: absolute;
		width: 16px;
		height: 16px;
		top: 10px;
		right: 8px;
	}
	.login-form .login-box .input-box .clear{
		display:none;
		width:32px;
		height:36px;
		position:absolute;
		top:0;
		right:0;
		background-position: -82px -108px ;
		cursor:pointer;
	}
	.login-form .login-box .input-box .ok{
		background-position: -111px -27px ;
	}
	.login-form .login-box .input-box .error {
		background-position:  -140px -108px ;
	}
	.login-form .login-box .verify-box .input-box {
		float: left;
		width: 102px;
		padding: 0 32px 0 36px;
	}
	.login-form .login-box .verify-box .verify-code {
		float: left;
		width: 138px;
		border: 1px solid #ddd;
		line-height: 36px;
		border-left: 0 none;
	}
	.login-form .login-box .verify-box .verify-code img {
		float: left;
		width: 70px;
		height: 30px;
		margin: 3px 9px;
	}
	.login-form .login-box .verify-box .verify-code {
		line-height: 36px;
		color: #333;
		text-decoration: none;
	}
	.login-form .login-box .verify-box .verify-code:hover,.login-form .login-box .login-help .forget-password:hover{
		color: #30940E;
	}
	.login-form .login-box .username-login .login-help {
		padding-top: 10px;
	}
	.login-form .login-box .login-help {
		line-height: 35px;
		height: 35px;
		color: #333;
	}
	.login-form .login-box .login-help {
		line-height: 35px;
	}
	.login-form .login-box .login-help .forget-password{
		float:right;
	}
	.login-form .login-box .login-submit {
		display: block;
		width: 310px;
		line-height: 40px;
		margin: 0 auto;
		background: #48A70F;
		border-radius: 10px;
		font-size: 20px;
		font-weight: 700;
		text-align: center;
		color: #fff;
	}
	.login-form .login-box .login-submit:hover{
		background:#3EA00F;
	}
	.login-form .free-reg {
		text-align: center;
		margin: 12px 0 35px;
	}
	.login-form .bind-login {
		position: relative;
		width: 310px;
		margin: 0 auto;
		border-top: 1px solid #ddd;
		padding: 19px 0 17px;
	}
	.login-form .bind-login .title {
		position: absolute;
		top: -9px;
		left: 50%;
		margin-left: -64px;
		color: #999;
		width: 128px;
		background: #fff;
		text-align: center;
	}
	.login-form .bind-login .common .qq {
		padding-left: 0;
	}
	.login-form .bind-login .common a {
		float: left;
		padding: 0 7px;
		padding-left: 7px;
		border-right: 1px solid #dedcd5;
		line-height: 16px;
	}
	.login-form .bind-login .common>a:last-child{
		border-right: 0px;
	}
	.login-form .bind-login .common a i {
		float: left;
		width: 16px;
		height: 16px;
		margin-right: 5px;
	}
	.login-form .bind-login .common .qq i {
		background-position:  -90px -27px ;
	}
	.login-form .bind-login .common .weixin i {
		background-position: -161px -108px ;
	}
</style>
<body>
<div class="header">
	<a class="logo" href="#"></a>
</div>
<div class="main">
	<div class="login-content">
		<div class="login-form">
			<div class="login-tab">
				<div class="tab-item on"><span>手机账号登录</span><i></i></div>
			</div>
			<div class="login-box">
				<div class="login-tishi">
					<div class="login-error"><i></i><span></span></div>
					<div class="login-blank"></div>
				</div>
				<div class="username-box">
					<div class="input-box" id="showErrorUsernameDiv">
						<input id="userName" type="text" name="phone" autocomplete="off" value="" tabindex="1" placeholder="手机号" >
						<i class="icon username-icon"></i>
						<i class="clear"></i>
					</div>
				</div>
				<div class="password-box">
					<div class="input-box" id="showErrorUsernameDiv">
						<input id="password" type="password"  name="password" autocomplete="off" value="" tabindex="2" placeholder="密码"  >
						<i class="icon password-icon"></i>
						<i class="clear"></i>
					</div>
				</div>
				<div class="login-help clearfix">
					<a id="remember_pwd" href="javaScript:;"  class="forget-password" style="float: left">
						<div id="J_SelectAll1" class="select-all J_SelectAll">
							<div class="cart-checkbox">
								<input class="J_CheckBoxShop" id="J_SelectAllCbx1" name="select-all" value="true" type="checkbox">
								<label for="J_SelectAllCbx1" data-background="transparent url({{asset('/style/home/img/checkbox_true.png')}})">记住密码</label>
							</div>&nbsp;&nbsp;记住密码
						</div>
					</a>
					<a id="FORGET_PWD" href="{{route('forget')}}" onclick="" class="forget-password">忘记密码？</a>
				</div>
				<a id="submit" href="javascript:void(0)" class="login-submit">登 录</a>
			</div>
			<div class="free-reg">
				<a id="FREE_TO_REG" href="{{route('reg')}}" name="Logon_index_denglu003">免费注册 有惊喜 &gt;</a>
			</div>
			<div class="bind-login">
				<span class="title">使用以下账号登录</span>
				<div class="common clearfix">
					<a name="Logon_index_denglu027" href="javascript:void(0);" onclick="javascript:qqLogin(); return false;" class="qq"><i></i>QQ</a>
					<a name="Logon_index_denglu026" href="javascript:void(0);" onclick="javascript:weixinLogin(); return false;" class="weixin"><i></i>微信</a>
				</div>
			</div>

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
<script type="text/javascript" src="{{asset('/style/home/js/public/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/style/home/js/shopcard.js')}}"></script>
<script>
    //提交
    $("#submit").click(function(){
        var phone=$('input[name="phone"]').val(),
            password=$('input[name="password"]').val();
        $.get('{{route('homelogin')}}',{'phone':phone,'password':password,"_token":"{{csrf_token()}}"},function (reg) {
            console.log(reg);
            if(reg.status==1){
				window.location.href="{{route('Home')}}";
			}else{
                alert(reg.message);
			}
//            alert(reg.message);
            //如果选择记住密码，设置localStorage
            {{--if($("#J_SelectAllCbx1").next().attr('data-background')=="transparent url(../style/home/img/checkbox_true.png)"){--}}
                {{--var userEntity =reg.data;--}}
                {{--// 存储值：将对象转换为Json字符串--}}
                {{--localStorage.setItem('userInfo', JSON.stringify(userEntity));--}}
            {{--}--}}

            {{--if(reg.status==1){--}}
                {{--window.location.href="{{route('Home')}}";--}}
            {{--}--}}

        },'json')
    });
</script>
</body>
</html>
