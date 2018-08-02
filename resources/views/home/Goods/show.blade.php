@extends('home/layouts.head')

@section('header')
	<link  rel="stylesheet" href="{{asset('style/home/css/search.css')}}" media="all" />
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
				<img class="sxian-logo-img" src="{{asset('style/home/img/index/logo.png')}}" style="margin: 1px auto;display:block" data-spm-anchor-id="875.7931836/B.2015002.i0.4dc149926MkTg4" width="240px" height="130px">
			</div>
			<div class="header-extra">
				<div class="header-banner">
					<div>
					</div>
				</div>
			</div>
			<div id="mallSearch" class="mall-search">
				<div class="mallSearch-form clearfix" >
					<fieldset>
						<legend>生鲜搜索</legend>
						<div class="mallSearch-input clearfix">
							<label for="mq" style="visibility: visible; display: none;">搜索</label>
							<div class="s-combobox" id="s-combobox-138">
								<div class="s-combobox-input-wrap">
									<input name="q" accesskey="s" autocomplete="off" x-webkit-speech="" x-webkit-grammar="builtin:translate" value="{{$goods_name}}" id="goods_name_search" class="s-combobox-input" role="combobox" aria-haspopup="true" title="请输入搜索文字" aria-label="请输入搜索文字" type="text">
								</div>
								<label for="mq" class="s-combobox-placeholder" style="color: rgb(102, 102, 102); visibility: visible;">搜索 </label>
							</div>
							<button name="search" id="search">搜索<s></s></button>
							<input id="J_Type" name="type" value="p" type="hidden">
							<input id="J_MallSearchStyle" name="style" value="" type="hidden">
							<input id="J_Cat" name="cat" value="all" type="hidden">
							<input name="vmarket" value="" type="hidden">
							<input name="good_type" id="good_type" value="{{$good_type}}" type="hidden">
						</div>
					</fieldset>
				</div>
				<ul data-spm="a1z5h" class="hot-query" id="query">
					@foreach($type as $t)
						<li  class="hot-query-highlight" data-id="{{$t->id}}" style="cursor: pointer">{{$t->name}}</li>
					@endforeach
				</ul>
			</div>
			<!--</div>-->
		</div>
	</div>
</section>
<section>
	<div id="view" class="view">
	</div>
</section>
<section>
	<div id="demo7"></div>
</section>
@stop
@section('script')
<script type="text/javascript" >

    //添加数据
    //var table = document.body.querySelector('.view');
    //var cells = document.body.querySelectorAll('.product');
    function getArr(ev_count,go_count,good) {
        var str = [];
        for (var i = 0; i < go_count; i++) {
            var imgSrc=good[i]['img_url'];//商品图片的路径
                goods_name=good[i]['name'],//价格
                price=good[i]['price'],//价格
                introduce=good[i]['describe'],//介绍
                trebmls=good[i]['sales'],//月成交
                id=good[i]['id'],
                typeid=good[i]['type_id'],
                evaluat=ev_count;//评价
            var good_url="//"+location.host+location.pathname.substr(0,location.pathname.indexOf("show"))+'goodsDeatil?id='+id+'&typeid='+typeid;//商品图片跳转商品详情
            str[i] = '<div class="product-iWrap" >';
            str[i] +='<div class="productImg-wrap"><a href="'+good_url+'" data-typeid="'+typeid+'" data-goodid="'+id+'">';
            str[i] +='<img src="'+imgSrc+'" style="width:200px;height: 180px"></a>';
            str[i] +='<p class="productPrice"><em title="'+price+'"><b>¥</b>'+price+'</em></p>';
            str[i] +='<p class="productTitle"><a href="#" >'+goods_name+'</a></p>';
            str[i] +=introduce;
            str[i] +='<p class="productStatus"><span>月成交 <em>'+trebmls+'笔</em></span><span>评价 <a href="#" target="_blank">'+evaluat+'</a></span></p>'	;
            str[i] +='</div></div>';
        }
        return str;
    }


    $("#query>li").on('click',function () {
        var id=$(this).attr('data-id');
        ajax_showgood(id);
    })



    function ajax_showgood(id) {
        var goods_name = $("#goods_name_search").val();
        $.get('{{route('showgood')}}',{
            'id':id,
            'goods_name':goods_name
        },function(data){
            var ev_count=data.ev_count,//评价总数
                go_count=data.go_count,//商品总条数
                good=data.good;
            layui.use(['laypage', 'layer'], function(){
                var laypage = layui.laypage,layer = layui.layer;
                //获取数据
                var gooddata = getArr(ev_count,go_count,good);
                //调用分页
                laypage.render({
                    elem: 'demo7'//指向存放分页的容器
                    ,count: gooddata.length//数据总数
                    ,limit: 10//每页显示的条数
                    ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']//自定义排版。可选值有：count（总条目输区域）、prev（上一页区域）、page（分页区域）、next（下一页区域）、limit（条目选项区域）、 、skip（快捷跳页区域）
                    ,curr: location.hash.replace('#page=', '') //获取hash值为fenye的当前页
                    ,hash: 'page' //自定义hash值
                    ,theme: '#30940E'//自定义主题
                    ,jump: function(obj){
                        document.getElementById('view').innerHTML = function(){
                            var arr = [],
                                thisData = gooddata.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                            layui.each(thisData, function(index, item){
                                arr.push('<div class="product" style="height: 315px;">'+ item +'</div>');
                            });
                            return arr.join('');
                        }();
                    }
                });
            });
        },'json');
    }
    var type_id = $("#good_type").val();
      //搜索
    $("#search").on('click',function () {
        ajax_showgood(type_id);
    })

    ajax_showgood(type_id);
</script>
@endsection
