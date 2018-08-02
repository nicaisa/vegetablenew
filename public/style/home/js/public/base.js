$().ready(function(){
    //每个页面打小广告
	function init(){
		//书写轮播显示的定时操作
		setInterval(changAd,5000);
		//1.设置显示广告的定时操作
		time=setInterval(showAd,5000);
	}
	//书写轮播函数
	function changAd(){
		var content="小广告";
		return content;
	}
	//2.书写显示广告的函数
	function showAd(){
		layui.use('layer', function(){ //独立版的layer无需执行这一句
	  		var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
	  		var content=changAd();
	  		layer.open({
				area: ['390px', '260px'],//弹出层大小
				offset: 'rb',//坐标  rb:快捷设置右下角
				//theme: '#30940E',//自定义主题颜色  （墨绿主题theme: 'molv'，格子主题theme: 'grid'）
				skin: 'layui-layer-molv' ,//默认皮肤layui-layer-molv
			  	type: 1, //0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
			  	content: '<div style="padding: 20px 100px;">'+content+'</div>', //这里content是一个普通的String
			 	time: 5000,//弹出层显示时间
			  	btnAlign: 'c' ,//按钮居中  l:左  r:右
			  	shade: 0, //不显示遮罩
			 	anim: 2,//从最底部往上滑入
			  	resize:true,//是否允许拉伸   true:默认值(允许拉伸)
			  	success: function(layero, index){//层弹出后的成功回调方法
			  		for(var i=1;i<index;i++){
			  			$('#layui-layer'+i).empty();
			  		}
			  		$('#layui-layer'+index).show();
			    	//console.log(layero, index);
			  	},
			  	yes: function(index, layero){// 确定按钮回调方法
				    //do something
				    layer.close(index); //如果设定了yes回调，需进行手工关闭
				},
			  	cancel: function(index, layero){// 右上角关闭按钮触发的回调
				}    
			  	
			});
		  	//Ajax获取
			$.post('url', {}, function(str){
			  	layer.open({
			    	type: 1,
			    	content: str //注意，如果str是object，那么需要字符拼接。
			  	});
			});
		});
		clearInterval(time);
		time=setInterval(hiddenAd,5000);
	}
	
	//隐藏广告
	function hiddenAd(){
		clearInterval(time,5000);
		init();
	}
	//init();
    //搜索框
    $('.s-combobox-input').on({
        focus:function(){
            $(this).parent().next().css({'color': 'rgb(204, 204, 204)','visibility': 'hidden','display': 'inline'});
        },
        blur:function(){
            $(this).parent().next().css({'color': 'rgb(102, 102, 102)','visibility': 'visible'});
        }
    });
	//弹出框
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
                    ,id: 'layerDemo'+type //防止重复弹出
                    ,content: '<div style="padding: 20px 100px;">'+ text +'</div>'
                    ,btn: ['确认', '取消']
                    ,btnAlign: 'c' //按钮居中
                    ,shade: 0 //不显示遮罩
                    ,yes: function(){
                        layer.closeAll();
                    }
                    ,success: function(layero){
                        var btn = layero.find('.layui-layer-btn');
                        //确认
                        btn.find('.layui-layer-btn0').attr({
                            href: 'http://www.layui.com/'
                            ,target: '_blank'
                        });
                        //取消
                        btn.find('.layui-layer-btn1').attr({
                            href: 'http://www.layui.com/'
                            ,target: '_blank'
                        });
                    }
                });
            }
        };
        $(' .layui-btn').on('click', function(){
            var othis = $(this), method = othis.data('method');
            active[method] ? active[method].call(this, othis) : '';
        });

    });
    //导航栏
    layui.use('element', function(){
        var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
        //监听导航点击,事件'nav(demo)'
        element.on('nav(demo)', function(elem){
            //console.log(elem)
            layer.msg(elem.text());
        });
    });
    //搜索框
    $('.s-combobox-input').on("foucus blur",function () {
        if ($(this).val()) {
            $(this).parent().next().css({'color': 'rgb(102, 102, 102)','visibility': 'hidden','display':'none '});
        } else {
            $(this).parent().next().css({'color': 'rgb(204, 204, 204)','visibility': 'visible','display': 'inline'});
        }
    })
    //限制输入字数(导航栏的用户名字)
     /*用js限制字数，超出部分以省略号...显示*/
    function LimitNumber() {
        if($("#my var ")){
            var str = $("#my var ").text();
            str = str.substr(0,8) + '...' ;
            $("#my var ").text(str);
        }
    }
    //LimitNumber();


})
