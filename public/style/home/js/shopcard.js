$().ready(function(){
			
			//鼠标放在商品图片上放大的效果
			$('.J_ItemBody').find('.td-item').eq(0).on({
				mouseenter:function(){
					$('#J_PicZoom').find('img').attr('src',$(this).find('img').attr('src'));
					$('#J_PicZoom').removeClass('ks-overlay-hidden').addClass('small2big-popup').css({'zIndex':'13000','left':$(this).find('itempic').outerWidth(true)+100+$(this).offset().left +'px','top':$(this).offset().top-20+'px'});
				},
				mouseleave:function(){
					$('#J_PicZoom').addClass('ks-overlay-hidden').removeClass('small2big-popup');
				}

			})
			//加减
			//$('.J_ItemBody').find('input.text-amount').val('1');
			//减
			$('#cart_list').on('click','.J_ItemBody .J_Minus',function () {
				var num=$(this).next().val(),_this=this;//num:商品数量
				var count=parseFloat($(_this).parents('.td-amount').next().find('.J_ItemSum').html().replace('￥',''));//该商品总价
				var unit=parseFloat($(_this).parents('.td-amount').prev().find('.price-now').html().replace('￥',''));//该商品单价
				if(num==1){
					$(_this).removeClass('active').next().val(1).attr("data-now",1).next().addClass('active');
				}else{
					num--;
					$(_this).addClass('active').next().val(num).attr("data-now",num).next().addClass('active');
				}
                price(num,unit,_this);
			});
			//加
			$('#cart_list').on("click",'.J_ItemBody .J_Plus',function () {
				var num=$(this).prev().val(),_this=this;
				var maxnum=$(_this).attr("data-max");//最大值（库存）
				var count=parseFloat($(_this).parents('.td-amount').next().find('.J_ItemSum').html().replace('￥',''));//该商品总价
				var unit=parseFloat($(_this).parents('.td-amount').prev().find('.price-now').html().replace('￥',''));//该商品单价
				if(num>=maxnum){
					$(_this).removeClass('active').prev().val(maxnum).attr("data-now",maxnum).prev().addClass('active');
				}else{
					num++;
					$(_this).addClass('active').prev().val(num).attr("data-now",num).prev().addClass('active');
				}
                price(num,unit,_this);
    		})
			//input输入
			$('#cart_list').on('keyup blur','.J_ItemBody .J_ItemAmount',function () {
                var _this=this,min=1,max=$(_this).attr("data-max");
                _this.value = _this.value.replace(/[^\d]/g, '');//如果输入非数字，则替换为''
                var num = parseInt($(_this).val());//商品数量
                var count=parseFloat($(_this).parents('.td-amount').next().find('.J_ItemSum').html().replace('￥',''));//该商品总价
                var unit=parseFloat($(_this).parents('.td-amount').prev().find('.price-now').html().replace('￥',''));//该商品单价
                if(num<=min){
                    num=min;
                    $(_this).val(num).attr("data-now",num).removeClass('error').prev().removeClass('active').next().next().addClass('active');
                }else if((num>min&&num<max)||isNaN(num)){
                    if(isNaN(num)){
                        num=min;
                    }
                    $(_this).val(num).attr("data-now",num).removeClass('error').prev().addClass('active').next().next().addClass('active');;

                }else if(num>=max){
                    num=max;
                    $(_this).val(num).attr("data-now",num).removeClass('error').prev().addClass('active').next().next().removeClass('active');
                }
                price(num,unit,_this);
			})
	        //全选
			$('#J_SelectAllCbx1,#J_SelectAllCbx2').next().on("click",function(){
				if($(this).prev().attr('id')=='J_SelectAllCbx1'){
					allone('J_SelectAllCbx2');
				}else{
					allone('J_SelectAllCbx1');
				}
				check(this);
				allcheck(this);
				totalPrice();
			});
			//初始化所有的单个商品的金额为该商品的单价-------------------
			//$('.J_ItemSum').each(function(){
				//$(this).html($(this).parents('.item-content').find('.price-now').html());
			//})
			//点击某个商品的删除按钮
			/*$('.J_Del').on({
				click:function(){
					var cartId_lock = $(this).attr('data-cart-id');
                    var url = "//"+location.host+location.pathname+'/delete_cart';
                    var csrf_token = $("#csrf-token").val();//全局变量 post提交用
                    $.ajax(url,{
                        data:{
                            'cartId_lock' : cartId_lock,
                            '_token': csrf_token
                        },
                        type:'post',
                        success: function (data) {
                            $(this).parents('.order-content').hide();
                            model(data.message);
                        },
                        dataType:'json'
                    });
				}
			});*/
			//删除某一个商品提示弹出框
			layui.use('layer', function(){ //独立版的layer无需执行这一句
				var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
				//触发事件
				var active = {
					offset: function(othis){
						var type = othis.data('type')
							,text = othis.text();
						layer.open({
							type: 1
							,offset: type //具体配置参考：http://www.layui.com/doc/modules/layer.html#offset
                            ,title: ['商品', 'font-size:14px;text-align: center;']//设置标题
							,content: '<div style="padding: 20px 100px;">'+ text +'</div>'
							,btn: ['确认', '取消']
							,btnAlign: 'c' //按钮居中
							,shade: 0 //不显示遮罩
                            ,yes: function(){//确定
                                var cartId_lock = othis.attr('data-cart-id');
                                var url = "//"+location.host+location.pathname+'/delete_cart';
                                console.log(url);
                                var csrf_token = $("#csrf-token").val();//全局变量 post提交用
                                $.ajax(url,{
                                    data:{
                                        'cartId_lock' : cartId_lock,
                                        '_token': csrf_token
                                    },
                                    type:'post',
                                    success: function (data) {
                                        layer.alert(data.message);
                                        location.reload();
                                    },
									error:function (data) {
                                        console.log(data,"error");
                                    },
                                    dataType:'json'
                                });
                                layer.closeAll();
                            }
                            ,btn2: function(){//取消
                                layer.closeAll();
                            }
                            ,success: function(layero){
								var btn = layero.find('.layui-layer-btn');
								//确认
								/*btn.find('.layui-layer-btn0').attr({
									href: 'http://www.layui.com/'
									,target: '_blank'
								});*/
								//取消
								/*btn.find('.layui-layer-btn1').attr({
									href: 'http://www.layui.com/'
									,target: '_blank'
								});*/
							}
                            ,cancel: function(index, layero){//右上角关闭按钮触发的回调
                               /* if(confirm('确定要关闭么')){ //只有当点击confirm框的确定时，该层才会关闭
                                    layer.close(index)
                                }*/
                                return false;
                            }
                        });
					}
				};
				//点击商品的删除按钮
				$('#cart_list').on('click','.J_Del',function () {
                    var othis = $(this), method = othis.data('method');
                    active[method] ? active[method].call(this, othis) : '';
                });

			});




    		//点击某个商品的一如收藏夹按钮
			$('#cart_list').on('click','.J_Fav',function () {
				var goodsId_lock = $(this).attr('data-goods-id');
				var goodsType = $(this).attr('data-goodsType-id');
				var url = "//"+location.host+location.pathname.replace('/shop_cart','/')+'/User/add_collect';
				var _this = this;
				var csrf_token = $("#csrf-token").val();//全局变量 post提交用
				$.ajax(url,{
					data:{
						'goodsId_lock' : goodsId_lock,
						'goods_type' : goodsType,
						'_token': csrf_token
					},
					type:'post',
					success: function (data) {
                        if(data.code==1){
                            layer.alert(data.message, {
                                skin: 'layui-layer-lan'
                                ,closeBtn: 0
                                ,anim: 1 //动画类型
                            });
                        }else if(data.code==2){
                            layer.alert(data.message, {
                                skin: 'layui-layer-molv'
                                ,closeBtn: 0
                                ,anim: 2 //动画类型
                            });
                        }else{
                            layer.msg(data.message);
                        }

					},
					dataType:'json'
				});
			})
			//点击最下面的"结算"按钮
			$('#J_Go').on({
				click:function(){
						if($(this).hasClass(".submit-btn-disabled")){
							layui.use('layer', function(){ //独立版的layer无需执行这一句
								var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
								layer.msg('请选择商品');
							});
						} else {
							var totalPrice=$(".total-symbol").html();//总价
							var arrGood=[];
							$("#cart_list .item-list").each(function () {
								var _t=this;
								if($(_t).find('label').css("background").indexOf("checkbox_true.png")!=-1){
									var goodInfo={};
                                    var cartId=$(_t).attr("data-cart-id"),//商品id
									num=$(_t).find("input.J_ItemAmount").attr("data-now");//商品数量
									goodInfo["cartId"]=cartId;
                                    goodInfo["num"]=num;
                                    arrGood.push(goodInfo);
								}
                            });
                            $("#cart_form input[name='arrGood']").val(JSON.stringify(arrGood));
                            $("#cart_form input[name='totalPrice']").val(totalPrice);
							$("#cart_form").submit();
                            // var csrf_token = $("#csrf-token").val();//全局变量 post提交用
							// $.ajax(url,{
							// 	data:{
							// 		'type': 'all',
							// 		'totalPrice':totalPrice,
							// 		'arrGood':JSON.stringify(arrGood),
							// 		'_token': csrf_token
							// 	},
							// 	type:'post',
							// 	success: function (data) {
							// 		console.log(data);
							// 	},
							// 	error:function (data) {
							// 		console.log(data,'结算失败error');
							// 	},
							// 	dataType:'json'
							// });
						}
				}
			})
			//点击最下面的删除按钮
			$('.J_DeleteSelected').on({
				click:function(){
                    var url = "//"+location.host+location.pathname+'/delete_allcart';
                    var csrf_token = $("#csrf-token").val();//全局变量 post提交用
                    $.ajax(url,{
                        data:{
                            '_token': csrf_token
                        },
                        type:'post',
                        success: function (data) {
                            $('#J_OrderList').hide();
                            model("删除成功");
                        },
                        dataType:'json'
                    });
				}
			})
	        //input输入框，加,减,触发事件改变价格
			function price(num,unit,_this) {
				if(num && unit && _this){
                    total(num,unit,_this);
                    isPay();//订单结算页面
                    payCart(_this);//购物车结算
				}
              }
	          //判断是订单结算页面还是购物车结算
	          function isPay() {
                  //判断是否是订单结算页面
				  if($(".realPay-price")){
                      payPrice();
				  }
                  //判断是否是购物车结算
				  if($(".btn-area")){
				  	payCart();
				  }
              }
	         //订单结算页面总价格
	         function payPrice() {
                 var goodPrice=0;
                 //合计商品价格
                 $(".td-sum").each(function () {
                     var singPrice=$(this).find('em').html().replace("￥"," ");
                     goodPrice+=parseFloat(singPrice);
                 })
                 //配送费
                 // var postage=$(".delivery-box").find('span').eq(0).attr("data-price");
                 var postage=parseFloat($(".select-price").html());
                 //合计
                 var real=goodPrice+postage;
                 $(".J_ShopTotal").html(real.toFixed(2));
                 $(".realPay-price").html(real.toFixed(2));
             }
             isPay();
			//如果某个商品是选中状态，“结算”旁边的价格改变
             function payCart(_this) {
				 if(_this){
                     var check=$(_this).parents(".td-amount").siblings(".td-chk").find("label").css("background");
                     if(check.indexOf("checkbox_true.png")!=-1){
                     	totalPrice();
                     }
				 }
             }
			//删除购物车的商品后提示消息
			function model(thishi) {
				$('.model').html(thishi).show();
				setInterval(function () {
					$('.model').hide();
				},2000)
			}
			//判断是哪个全选
			function allone(id){
				$('#'+id).next().attr('data-background','transparent url(../style/home/img/checkbox_false.png)');
				$('#'+id).next().css({'background':'transparent url(../style/home/img/checkbox_false.png)'});
			}
			//点击某类商品的复选框
	        $("#cart_list").on('click','.item-content .td-chk .cart-checkbox label',function () {
                var _this=this;
                console.log(_this);
                var count=parseFloat($(_this).parents('.item-content').find('.J_ItemSum').html().replace('￥',''));//该商品总价
                check(this);
                totalPrice();
            })


		/*	$('.item-content .td-chk .J_CheckBoxItem').next().on({
				click:function(){
					var _this=this;
					var count=parseFloat($(_this).parents('.item-content').find('.J_ItemSum').html().replace('￥',''));//该商品总价
					check(this);
					totalPrice();
				}
			})*/
			//复选框
			function check(_this){
				if($(_this).attr('data-background')=='transparent url(../style/home/img/checkbox_true.png)'){
					$(_this).attr('data-background','transparent url(../style/home/img/checkbox_false.png)');
					$(_this).css({'background':'transparent url(../style/home/img/checkbox_false.png)'});
				}else{
					$(_this).attr('data-background','transparent url(../style/home/img/checkbox_true.png)');
					$(_this).css({'background':'transparent url(../style/home/img/checkbox_true.png)'});
				}
			}
			//点击“全选”旁边的复选框，所有商品的复选框都设置为选中状态
			function allcheck(_this){
				if($(_this).attr('data-background')=='transparent url(../style/home/img/checkbox_true.png)'){
					$('.item-content .td-chk .J_CheckBoxItem').each(function(){
						var _t=this;
						$(_t).next().attr('data-background','transparent url(../style/home/img/checkbox_true.png)');
						$(_t).next().css({'background':'transparent url(../style/home/img/checkbox_true.png)'});
					})
				}else{
					$('.item-content .td-chk .J_CheckBoxItem').each(function(){
						var _t=this;
						$(_t).next().attr('data-background','transparent url(../style/home/img/checkbox_false.png)');
						$(_t).next().css({'background':'transparent url(../style/home/img/checkbox_false.png)'});
					})
				}
				
			}
			//单个商品的总价
			function total(num,unit,_this){
				var count=num*unit;
				$(_this).parents('.td-amount').next().find('.J_ItemSum').html('￥'+count.toFixed(2));
				//return count.toFixed(2);
			}
			//所有商品的总价
			function totalPrice(){
				var total=0,num=0;
				$('.item-content .td-chk .J_CheckBoxItem').each(function(){
					var _t=this,c;
					if($(_t).next().attr('data-background')=='transparent url(../style/home/img/checkbox_true.png)'){
						num++;
						 c=parseFloat($(_t).parents('.item-content').find('.J_ItemSum').html().replace('￥',''));
						 total=total+c;
					}
				})
				if(total==0){
					$('#J_Go').addClass('submit-btn-disabled');
				}else if(total>0){
					$('#J_Go').removeClass('submit-btn-disabled');
				}
				$('#J_SelectedItemsCount').html(num);
				$('#J_Total span.total-symbol').html(total.toFixed(2));
			}
			//隐藏“相似宝贝”
			$('.td-op .J_find_similar').hide();
			//交替显示隐藏“相似宝贝”
			$('.td-op').on({
				mouseenter:function(){
					$('.td-op .J_find_similar').hide();
					$(this).find('.J_find_similar').show().children('.J_find_similar_trigger').show().next().hide();
					$(this).find('.find-similar-loading').hide();
				},
				mouseleave:function(){
					//$('.td-op .J_find_similar').hide();
				},
				click:function(){
					//$('.J_find_similar_trigger').hide();
					//$(this).find('.J_find_similar_trigger').show().next().css({'position':'absolute','left':'0px','border':'1px solid red'});
					//if($('.find-similar-identifiers>a').click)
					//if($(this).find('.find-similar-body').css('display')=='block'){
					//	$(this).find('.find-similar-body').hide();
					//}else{
					//	$(this).find('.find-similar-body').show();
					//}
					//console.log($('.find-similar-identifiers>a').click);
					//$(this).find('.J_find_similar_trigger').show().next().toggle().css({'position':'absolute','left':'0px','border':'1px solid red'});
					//console.log($(this).find('.find-similar-body').css('display'));
					
				}
			})
			//“相似宝贝”事件
			$('.td-op .J_find_similar_trigger').on({
				mouseenter:function(){
					$('.td-op .find-similar-body').hide();
					$(this).show().next().hide().children('.find-similar-loading').hide();
				},
				click:function(){
					$('.J_find_similar_trigger').hide();
					$(this).show().next().toggle().css({'position':'absolute','zIndex':'10','background':'#fff','left':'0px','width':$('.item-content').innerWidth()+2+'px'});
				}
			});
			/*点击相似宝贝小圆点*/
			$('.find-similar-identifiers>a').on({
				click:function(){
					$(this).addClass('current').siblings('a').removeClass('current');
					$(this).parents('.find-similar-wrap').show();
					addData();
				}
			})
			/*相似宝贝左右箭头*/
			$('.fss-navigator').css({'top':-($('.find-similar-item').outerHeight(true)+$('.find-similar-identifiers').outerHeight(true))/2+'px'});
			$('.fss-next').css({'left':$('.item-content').innerWidth()-80+'px'});
			$('.fss-prev').css({'left':'10px'});
			//相似宝贝左右箭头事件
			//相似宝贝左右箭头事件right;
			$('.J_fs_next').on({
				'click':function(){
					var next=parseInt($(this).attr('data-next')),_this=this;
					var length=$(_this).parent().prev().children('a').length;
					$(_this).parent().prev().children('a').eq(next).addClass('current').siblings().removeClass('current');
					if(next>0&&next<length-1){
						next=next+1;
					}else if(next==length-1){
						next=length-1;
					}
					$(_this).attr('data-next',next).prev().attr('data-prev',next-1);
					addData();
				}
			})

			//相似宝贝左右箭头事件left
			$('.J_fs_prev').on({
				'click':function(){
					var prev=parseInt($(this).attr('data-prev')),_this=this;
					var length=$(_this).parent().prev().children('a').length;
					$(_this).parent().prev().children('a').eq(prev).addClass('current').siblings().removeClass('current');
					if(prev<=0){
						prev=0
					}else if(prev>0&&prev<length-1){
						prev=prev-1;
					}
					$(_this).attr('data-prev',prev).next().attr('data-next',prev+1);
					addData();
				}
			})
			//添加数据
			function addData() {
				var table = document.body.querySelector('.find-similar-item-wrap');
				var cells = document.body.querySelectorAll('.find-similar-item');
				var url="//"+location.host+location.pathname.substr(0,location.pathname.indexOf("index.php"))+"style/home/img/cabbage2.jpg";
				$('.find-similar-item-wrap').html('');
				for (var i = cells.length, len = i + 4; i < len; i++) {
					var div =document.createElement('div');;
					div.className = 'find-similar-item ';
					div.innerHTML = '	<div class="find-similar-item first">\
											<div class="fsi-addedtocart">\
										        <span>该宝贝已经加入购物车</span>\
										        <i class="triangle"></i>\
										    </div>\
										    <div class="fsi-hasshop">\
											  	<span>该店有宝贝已加购物车</span>\
											  	<i class="triangle"></i>\
											</div>\
											<div class="fsi-img-wrap">\
												<a href="#" target="_blank">\
													<div class="fsi-img">\
														<img src="'+url+'" alt="包菜" data-spm-anchor-id="">\
													</div>\
												</a>\
												<a href="#" target="_blank" class="fsi-addtocart J_CartPluginTrigger">加入购物车</a>\
											</div>\
											<div class="fsi-info-wrap">\
												<div class="fsi-price">\
													<strong>\
										              	<span class="unit">&#165;</span>\
										              	<em>9.9</em>\
										            </strong>\
												</div>\
												<div class="fsi-bought">\
										            214人付款\
										        </div>\
											</div>\
											<div class="fsi-title">\
												<a href="_blank" href="#" title="包菜">包菜+'+i+'</a>\
											</div>\
										</div>';
					if(table){
                        table.appendChild(div);
					}

				}
			}

			addData();
			/*鼠标放在相似宝贝图片上显示加入购物车*/
			$(".fsi-img").on("mouseenter mouseleave",function(){
				$(this).parent().next('a').toggle();
			});
			//-------------我的购物车页面分页-------------
	         if(location.pathname.indexOf("shop_cart")!=-1){
                 var url = "//"+location.host+location.pathname+'/ajax_get_cart';
                 var csrf_token = $("#csrf-token").val();//全局变量 post提交用
                 var car_page = $("#car_page").val();//当前页码
                 $.ajax(url,{
                     data:{
                         '_token': csrf_token,
                         'car_page': car_page
                     },
                     type:'post',
                     success: function (result) {
                         var count = result.total;
                         var data = result.cart;
                         layui.use(['laypage', 'layer'], function(){
                             var laypage = layui.laypage,layer = layui.layer;
                             laypage.render({
                                 elem: 'pages'
                                 ,count: count //数据总数
                                 ,limit: 4//每页显示的条数
                                 ,layout: ['count', 'prev', 'page', 'next', 'skip']//自定义排版。可选值有：count（总条目输区域）、prev（上一页区域）、page（分页区域）、next（下一页区域）、limit（条目选项区域）、 、skip（快捷跳页区域）
                                 ,curr: location.hash.replace('#page=', '') //获取hash值为fenye的当前页
                                 ,hash: 'page' //自定义hash值
                                 ,theme: '#30940E'//自定义主题
                                 ,jump: function(obj){
                                     //模拟渲染
                                     $("#car_page").val(obj.curr);//当前页码
                                     document.getElementById('cart_list').innerHTML = function(){
                                         var arr = []
                                             ,thisData = data.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);

                                         var car_innerHTML = '';
                                         layui.each(thisData, function(index, item){
											 var goodsurl="//"+location.host+location.pathname+'goodsDeatil'+'?id='+item.goods_id+'&typeid='+item.good_type;
                                             goodsurl = goodsurl.replace('/shop_cart','/');
                                             car_innerHTML += '<div  class="item-list" data-cart-id="'+item.cartId_lock+'" >\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div   class="bundle  bundle-last ">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div  class="item-holder">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="J_ItemBody item-body layui-clear item-normal  first-item ">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<ul class="item-content layui-clear ">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li class="td td-chk">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="td-inner">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="cart-checkbox ">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input class="J_CheckBoxItem" id="J_CheckBox_'+item.goodsId_lock+'" name="items[]" value="'+item.goodsId_lock+'" type="checkbox">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for="J_CheckBox_'+item.goodsId_lock+'">勾选商品</label>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li class="td td-item">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="td-inner">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="item-pic J_ItemPic img-loaded">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href="'+goodsurl+'" target="_blank" data-title="" class="J_MakePoint" data-point="tbcart.8.12" data-spm-anchor-id="a1z0d.6639537.1997196601.3">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<img src="'+item.goods_img_src+'" class="itempic J_ItemImg">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</a>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="item-info">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="item-basic-info">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href="'+goodsurl+'" class="item-title J_MakePoint" target="_blank" title="">'+item.name+'</a>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li class="td td-price">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="td-inner">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="item-price price-promo-">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="price-content">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="price-line">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<em class="price-original">￥'+item.price+'</em>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="price-line">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<em class="J_Price price-now" tabindex="0">￥'+item.price+'</em>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li class="td td-amount">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="td-inner">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="amount-wrapper ">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="item-amount ">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href="JavaScript:void(0)" class="J_Minus minus active">-</a>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input value="'+item.num+'" class="text text-amount J_ItemAmount" data-max="'+item.stock+'" data-now="'+item.num+'" autocomplete="off" type="text">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href="JavaScript:void(0)" class="J_Plus plus active ">+</a>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="amount-msg J_AmountMsg">\n' +
                                                 '\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li class="td td-sum">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="td-inner">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<em tabindex="0" class="J_ItemSum number">￥'+(item.num*item.price)+'</em>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="J_ItemLottery"></div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li class="td td-op">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class="td-inner">\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a title="添加收藏夹" class="btn-fav J_Fav J_MakePoint" data-goodsType-id="'+item.good_type+'" data-goods-id="'+item.goodsId_lock+'" href="javascript:void(0)">添加收藏夹</a>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href="javascript:void(0)" data-point-url="#" data-cart-id="'+item.cartId_lock+'" class="J_Del J_MakePoint" data-method="offset" data-type="auto">删除</a>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</li>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</ul>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n' +
                                                 '\t\t\t\t\t\t\t\t\t\t\t\t\t</div>';
                                         });
                                         arr.push(car_innerHTML);
                                         return arr.join('');
                                     }();
                                 }
                             });
                         })
                     },
                     dataType:'json'
                 });
			 }


})
