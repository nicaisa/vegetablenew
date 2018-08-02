@extends('home/layouts.head')

@section('header')
@stop
@section('content')
	<section>
		<div id="header" class="layui-row" data-spm="a2226n0">
			<div class="headerLayout layui-col-md12">
				<!--<div class="headerCon">-->
				<!--<h1 id="mallLogo">
                    <span class="mlogo">
                        <a href="" title="shengxian.com"><s></s>shengxian.com</a>
                    </span>
                </h1>-->
				<div class="j_logo logo-con" data-spm="2015002">
					<img class="sxian-logo-img" src="{{asset('/style/home/img/index/logo.png')}}" style="margin: 1px auto;display:block" data-spm-anchor-id="875.7931836/B.2015002.i0.4dc149926MkTg4" width="240px" height="130px">
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
					<ul data-spm="a1z5h" class="hot-query">
						@foreach($type as $k => $t)
							<li   @if($k==0) class="hot-query-highlight"  @endif ><a href="{{route('show',['id'=>$t->id])}}">{{$t->name}}</a></li>
						@endforeach
					</ul>
				</div>
				<!--</div>-->
			</div>
		</div>
	</section>
	<section>
		<div class="content">
			<div class="layui-carousel" id="banner" lay-anim="" lay-indicator="inside" lay-arrow="hover">
				<div carousel-item="">
					@foreach($silder as $s)
						<div ><img src="{{asset('uploads/lun/'.$s->img)}}"></div>
					@endforeach
				</div>
				<div class="layui-carousel-ind">
					<ul>
						<li class="layui-this"></li>
						<li class=""></li>
						<li class=""></li>
						<li class=""></li>
						<li class=""></li>
						<li class=""></li>
						<li class=""></li>
					</ul>
				</div>
				<button class="layui-icon layui-carousel-arrow" lay-type="sub"><img src="{{asset('/style/home/img/index/icon-left.png')}}"></button>
				<button class="layui-icon layui-carousel-arrow" lay-type="add"><img src="{{asset('/style/home/img/index/icon-right.png')}}"><button>
			</div>
		</div>
	</section>
	<section>
		<ul class="nav-box layui-clear">{{--@if($k==0) class="product-choose"  @endif --}}
			@foreach($type as $k => $t)
				<li  @if($k==0) class="product-choose"  @endif data-id="{{$t->id}}">{{$t->name}}</li>
			@endforeach
		</ul>
	</section>
	<section>
		<ul class="product-list layui-clear">
			@foreach($good as $g)
				<li>
                    <?PHP $imgs= explode(',',$g->img); ?>
					<a href="{{route('goodsDeatil').'?id='.$g->id.'&typeid='.$g->type_id}}" style="position: relative;">
						<img src="{{asset('/uploads/goods//'.$imgs[0])}}">
						<span data-class="layui-anim layui-anim-upbit" style="position: relative;top:-60px;">{{$g->name}}</span>
						<var><font>&#165;</font><var>{{$g->price}}</var></var>
						<a class="add_cart_large btnCart"><img src="{{asset('/style/home/img/index/cart4.png')}}"></a>
					</a>
				</li>
			@endforeach
		</ul>
	</section>
	<section>
		<img src="{{asset('/style/home/img/index/bg1.jpg')}}" class="bg"/>
	</section>
	<section>
		<img src="{{asset('/style/home/img/index/bg-text1.png')}}" class="bg bg-text"/>
	</section>
	<section>
		<ul class="lanren layui-clear ">
			<li class="flip-3d">
				<figure>
					<img src="{{asset('/style/home/img/index/AD0IgPCDBxAEGAAg45GqzQUoiJuxmAYwmgI48gE.png')}}" alt="">
					<figcaption>Mouse</figcaption>
				</figure>
			</li>
			<li class="flip-3d">
				<figure>
					<img src="{{asset('/style/home/img/index/AD0IgPCDBxAEGAAgjo_qzQUouciX8AIwmgI48gE.png')}}" alt="">
					<figcaption>
						<a href="#" title=" 黄瓜西红柿 不能同时吃"> 黄瓜西红柿 不能同时吃</a>
						<span>很多餐馆里都有一道叫“大丰收”的菜，将胡萝卜、生菜、西红柿、黄瓜等不同蔬菜搭配在一起蘸酱生吃。蔬菜生吃确实有利</span>
					</figcaption>
				</figure>
			</li>
			<li class="flip-3d">
				<figure>
					<img src="{{asset('/style/home/img/index/AD0IgPCDBxAEGAAg45GqzQUoiJuxmAYwmgI48gE.png')}}" alt="">
					<figcaption>
						<a href="#" title=" 水果行业大亨分享经营的“十六字诀”"> 水果行业大亨分享经营的“十六字诀”</a>
						<span>水果是生鲜商品，其他都是生鲜食材所以今天，我很想把我对水果行业的认识来跟大家分享。所以我最重要的认识，是“水果是生一起蘸酱生吃。蔬菜生吃确实有利</span>
					</figcaption>
				</figure>
			</li>
			<li class="flip-3d">
				<figure>
					<img src="{{asset('/style/home/img/index/AD0IgPCDBxAEGAAgjo_qzQUouciX8AIwmgI48gE.png')}}" alt="">
					<figcaption>
						<a href="#" title=" 黄瓜西红柿 不能同时吃"> 黄瓜西红柿 不能同时吃</a>
						<span>很多餐馆里都有一道叫“大丰收”的菜，将胡萝卜、生菜、西红柿、黄瓜等不同蔬菜搭配在一起蘸酱生吃。蔬菜生吃确实有利</span>
					</figcaption>
				</figure>
			</li>
			<li class="flip-3d">
				<figure>
					<img src="{{asset('/style/home/img/index/AD0IgPCDBxAEGAAg45GqzQUoiJuxmAYwmgI48gE.png')}}" alt="">
					<figcaption>
						<a href="#" title=" 水果行业大亨分享经营的“十六字诀”"> 水果行业大亨分享经营的“十六字诀”</a>
						<span>水果是生鲜商品，其他都是生鲜食材所以今天，我很想把我对水果行业的认识来跟大家分享。所以我最重要的认识，是“水果是生一起蘸酱生吃。蔬菜生吃确实有利</span>
					</figcaption>
				</figure>
			</li>
		</ul>
	</section>
	<section class="other">
		<img src="{{asset('/style/home/img/index/bg-shizhong.png')}}" class="bg-shizhong">
		<div class="peisong">
			<a><img src="{{asset('/style/home/img/index/bg-peisong.png')}}" ></a>
			<font>优质产地</font>
			<font>自身优越的生长环境造就的美味 生态有机肥，有利于生长。只为了更正宗。</font>
		</div>
		<div class="peisong">
			<a><img src="{{asset('/style/home/img/index/bg-shu.png')}}"></a>
			<font>便捷的极速运达</font>
			<font>物流仓储配送，覆盖范围广，时效性强。只为了履行对客户的承诺，只为更好的用户体验。</font>
		</div>
		<div class="peisong">
			<a><img src="{{asset('/style/home/img/index/bg-taiyang.png')}}"></a>
			<font>科学的种植</font>
			<font>先进的滴灌技术，施用生态有机肥，防虫人工套袋，太阳能物理驱虫,只为更绿色。</font>
		</div>
		<div class="peisong">
			<a><img src="{{asset('/style/home/img/index/bg-gift.png')}}"></a>
			<font>放心购物</font>
			<font>为你提供健康安全的蔬果，保证优质有量的送到弄手中，只为你满意。</font>
		</div>
	</section>

