
		$(function(){
			$(".spjs>ul>li").click(function(){
				$(this).css({"background":"#D2524C","color":"#ffffff"}).siblings().css({"background":"none","color":"#000000"});
				
			})
			$(".spjs>ul").find("li").click(function(){
				var index = $(this).index();
				$(".nr").find("ul").eq(index).show().siblings().hide();
			})
			
		})
