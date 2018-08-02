$(function  () {
	$(".pjnr_chk").click(function  () {
		if (!$(this).hasClass("pjnr_chk-active")) {
			$(this).addClass("pjnr_chk-active").siblings(".pjnr_chk").removeClass("pjnr_chk-active");
		}
	})
})