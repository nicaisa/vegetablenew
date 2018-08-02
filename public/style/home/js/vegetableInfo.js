$().ready(function(){
	//设置购买数量初始值为1
	$('#J_GoodsNum').find('input.num-input').val('1');
	//减
	$('#J_GoodsNum .num-reduce').on({
		click:function(){
			var num=$(this).next().val(),_this=this;//num:商品数量
			if(num==1){
				$(_this).addClass('num-disable').next().val(1).next().removeClass('num-disable');
			}else{
				num--;
				$(_this).removeClass('num-disable').next().val(num).next().removeClass('num-disable');
			}
		}
	})
	
	//加
	$('#J_GoodsNum .num-add').on({
		click:function(){
			var num=$(this).prev().val(),_this=this;
			var maxnum=80;//最大值（库存）
			if(num>=maxnum){
				$(_this).addClass('num-disable').prev().val(maxnum).prev().removeClass('num-disable');
			}else{
				num++;
				$(_this).removeClass('num-disable').prev().val(num).prev().removeClass('num-disable');
			}
		}
	})
	//input输入
	$("#J_GoodsNum .num-input").on("keyup blur",function(){
		var _this=this,min=1,max=80;
		_this.value = _this.value.replace(/[^\d]/g, '');//如果输入非数字，则替换为''
		var num = parseInt($(_this).val());//商品数量
		if(num<=min){
			num=min;
			$(_this).val(num).removeClass('error').prev().addClass('num-disable').next().next().removeClass('num-disable');
		}else if((num>min&&num<max)||isNaN(num)){
        	if(isNaN(num)){
        		num=min;
        	}
        	$(_this).val(num).removeClass('error').prev().removeClass('num-disable').next().next().removeClass('num-disable');
        	
        }else if(num>=max){
        	num=max;
        	$(_this).val(num).removeClass('error').prev().removeClass('num-disable').next().next().addClass('num-disable');
        }
	})
	//点击小图片显示该图片
	$('#imgShow>li').on('click',function(){
		console.log($(this).index());
		$('#J_BigImgs img').attr('src',$(this).children('img').attr('src'))
	})
})