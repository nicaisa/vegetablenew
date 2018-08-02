$(function  () {
	$(".porfasong").click(function  () {
		var porshurukText=$("#porshuruk").val();
		var str="<div class='ma-ke my-ke'>"+
					"<p>我<span>17:31:00</span></p>"+
					"<div class='ma-keText my-keText'>"+porshurukText+
					"</div>"+
				"</div>";
				$(".PortraitK-content").append(str);
				$("#porshuruk").val("");
	})
//	打开客服弹窗
	$(".pp-ke").click(function  () {
		
		$(".Portrait-ke").show();
	})
//	关闭客服弹窗
	$(".fa-times").click(function  () {
		$(".Portrait-ke").hide();
	})
})