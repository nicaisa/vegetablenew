<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>login</title>
<link rel="stylesheet" type="text/css" href="{{asset('style/Login/css/normalize.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('style/Login/css/demo.css')}}" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="{{asset('style/Login/css/component.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('style/Login/css/login.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('style/Login/css/bootstrap.min.css')}}" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
<style>
	.content{
    animation: cc 4s ease-in-out ;
    width:100%;
}
body {
	cursor:pointer;
    background-image: url("{{asset('style/Login/img/demo-1-bg.jpg')}}");
}
html{background:none;}
.demo-1 .large-header {
    
    background: none;
}


.yzm{
	background: url("{{asset('style/Login/img/sprite.png')}}") -9px -75px;vertical-align: middle;display:block;margin-top:15px ;
}
.input_outer input{
	color: #FFFFFF !important;position:absolute; z-index:100;
}
.verify-code {
    position: relative;
    right: 110px;
    width: 138px;
    /*border: 1px solid #ddd;*/
    line-height: 36px;
    cursor: pointer;
    
}
.verify-code>span:hover{
	color: blue;
}
.verify-code>span{
	display: inline-block;
    position: relative;
    left: 385px;
    color: #fff;
    top: 3px;
}
.verify-code img {
    float: right;
    width: 70px;
    height: 30px;
    margin: 3px 9px;
    margin-top: 6px;
    position: relative;
    right: 35px;
}
.submit{
	border: 0px;
    width: 330px;
    cursor: pointer;

}
</style>
</head>
<body>
		<div class="container demo-1">
			<div class="content ">
				<div id="large-header" class="large-header  ">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3>欢迎你</h3>
						{{--<form action="{{route('check')}}"  method="post">--}}
							<input type="hidden" name="_method" value="post">
						    <input type="hidden" name="_token" value="{{ csrf_token()}}">
							<div class="input_outer">
								<span class="u_user"></span>
								<input name="name" class="text"  type="text" placeholder="请输入账户">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="pwd" class="text" value="" type="password" placeholder="请输入密码">
							</div>
							<div class="input_outer">
								<span class="us_uer yzm" style=""></span>
								<input name="code" class="text" value="" type="text" placeholder="验证码">
                                <a onclick="javascript:re_captcha();"  class="verify-code" >
                                	<!-- {{ URL('code/{tmp}') }}要与路由一致 -->
                                	<img src="{{ URL('code/{tmp}') }}" title="刷新图片" width="100" height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0"/>
                                	<span>换一张</span>
                                </a>
							</div>
							<div class="mb2"><input class="act-but submit" type="button" name="login" style="color: #FFFFFF" value="登录"/></div>
						{{--</form>--}}
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="{{asset('style/Login/js/TweenLite.min.js')}}"></script>
		<script src="{{asset('style/Login/js/EasePack.min.js')}}"></script>
		<script src="{{asset('style/Login/js/rAF.js')}}"></script>
		<script src="{{asset('style/Login/js/demo-1.js')}}"></script>
		<script type='text/javascript' src="{{asset('style/Login/js/jquery-1.9.1.min.js')}}"></script>
	</body>
	<script>  
		// 点击还验证码图片
	  function re_captcha() {
	    $url = "{{ URL('code') }}";
	        $url = $url + "/" + Math.random();
	        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
	  }
	  $("input[name='login']").click(function () {
		  var name=$("input[name='name']").val(),
			  pwd=$("input[name='pwd']").val(),
			  code=$("input[name='code']").val();
		  var param={
		      'name':name,
			  'pwd':pwd,
			  'code':code,
              "_token":"{{csrf_token()}}"
		  }
		  //console.log(1213);return false;
		  $.post("{{route('check')}}",param,function (reg) {
			  if(reg.code==1 ){
                  alert(reg.message);
                  window.location.href="{{route('admin')}}";
			  }else if(reg.code==0 ){
			      alert(reg.message);
			  }
          },'json')
      })

	</script>
</html>