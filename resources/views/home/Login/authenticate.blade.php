<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>验证身份-生鲜网</title>
		<link rel="stylesheet" href="{{asset('style/home/layui/css/layui.css')}}">
		<link rel="stylesheet" href="{{asset('style/home/css/plulic.css')}}" />
		<link rel="shortcut icon" href='{{asset('style/home/img/index/logo.png')}}' rel='icon' type='image/x-icon'/>
	</head>
	<body class="forget-password authenticate">
		<div id="header">
			<div class="header-layout">
				<h1 class="logo" id="logo"><a href=""></a></h1>
				<h2 class="logo-title"> 验证身份 </h2>
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
					<ol class="ui-step ui-step-3" style="overflow: visible">
		                <li class="ui-step-start ui-step-active" id="stepstart">
				            <div class="ui-step-line">-</div>
				            <div class="ui-step-icon">
				                <i class="iconfont active"></i>
				                <i class="ui-step-number">1</i>
				                <span class="ui-step-text">验证身份</span>
				            </div>
				        </li>
		                <li>
			                <div class="ui-step-line">-</div>
			                <div class="ui-step-icon">
			                    <i class="iconfont"></i>
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
					<div class="maincenter-box">
						<div class="maincenter-box-tip">
							<p class="ui-tiptext ui-tiptext-message">
								<span class="ui-tiptext-icon"></span>
								您正在使用 “<span class="strong">验证短信</span>” 进行校验。
							</p>
						</div>
							<input name="_form_token" value="" type="hidden">
							<div class="ui-form-item">
								<label class="ui-label ui-label-reset">手机号码</label>
								<p class="ui-form-text" id="J-mobile" style="line-height: 30px;">15736556255</p>
							</div>
							<div class="ui-form-item">
								<label class="ui-label">校验码</label>
								<p class="ui-button ui-button-swhite " id="J-getCode" style="margin-top: 0px">
		                            <input autocomplete="off" class="ui-button-text layui-btn layui-btn-sm ui-button ui-button-morange" value="点此免费获取" seed="Use-checkCode-for-resetQueryPwd-1" type="button" style="width:150px">
		                        </p>
		                        <input class="ui-input ui-input-checkcode  fn-hide " placeholder="4位数字" id="J-inputCode" name="checkCode" autocomplete="off" value="" data-explain=" " maxlength="4"  type="text">
								<span class="ui-form-other  fn-hide " id="J-noCode">
		                            <a  class="ui-form-other-link" id="J-noCode-link" seed="Use-checkCode-for-resetQueryPwd-3">没收到短信校验码？</a>
		                        </span>
		                        <div class="ui-poptip ui-poptip-blue j-tipshow fn-hide" id="J-resentCode" data-widget-cid="widget-1">
		                            <div class="ui-poptip-shadow">
		                                <div class="ui-poptip-container">
		                                    <div class="ui-poptip-arrow ui-poptip-arrow-7">
		                                        <em>◆</em>
		                                        <span>◆</span>
		                                    </div>
		                                    <div class="ui-poptip-content">
		                                        <ul class="list">
		                                            <li><i class="icon-list"></i>网络通讯异常可能会造成短信丢失，请重新获取或稍后再试。</li>
		                                            <li class="list-btn">
		                                                <p class="ui-button  ui-button-sdisable" id="J-reGetCode" data-widget-cid="widget-0">
		                                                    <button class="ui-button-text layui-btn layui-btn-sm ui-button ui-button-morange"  type="button" autocomplete="off" seed="JReGetCode-btn" smartracker="on" style="width:250px;">重新获取校验码</button>
		                                                </p>
		                                                <span class="list-btn-explain list-btn-explain-loading" id="J-reGetCode-success"></span>
		                                                <p class="list-btn-explain list-btn-explain-error fn-hide" id="J-reGetCode-error"><i class="icon icon-error"></i></p>
		                                            </li>
		                                            <li><i class="icon-list"></i>请核实手机是否已欠费停机，或者屏蔽了系统短信。</li>
		                                        </ul>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
							</div>
							<div class="ui-form-item ui-form-item-last ">
								<div class="ui-button ui-button-morange" id="J-submit-btn">
				                    <input value="下一步" class="ui-button-text layui-btn layui-btn-xs ui-button ui-button-morange" seed="" type="submit" style="height: 25px;line-height: 20px;">
				                </div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{asset('style/home/js/address/jquery.min.js')}}"></script>
		<script type="text/javascript">
            $("#J-noCode-link").hide();
            $("#J-resentCode").hide();
            $("#J-getCode").next().hide();
            //获取用户输入的手机号码
            if(sessionStorage.getItem('phone')){
                $("#J-mobile").html(sessionStorage.getItem('phone'));
            }
			//点击“获取验证码”，显示验证码输入框
			$("#J-getCode").on('click',function(){
				$(this).next().show();
                getCode();
			})
			//鼠标离开验证码输入框
			$("#J-getCode").next().on('blur',function(){
				if ($(this).val()=='') {
                    $("#J-noCode-link").show();//显示提示
					$(this).prev().hide();//隐藏点击“获取验证码”
					$(this).next().css({'display':'inline-block'});
				} else {
					$(this).prev().show();
					$(this).next().hide();
				}
			})
			//鼠标移入“没有收到短信验证码”
			$("#J-getCode").next().next().on('mouseenter',function(){
				$(this).next().show().css({'marginTop':'30px'});
			})
			//点击“重新输入短信验证码”
			$("#J-reGetCode").on('click',function(){
                $("#J-getCode").show();
				$("#J-resentCode").hide();
				$('#J-noCode-link').hide();
                getCode();
			})
			//点击“下一步”
			$("#J-submit-btn").on('click',function(){
			    var phone=$("#J-mobile").html();//手机号码
				var code=$("#J-getCode").next().val();//用户输入的验证码
				var rega=/^\d{4}$/;
				if (code.match(rega)) {
                    $.post('{{route('reset')}}',{'phone':phone,'code':code,'_token': '{{csrf_token()}}'},function (reg) {
                        if (reg.status==0) {
                            $("#J-noCode-link").html(reg.message);
                        } else if(reg.status==1){
                            window.location.href="{{url('resetShow')}}";
                        }
                    },'json')
                    window.location.href="{{url('resetShow')}}";
				}
			})
            function getCode() {
                var phone= $("#J-mobile").html();
                $.post("{{route('sendSms')}}",{'phone':phone,"_token":"{{csrf_token()}}"},function (reg) {
                    if(reg.status==1){//发送验证码成功
                        alert(reg.message);
                    } else if(reg.status==0) {

                    }
                },'json')
            }
		</script>
	</body>
</html>
