@extends('home/layouts.head')

	@section('header')
		<link rel="stylesheet" href="{{asset('/style/home/css/search.css')}}" media="all" >
	@stop
	@section('content')
		<section>
			<div id="header" class="layui-row" data-spm="a2226n0">
    			<div class="headerLayout layui-col-md12">
					<div class="j_logo logo-con" data-spm="2015002">
						<img class="sxian-logo-img" src="{{asset('/style/home/img/index/logo.png')}}" style="margin: 1px auto;display:block;cursor: pointer;" data-spm-anchor-id="875.7931836/B.2015002.i0.4dc149926MkTg4" width="240px" height="130px">
					</div>
					<div class="header-extra">
						<div class="header-banner">
							<div>
							</div>
						</div>
					</div>
					<div id="mallSearch" class="mall-search">
						<div name="searchTop" action="{{url('show')}}" method="get" class="mallSearch-form clearfix" >
							<fieldset>
								<legend>生鲜搜索</legend>
								<div class="mallSearch-input clearfix">
									<label for="mq" style="visibility: visible; display: none;">搜索</label>
									<div class="s-combobox" id="s-combobox-138">
										<div class="s-combobox-input-wrap">
											<input id="goods_name" accesskey="s" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" value="" class="s-combobox-input" role="combobox" aria-haspopup="true" title="请输入搜索文字" aria-label="请输入搜索文字" type="text">
										</div>
										<label for="mq" class="s-combobox-placeholder" style="color: rgb(102, 102, 102); visibility: visible;">搜索 </label>
									</div>
									<button id="search_goods" >搜索<s></s></button>
									<input id="J_Type" name="type" value="p" type="hidden">
									<input id="J_MallSearchStyle" name="style" value="" type="hidden">
									<input id="J_Cat" name="cat" value="all" type="hidden">
									<input name="vmarket" value="" type="hidden">
								</div>
							</fieldset>
						</div>
					</div>
    			</div>
			</div>
		</section>
		<section>
			<div class="shop-detail">
				<div class="detail-primary layui-clear">
					<div class="primary-goods">
						<div class="goods-info">
							<div class="info-box">
								<h3 class="goods-title">{{$data->name}}<img src="{{asset('/style/home/img/xing-green.png')}}" data-id="{{$goodsId_lock}}" width="30px" height="30px"></h3>
								<div class="goods-main">
									<div class="main-box layui-clear">
										<dl class="clearfix property-box">
										    <dt class="property-type property-type-origin" >价格：</dt>
										  	<dd class="property-cont property-cont-origin" >
										    	<span id="J_OriginPrice" class="price">{{$data->price}}</span>
										  	</dd>
										</dl>
										<dl class="clearfix property-box">  
    										<dt class="property-type property-type-now fl"> 促销价 ：</dt>
									  		<dd class="property-cont property-cont-now fl">
									    		<span id="J_NowPrice" class="price">{{$data->price}}</span>
									        </dd>
									  		<dd class="property-extra fr">
											    <span class="mr10">评价：<var class="num">{{$ev_count}}</var></span>
											    <span>累计销量：<var class="num J_SaleNum">{{$data->sales}}</var> </span>
										  	</dd>
										</dl>
									</div>
									<input type="hidden" value="{{$data->type_id}}" id="J_GoodsType" >
								</div>
								<div class="goods-prowrap goods-im">
								    <dl class="layui-clear">
								        <dt>客服：</dt>
								        <dd>
								        	<div class="mlstalk_widget_btn" data-shopid="14nse" data-bid="14nse" style="cursor:pointer" data-style="default" data-toid="" data-tid="">联系客服</div>
								        </dd>
								    </dl>
							    </div>
								<div class="goods-prowrap goods-sku">
									<div class="content">
										<div class="box">
											<dl class="size clearfix" style="display: block;">
						        				<dt>重量：</dt>
						        				<dd>
						        					<ol class="J_SizeList size-list clearfix">
						        					  	<li data-id="100" title="500g">{{$go_rule->name}}</li>
						        					</ol>
						        				</dd>
						      				</dl>
											<dl class="layui-clear">
												<dt>数量：</dt>
												<dd class="num layui-clear">
													<div id="J_GoodsNum" class="goods-num fl" data-stock="980">
								                        <span class="num-reduce num-disable"></span>
								                        <input class="num-input" value="1" type="text">
								                        <span class="num-add "></span>
								                    </div>
								                    <div class="J_GoodsStock goods-stock fl" >库存{{$data->stock}}kg</div>
													<div class="J_GoodsStockTip goods-stock-tip fl"><img src="{{asset('/style/home/img/icon-tishi.png')}}">您所填写的商品数量超过库存！</div>
												</dd>
											</dl>
										</div>
									</div>
									<div class="goods-buy layui-clear">
										<a href="javascript:goods_comfirm('{{$goodsId_lock}}') ;" id="J_BuyNow" class="fl mr10 buy-btn buy-now">立刻购买</a>
										<a href="javascript:add_car('{{$goodsId_lock}}') ;" id="J_BuyCart" class="fl mr10 buy-cart buy-btn">加入购物车</a>
									</div>
									<div class="model"></div>
								</div>
								<div class="goods-extra layui-clear">
									<div class="extra-services layui-clear">
										<div class="fl layui-clear label">服务承诺：</div>
										<ul class="fl layui-clear list" style="">
											<li class="item"><span class="link"><img src="{{asset('/style/home/img/icon-tui.png')}}">退货补运费</span></li>
											<li class="item"><span class="link"><img src="{{asset('/style/home/img/icon-tui.png')}}">退货补运费</span></li>
											<li class="item"><span class="link"><img src="{{asset('/style/home/img/icon-tui.png')}}">退货补运费</span></li>
											<li class="item"><span class="link"><img src="{{asset('/style/home/img/icon-tui.png')}}">退货补运费</span></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="J_GoodsImg" class="fl goods-topimg">
							<div class="big-img" id="J_BigImgs">
								<button class="middle">
                                    <?PHP $imgs = explode(',',$data->img); ?>
									<img src="{{asset('/uploads/goods/'.$imgs[0])}}"  width="400px"/>
								</button>
							</div>
							<div class="small-img" id="J_SmallImgs">
								<div class="box">
									<ul class="layui-clear carousel" id="imgShow">
                                        <?PHP $imgs = explode(',',$data->img); ?>
										@foreach($imgs as $v)
												<li class=""><img src="{{asset('/uploads/goods/'.$v)}}" class='img img-thumbnail' width="50px" style=""></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
						<div class="primary-slide">
					<div class="goods-recommend">
						<p class="title"><s></s><span>热卖推荐</span></p>
						<div class="list">
							<div class="box">
								<ul>
                                    @foreach($hot as $hot)
									<li>
                                        <?PHP $imgs = explode(',',$hot->img); ?>
										<a target="_blank" href="{{route('goodsDeatil',['id'=>$hot->id,'typeid'=>$hot->type_id])}}"><img src="{{asset('/uploads/goods/'.$imgs[0])}}">
                                            <span style="color: green;">{{$hot->price}}</span>
                                        </a>
									</li>
                                    @endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			
				</div>
			</div>
		</section>
		<section>
			<div class="layui-tab tb-tabbar-wrap ">
			  	<ul class="layui-tab-title">
				    <li class="layui-this">累积评论（10）</li>
				    <li>专项服务</li>
			  	</ul>
			  	<div class="layui-tab-content">
			    	<div class="layui-tab-item layui-show">
			      		<ul id="remark-box">

						</ul>
						<div id="demo0"></div>
			    	</div>
			    	<div class="layui-tab-item">
			    		<div id="J_MainWrap" class="main-wrap  J_TRegion">
			    			<div id="service">
			    				<div class="kg-contract">
			    					<h2 class="service-list-title"><em>承诺以下服务</em></h2>
			    					<ul class="service-list-items">
			    						<li class="service-item">
			    							<img class="icon" src="{{asset('/style/home/img/icon-service.png')}}">
			    							<div class="info">
			    								<h3 class="name">消费者保障服务</h3>
			    								<div class="detail">绿色纯天然</div>
			    								<p>在确认收货 15 天内，如有商品质量问题、描述不符或未收到货等，您有权申请退款或退货。</p>
			    							</div>
			    						</li>
			    					</ul>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			  	</div>
			</div>
		</section>
	@stop
	@section('script')
		<script type="text/javascript" src="{{asset('/style/home/js/vegetableInfo.js')}}"></script>
		<script>

			/*搜索框搜索*/
            $("#search_goods").click(function () {
                var url = '{{route('show')}}';
                var goods_name = $("#goods_name").val();
                url += '?goods_name='+goods_name;
                console.log(goods_name);
                location.href = url;
            });

            layui.use('element', function(){
			  	var $ = layui.jquery
			  	,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块

			  	//触发事件
			  	var active = {
			    	tabAdd: function(){
				      	//新增一个Tab项
				      	element.tabAdd('demo', {
				       		title: '新选项'+ (Math.random()*1000|0) //用于演示
				        	,content: '内容'+ (Math.random()*1000|0)
				        	,id: new Date().getTime() //实际使用一般是规定好的id，这里以时间戳模拟下
				      	})
			    	}
				    ,tabDelete: function(othis){
				      	//删除指定Tab项
				      	element.tabDelete('demo', '44'); //删除：“商品管理”
				      	othis.addClass('layui-btn-disabled');
				    }
			    	,tabChange: function(){
			      		//切换到指定Tab项
			      		element.tabChange('demo', '22'); //切换到：用户管理
			    	}
			  	};
			  	$('.site-demo-active').on('click', function(){
			    	var othis = $(this), type = othis.data('type');
			    	active[type] ? active[type].call(this, othis) : '';
			  	});
			});
            getRemark();
            // 点击收藏按钮（星星）
            $(".goods-title>img").on("click",function () {
                add_collect($(this).attr("data-id"));
            })
            /*立即购买 */
			function goods_comfirm(goods_id) {
			    var url = '{{route('order_confirm')}}'+'?type=goods&goods_id='+goods_id;
			    var goods_num = $("#J_GoodsNum input").val();
                url += '&goods_num='+goods_num;
                window.location.href=url;
            }

            /*添加购物车 */
			function add_car(goods_id) {
			    var url = '{{route('add_cart')}}';
			    var goods_num = $("#J_GoodsNum input").val();
                $.ajax(url,{
                    data:{
                        'goodsId_lock' : goods_id,
                        'goods_num' : goods_num,
                        '_token': '{{csrf_token()}}'
                    },
                    type:'post',
                    success: function (data) {
                        console.log(data);
                        model("加入购物车成功");
                    },
                    dataType:'json'
                });
            }
            /*添加收藏夹 */
			function add_collect(goods_id) {
                var goods_type = $("#J_GoodsType").val();
			    var url = '{{route('add_collect')}}';
                $.ajax(url,{
                    data:{
                        'goodsId_lock' : goods_id,
                        'goods_type' : goods_type,
                        '_token': '{{csrf_token()}}'
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
            }
            //提示消息
            function model(thishi) {
                $('.model').html(thishi).show();
                setInterval(function () {
                    $('.model').hide();
                },5000)
            }
            /* 获取评论信息*/
			function getRemark() {
				var str = [];
                var url='{{ route('evaluate') }}';
                goodsId_lock = '{{$goodsId_lock}}';
                $.ajax(url,{
                    data:{
                        'goodsId_lock' : goodsId_lock,
                        '_token': '{{csrf_token()}}'
                    },
                    type:'post',
                    success: function (data) {
                        console.log(data);
                        var evaluates = data.data;
                        evaluates.forEach(function (result,i) {
                            str[i]='<div class="from-whom">\
								<img class="avatar" src="'+result['headimg']+'">\
								<div>'+result['username']+'</div>\
							</div>\
							<div class="review-details">\
								<div class="tb-rev-item " data-id="">\
									<div class="J_KgRate_ReviewContent tb-tbcr-content ">\
										   '+result['content']+'\
									</div>\
									<div class="tb-rev-item-media">\
										<ul class="kg-photo-viewer-thumb-bar tb-tbcr-mt">\
											<li class="photo-item">\
												<img mp4-src="" swf-src="" src="img/cabbage.jpg">\
											</li>\
										</ul>\
									</div>\
									<div class="tb-r-act-bar">\
										<div class="tb-r-info">\
											<span class="tb-r-date">'+result['addtime']+'</span><span class="size">重量：500g</span>\
										</div>\
									</div>\
								</div>\
							</div>';
                        });
                        var data = str;
                        var length = str.length;
                        layui.use(['laypage', 'layer'], function(){
                            var laypage = layui.laypage,layer = layui.layer;
                            //总页数低于页码总数
                            laypage.render({
                                elem: 'demo0'
                                ,count: 2 //数据总数
                                ,limit: length//每页显示的条数
                                ,first: '首页'
                                ,last: '尾页'
                                ,prev: '<em>←</em>'
                                ,next: '<em>→</em>'
                                ,curr: location.hash.replace('#page=', '') //获取hash值为fenye的当前页
                                ,hash: 'page' //自定义hash值
                                ,theme: '#30940E'//自定义主题
                                ,jump: function(obj){
                                    if(document.getElementById('remark-box')){
                                        document.getElementById('remark-box').innerHTML = function(){
                                            var arr = [],
                                                thisData = data.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                            if(thisData.length==0){
                                                $('#demo0').hide();
                                            }else{
                                                layui.each(thisData, function(index, item){
                                                    arr.push('<li class="J_KgRate_ReviewItem kg-rate-ct-review-item" tabindex="0">'+ item +'</li>');
                                                });
                                            }
                                            return arr.join('');
                                        }();
                                    }

                                }
                            });
                        });
                    },
                    dataType:'json'
                });
			}
			//sessionStorage.clear();
		</script>
@endsection
