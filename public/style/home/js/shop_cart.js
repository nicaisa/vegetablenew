$(function() {
				//				购物车单个选择
				$(".shop-circle").click(function() {
						if ($(this).hasClass("fa-circle-o")) {
//							购物车单选按钮选择
							$(this).removeClass("fa-circle-o").addClass("fa-circle");
//							购物车单选按钮合计商品数量
							var shopshuAll=parseInt($(".shop-shuALL").text());
//							单个数量
							var shopshu_one=parseInt($(this).parents("tr").find(".shop_cart-price").val());
							$(".shop-shuALL").text(shopshuAll+shopshu_one);
							
							} else {
//							购物车单选按钮取消
							$(this).removeClass("fa-circle").addClass("fa-circle-o");
						
//							购物车单选按钮删除合计商品数量
						var shopshuAll=parseInt($(".shop-shuALL").text());
							var shopshu_one=parseInt($(this).parents("tr").find(".shop_cart-price").val());
							$(".shop-shuALL").text(shopshuAll-shopshu_one);
							}
							sumMey();
					})
					//				购物车全选
				$(".shop-circleAll").click(function() {

						if ($(this).hasClass("fa-circle-o")) {
							
//							购物车全选
							$(this).removeClass("fa-circle-o").addClass("fa-circle");
							$(".shop-circle").removeClass("fa-circle-o").addClass("fa-circle");
							$(this).siblings().text("取消");
//							多选购物车商品合计数量
							var shopcirLen=$(".shop-circle.fa-circle").parents("tr").find(".shop_cart-price");
							var shopshu_one=0;
							for (var i = 0; i < shopcirLen.length; i++) {
								shopshu_one+=parseInt(shopcirLen.eq(i).val());
							}
							$(".shop-shuALL").text(shopshu_one);
							
							
						} else {
//							购物车多选取消
							$(this).removeClass("fa-circle").addClass("fa-circle-o");
							$(".shop-circle").removeClass("fa-circle").addClass("fa-circle-o");
							$(this).siblings().text("全选");
							
//							多选购物车商品合计数量
							$(".shop-shuALL").text(0);
							
							
						}
					sumMey();
						
					})
				function sumMey(){
					var cirs = $(".shop-circle");
					var summey = 0;
					for(var i=0;i<cirs.length;i++){
						if(cirs.eq(i).hasClass("fa-circle")){
							var meny = parseInt(cirs.eq(i).parents("tr").find(".shop-price_one").text());
							var shopnumber = parseInt(cirs.eq(i).parents("tr").find(".shop_cart-price").val());
							var shopYouf=parseInt($(".shop-Youf").text());
							var shopyouH=parseInt($(".shop-youH").text());
							summey+= meny * shopnumber+shopYouf-shopyouH;
						}
					}
					$(".shop-priceALL").text(summey);
				}
				
				
					//			购物车单个删除
				$(".shop_cart-close").click(function() {
					$(this).parent("tr").remove();
					if ($(this).parent("tr").find(".shop-circle").hasClass("fa-circle")) {
//							购物车价格合计
//							得到单价
							var shopshu_one=parseInt($(this).parents("tr").find(".shop_cart-price").val());
							var shop_priceOne=parseInt($(this).parents("tr").find(".shop-price_one").text());
							var priceNumAll=shopshu_one*shop_priceOne;
							var shopPriceALL=parseInt($(".shop-priceALL").text());
							$(".shop-priceALL").text(shopPriceALL-priceNumAll);
						
					}
				})
//				购物车选择删除
				$(".shop_cart-closeAll").click(function  () {
					if ($(".shop-circle").hasClass("fa-circle")) {
						$(".shop-circle.fa-circle").parents("tr").remove();
						sumMey();
					}
					
				})
				
//				购物车添加商品数量
				$(".shop_cart-jia").click(function  () {
					var shopNum=parseInt($(this).siblings(".shop_cart-price").val());
					$(this).siblings(".shop_cart-price").val(shopNum+1);
//					如果该商品时是选中状态则改变购物车商品合计数量
					if ($(this).parents("tr").find(".shop-circle").hasClass("fa-circle")) {
						var shuNumall=parseInt($(".shop-shuALL").text());
						$(".shop-shuALL").text(shuNumall+1);
					}
					sumMey();
				})
//				购物车减去商品数量
				$(".shop_cart-jian").click(function  () {
					var shopNum=parseInt($(this).siblings(".shop_cart-price").val());
					if (shopNum>1) {
					$(this).siblings(".shop_cart-price").val(shopNum-1);
//					如果该商品时是选中状态则改变购物车商品合计数量
					if ($(this).parents("tr").find(".shop-circle").hasClass("fa-circle")) {
						var shuNumall=parseInt($(".shop-shuALL").text());
						$(".shop-shuALL").text(shuNumall-1);
					}
					}
					sumMey();
				})
			})