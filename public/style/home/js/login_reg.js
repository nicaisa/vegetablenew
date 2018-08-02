$(function  () {
//	登录
	$(".login").click(function  () {
		$(".login_mian").show().siblings(".reg_mian").hide();
		$(this).parent(".login-box").addClass("active").siblings().removeClass("active");
		$(this).addClass("a_active");
		$(".reg").removeClass("a_active");
	})
//	注册
	$(".reg").click(function  () {
		$(".reg_mian").show().siblings(".login_mian").hide();
		$(this).parent(".login-box").addClass("active").siblings().removeClass("active");
		$(this).addClass("a_active");
		$(".login").removeClass("a_active");
	})
//	记住密码
	$(".pwd-circle").click(function  () {
		if ($(this).hasClass("fa-circle-o")) {
			
		$(this).addClass("fa-circle").removeClass("fa-circle-o");
		}
		else{
		$(this).addClass("fa-circle-o").removeClass("fa-circle");
			
		}
	})
//	忘记密码
$(".over_pwd").click(function  () {
	$(".pwd_mian,.pwd-box").show();
	$(".login-box,.reg_mian,.login_mian").hide();
})
})