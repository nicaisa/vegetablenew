$(function  () {
//	返回顶部
	$(".home").click(function  () {
		$(window).scrollTop(0);
	})
//	主题市场分类导航
	$(".nav-list2>li").hover(function() {
					$(".nav-list3").addClass("nav-list-display");
				}, function() {
					$(".nav-list3").removeClass("nav-list-display");
				})
})