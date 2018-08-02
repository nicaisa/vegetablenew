@extends('home/layouts.head')

@section('header')
		<link rel="stylesheet" href="{{asset('/style/home/css/shopcard.css')}}">
		<link rel="stylesheet" href="{{asset('/style/home/css/userInfo.css')}}">
		<link rel="stylesheet" href="{{asset('/style/home/css/city-picker.css')}}"  media="all"/><!--地址联动样式-->
		<style>
			.th-item, .td-item {
				width: 202px;
			}
			footer{position: relative;top:1026px;}
		</style>
@stop
@section('content')
	<section>
		<div class="user_center_main">
			<!--  用户信息框分为 左边右边  -->
			<div class="user_center_main_box layui-clear">
				<!-- 左边  -->
				<div class="user_center_left">
					<p class="menu_tit">账号信息</p>
					<ul class="menu_group ">
						<li class="menu_group_list "><a href="{{route('myself')}}"><i class="my-info"></i>我的资料</a></li>
						<li class="menu_group_list"><a href="{{route('collect')}}"><i class="my-collection" class="#"></i>我的收藏</a></li>
						<li class="menu_group_list"><a href="{{route('shop_cart')}}" class="hover"><i class="my-card"></i>我的购物车</a></li>
					</ul>
					<p class="menu_tit">账号记录</p>
					<ul class="menu_group ">
						<li class="menu_group_list"><a href="{{route('myorder')}}"><i class="my-order"></i>我的订单</a></li>
						<li class="menu_group_list"><a href="{{route('address')}}"><i class="my-address"></i>收货地址</a></li>
					</ul>
				</div>
				<!-- 右边  我的购物车-->
				<div class="user_center_right">
					<div class="user_mian_bar">
						<p class="user_mian_bar_tit "><span>我的购物车</span></p>
						<div class="cart-layout-TB ">
							<div id="J_Cart" class="cart">
								<div id="J_FilterBar" class="cart-filter-bar">
									<div class="wrap-line">
									</div>
								</div>
								<div id="J_CartMain" class="cart-main">
									<div class="cart-table-th">
										<div class="wp">
											<div class="th th-chk">
												<div id="J_SelectAll1" class="select-all J_SelectAll">
													<div class="cart-checkbox">
														<input class="J_CheckBoxShop" id="J_SelectAllCbx1" name="select-all" value="true" type="checkbox">
														<label for="J_SelectAllCbx1" data-background="transparent url(img/checkbox_true.png)">勾选购物车内所有商品</label>
													</div>&nbsp;&nbsp;全选
												</div>
											</div>
											<div class="th th-item">
												<div class="td-inner">商品信息</div>
											</div>
											<div class="th th-price">
												<div class="td-inner">单价</div>
											</div>
											<div class="th th-amount">
												<div class="td-inner">数量</div>
											</div>
											<div class="th th-sum">
												<div class="td-inner">金额</div>
											</div>
											<div class="th th-op">
												<div class="td-inner">操作</div>
											</div>
											<div class="th th-vil hidden">
												<div class="td-inner">购买客户信息</div>
											</div>

										</div>
									</div>
									<div class="" id="J_OrderList">
										<div id="J_OrderHolder_s_1782727258_1" style="height: auto;">
											<div class="J_Order layui-clear order-body">
												{{--购物车主体数据开始--}}

												<div class="order-content" id="cart_list">
												</div>

												{{--结束--}}

												<input hidden id="csrf-token" value="{{ csrf_token() }}">
												<input hidden id="car_page" value="1">
											</div>
										</div>
									</div>
								</div>
                                <div id="pages"></div>{{--分页--}}
								<div id="J_FloatBarHolder" class="float-bar-holder">
									<div id="J_FloatBar" class="float-bar clearfix default" style="position: static;background: #e5e5e5;">
										<div id="J_SelectedItems" class="group-wrapper group-popup hidden" style="display: none;">
											<div id="J_SelectedItemsList" class="group-content"></div>
											<span class="arrow"></span>
										</div>
										<div class="float-bar-wrapper" >
											<div id="J_SelectAll2" class="select-all J_SelectAll" >
												<div class="cart-checkbox">
													<input class="J_CheckBoxShop" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
													<label for="J_SelectAllCbx2">勾选购物车内所有商品</label>
												</div>&nbsp;全选
											</div>
											<div class="operations">
												<a href="#" hidefocus="true" class="J_DeleteSelected">删除</a>
												<a href="#" hidefocus="true" class="J_ClearInvalid hidden" style="display: inline;">清除失效宝贝</a>
												<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
												<a href="#" hidefocus="true" class="J_BatchShare">分享</a>
											</div>
											<div class="float-bar-right">
												<div id="J_ShowSelectedItems" class="amount-sum">
													<span class="txt">已选商品</span>
													<em id="J_SelectedItemsCount">0</em>
													<span class="txt">件</span>
													<div class="arrow-box" style="display: none;">
														<span class="selected-items-arrow"></span>
														<span class="arrow"></span>
													</div>
												</div>
												<div id="J_CheckCOD" class="check-cod" style="display: none;">
													<span class="icon-cod"></span>
													<span class="s-checkbox J_CheckCOD"></span>货到付款</div>
												<div class="pipe"></div>
												<div class="price-sum">
													<span class="txt">合计（不含运费）：</span>
													<strong class="price">
														<em id="J_Total">&nbsp;
															<span class="total-symbol">0.00</span>
														</em>
													</strong>
												</div>
												<div class="btn-area">
													<a href="javascript:void(0)" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
														<span>结&nbsp;算</span>
														<b></b>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<form method="post" action="{{route('order_confirm')}}" id="cart_form" hidden>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="arrGood" value="">
			<input type="hidden" name="totalPrice" value="">
			<input type="hidden" name="type" value="cart">
		</form>
	</section>
@stop
@section('script')
		<script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.data.js')}}" charset="utf-8"></script>
		<script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.js')}}" charset="utf-8"></script>
		<script type="text/javascript" src="{{asset('/style/home/js/userInfo.js')}}" charset="utf-8"></script>
		<script type="text/javascript" src="{{asset('/style/home/js/shopcard.js')}}" charset="utf-8"></script>
		<script>
            var width=773;
            $('.cart-layout-TB ').css({"width":width+'px'});
            $("#J_FloatBarHolder").css({"width":width+'px'});
            $("#J_FloatBar").css({"width":width+'px'});
            $('.find-similar-wrap').css({"width":width+'px'});
            //设置底部
            $('footer').css({"position":'relative','top':$('.user_center_main_box ').outerHeight(true)+'px'});
		</script>
@endsection
