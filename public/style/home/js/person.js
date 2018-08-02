$(function() {
	//	点击跳转
	$("#permn-top-toux").click(function() {
		$(".my-orderForm").hide();
		$("#my-person").show();
	})
	$("#dingd").click(function() {
		$(".my-orderForm").hide();
		$("#orderForm").show();
	})
	$("#pingj").click(function() {
		$(".my-orderForm").hide();
		$("#evaluate").show();
	})
	$("#shouc").click(function() {
		$(".my-orderForm").hide();
		$("#collect").show();
	})
	$("#dizhi").click(function() {
		$(".my-orderForm").hide();
		$("#address").show();
	})
	
//	删除已完成订单
	$(".order-close").click(function  () {
		$(this).parents("tr").remove();
	})
//	删除收藏
	$(".order-collect-close").click(function  () {
		$(this).parents("tr").remove();
	})
	
//	删除收货地址
	$(".address-close").click(function  () {
		$(this).parents("tr").remove();
	})
	
//	修改收货地址
	$(".address-xiugai").click(function  () {
		
	})
})