@stop
@section('script')
<!--[if lte IE 8]>
<script src="js/ieBetter.js"></script>
<![endif]-->
<script>
    layui.use(['carousel', 'form'], function(){
        var carousel = layui.carousel,form = layui.form;
        //图片轮播
        carousel.render({
            elem: '#banner',
            width: '1440px',
            height: '461.25px',
            maxWidth: '100%',
            maxHeight: '100%',
            backgroundSize:'100% 100%',
            interval: 5000
        });
    });
    $(document).scroll(function(){
        var scrollTop=document.body.scrollTop||document.documentElement.scrollTop;

        if(parseFloat(scrollTop)>0){
            //$('nav').css({'position':'fixed','zIndex':'1000','top':'0px'});
            $('.mui-mbar-tabs').show();

        }else{
            //$('nav').css({'position':'relative','zIndex':'1'});
            $('.mui-mbar-tabs').hide();
        }
    })
    //搜索框
    $('.s-combobox-input').on({
        focus:function(){
            $(this).parent().next().css({'color': 'rgb(204, 204, 204)','visibility': 'visible','display': 'inline'});
        },
        blur:function(){
            $(this).parent().next().css({'color': 'rgb(102, 102, 102)','visibility': 'visible'});
        }

    });
    //分类显示
    $("ul.nav-box>li").on({
        mouseover: function() {
            $(this).addClass('product-choose').siblings().removeClass('product-choose');
            var id=$(this).attr('data-id');
            $.get("{{route('typeimg')}}",{id:id},function (data) {
                if(data.code==1){
                    var typeimg=data.typeimg.data;
                    var length=typeimg.length,str='';
                    for(var i=0;i<length;i++){
                        var href="{{route('goodsDeatil')}}"+"?id="+typeimg[i]['id']+"&typeid="+typeimg[i]['type_id'];
                        var imgs=typeimg[i]['img'].split(",");
                        var url="//"+location.host+location.pathname.substr(0,location.pathname.indexOf("index.php"))+"/uploads/goods/"+imgs[0];
                        str+="<li>\n" +
                            "\t\t\t\t\t\t<a href='"+href+"'  style=\"position: relative;\">\n" +
                            "\t\t\t\t\t\t\t<img src='"+url+"'>\n" +
                            "\t\t\t\t\t\t\t<span data-class=\"layui-anim layui-anim-upbit\" style=\"position: relative;top:-60px;\">"+typeimg[i]['name']+"</span>\n" +
                            "\t\t\t\t\t\t\t<var><font>&#165;</font><var>"+typeimg[i]['price']+"</var><font>"+typeimg[i]['rule']+"</font></var>\n" +
                            "\t\t\t\t\t\t\t<a class=\"add_cart_large btnCart\"><img src=\"{{asset('/style/home/img/index/cart4.png')}}\"></a>\n" +
                            "\t\t\t\t\t\t</a>\n" +
                            "\t\t\t\t\t\t</li>";
                        $('.product-list').html(str).addClass('layui-anim layui-anim-up');
                    }
                }else {

                }
            },'json')
            //$(this).parent().parent().next().find('ul').hide().eq($(this).index()).show().addClass('layui-anim layui-anim-up');
        },
        mouseout: function() {
            $(this).parent().parent().next().removeClass('layui-anim layui-anim-up')
        }
    });
    $("ul.product-list>li").on({
        mouseover:function(){
            $(this).find('img').eq(0).css({'width': '300px','height': '300px','overflow': 'hidden','zIndex': '1','transition':'0.4s'}).next().css({'top':'-70px'}).next().css({'top':'-65px'}).next().css({'bottom':'-125px','right':'30px'});
            //$(this).find('img').css({'width': '300px','height': '280px','overflow': 'hidden','zIndex': '1'}).next().css({'top':'-50px','zIndex':'1000' ,'transition':'0.4s'}).html($(this).find('img').attr('data-describe')).addClass($(this).find('span').attr('data-class'));
        },
        mouseout:function(){
            $(this).find('img').eq(0).css({'width': '100%','height': '100%','overflow': 'hidden','zIndex': '1000'}).next().css({'top':'-60px'}).next().css({'top':'-55px'}).next().css({'bottom':'-135px','right':'20px'});;
            //$(this).find('img').css({'width': '100%','height': '100%','overflow': 'hidden','zIndex': '1000'}).next().css({'top':'0px','zIndex':'1'}).html('').removeClass($(this).find('span').attr('data-class'));
        }
    })
    function wordLimit(){ //限制输入的字数，超过的字用省略号代替
        $(".flip-3d>figure>figcaption>span").each(function(){
            var maxwidth=48 ;
            if($(this).text().length>maxwidth){
                $(this).text($(this).text().substring(0,maxwidth));
                $(this).html($(this).html()+'...');
            }
        });
    }






    $("#search_goods").click(function () {
        var url = '{{route('show')}}';
        var goods_name = $("#goods_name").val();
        url += '?goods_name='+goods_name;
        console.log(goods_name);
        location.href = url;
    })

</script>

@endsection
