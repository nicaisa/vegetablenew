$(function() {
	//	选择尺码
	$(".cm span").click(function() {
			$(this).addClass("cm_span-active").siblings().removeClass("cm_span-active");
		})
		//	选择颜色
	$(".colors div").click(function() {
		$(this).addClass("colors_span-active").siblings().removeClass("colors_span-active");
	})

	//	加入购物车
	var color_falg = false;
	var cm_falg = false;
	$(".gouwu").click(function() {
		//		获得尺码信息
		console.log($(".colors_span-active").html());
		if ($(".colors_span-active").html() != undefined) {
			color_falg = true;
		}
		if ($(".cm_span-active").text() != "") {
			cm_falg = true;
		}

		if (color_falg == false) {
			alert("请选择颜色");
			return;
		}
		if (cm_falg == false) {
			alert("请选择尺码");
			return;
		}

		var box2_text=$(".box2_text").text();
		var jiage=$(".money").text();
		var color_spanchima = $(".colors_span-active").html();
		var cm_spanchima = $(".cm_span-active").text();
		
		sessionStorage.setItem("box2_text",box2_text);
		sessionStorage.setItem("jiage",jiage);
		sessionStorage.setItem("color_spanchima",color_spanchima);
		sessionStorage.setItem("cm_spanchima",cm_spanchima);
		
		location.href="shopping_cart.html";
		
	})
})