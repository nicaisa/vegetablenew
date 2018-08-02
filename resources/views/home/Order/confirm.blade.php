@extends('home/layouts.head')
        @section('header')
        <link rel="stylesheet" href="{{asset('/style/home/css/pay-now.css')}}" media="all" >
        <link rel="stylesheet" href="{{asset('/style/home/css/shopcard.css')}}" media="all" >
        <link rel="stylesheet" href="{{asset('/style/home/css/userInfo.css')}}" media="all" >
        <link rel="stylesheet" href="{{asset('/style/home/css/city-picker.css')}}" media="all" >
        @stop
        @section('content')
        <section>
            <div id="App" class="jet">
                <div class="page page-main">
                    <div id="confirmOrder_1" class="order-confirmOrder">
                        <div class="order-stepbar">
                            <h1 class="buy-logo">
                                <a href="index.html" target="_top" title="生鲜网"><i></i><span>生鲜网</span></a>
                            </h1>
                            <ol class="tb-stepbar">
                                <li class="stepbar-4 stepbar-first ">
                                    <span class="stepbar-current">1. 确认订单信息</span>
                                    <i class="current"></i>
                                </li>
                                <li class="stepbar-4" >
                                    <span>2. 付款</span>
                                    <i></i>
                                </li>
                                <li class="stepbar-4" >
                                    <span>3. 确认收货</span>
                                    <i></i>
                                </li>
                                <li class="stepbar-4 stepbar-last" >
                                    <span>4. 双方互评</span>
                                </li>
                            </ol>
                        </div>
                        <div class="order-address">
                            <div class="order-address-wrap">
                                <h3>
                                    <span>确认收货地址</span>
                                    <span class="manage-address">
                                                <a href="{{route('address')}}"  title="管理我的收货地址" >管理收货地址</a>
                                            </span>
                                </h3>
                                @if($address)
                                <ul class="address-list">
                                    @foreach($address as $v)
                                        <li class="address-wrap default @if($v->default==1) selected @endif">
                                            <div class="addressBox">
                                                <div class="layui-clear"><i class="marker"></i><span class="marker-tip" >寄送至</span></div>
                                                <label class="addressInfo">
                                                    <input name="address" value="{{$v->address_id}}" type="radio"><label @if($v->default==1) class="check" @endif></label>
                                                    <span class="user-address">
                                                            <span>{{str_replace(',',' ',$v->region)}}</span>
                                                            <span>{{$v->address}}</span>
                                                            <span>（</span>
                                                            <span>{{$v->name}}</span>
                                                            <span> 收）</span>
                                                            <em>{{$v->tel}}</em>
                                                        </span>
                                                    <span class="tips" >
                                                        @if($v->default==1)
                                                            <em class="default">默认地址</em>
                                                        @else
                                                            <em class="set-default">设置为默认收货地址</em>
                                                        @endif
                                                        </span>
                                                    <a class="modify" href="{{route('address').'?address_id='.$v->address_id}}" >修改本地址</a>
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                                <div class="btn-bar">
                                    <a class="newAddrBtn" href="{{route('address')}}" ><i></i><label>使用新地址</label></a>
                                </div>
                            </div>
                        </div>
                        <div id="orderDesc_0" class="order-orderDesc">
                            <h2 class="buy-th-title" >确认订单信息</h2>
                        </div>
                        <div id="J_CartMain" class="cart-main">
                            <div class="cart-table-th">
                                <div class="wp">
                                    <div class="th th-item">
                                        <div class="td-inner">商品信息</div>
                                    </div>
                                    <div class="th th-info">
                                        <div class="td-inner">kong</div>
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
                                </div>
                            </div>
                            <div class="" id="J_OrderList">
                                <div id="J_OrderHolder" style="height: auto;">
                                    <div class="J_Order layui-clear order-body">
                                        <div class="J_ItemHead shop layui-clear">
                                            <div class="order-promo-info">
                                                <div class="scrolling-container">
                                                    <ul class="scrolling-promo-hint J_ScrollingPromoHint" style="position: relative;top: 0px;">
                                                        <li class="ks-switchable-panel-internal151" style="display: block;"></li>
                                                        <li class="ks-switchable-panel-internal151" style="display: block;"></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-content"  id="cart_list">
                                            @if(isset($goods_order))
                                                @foreach($goods_order as $v)
                                                <div  class="item-list order_confirm">
                                                    <div   class="bundle  bundle-last ">
                                                        <div  class="item-holder">
                                                            <div class="J_ItemBody item-body layui-clear item-normal  first-item ">
                                                                <ul class="item-content layui-clear ">
                                                                    <li class="td td-item">
                                                                        <div class="td-inner">
                                                                            <div class="item-pic J_ItemPic img-loaded" style="margin-left: 20px;">
                                                                                <a href="{{route('goodsDeatil').'?id='.$v['goods_id'].'&typeid='.$v['type_id']}}" data-title="" class="J_MakePoint" data-point="tbcart.8.12" data-spm-anchor-id="a1z0d.6639537.1997196601.3">
                                                                                    <img src="{{$v['good_thumb']}}" class="itempic J_ItemImg">
                                                                                </a>
                                                                            </div>
                                                                            <div class="item-info">
                                                                                <div class="item-basic-info">
                                                                                    <a href="{{route('goodsDeatil').'?id='.$v['goods_id'].'&typeid='.$v['type_id']}}" class="item-title J_MakePoint"  title="">{{$v['goods_name']}}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="td td-info">
                                                                        <div class="item-props item-props-can">
                                                                            <p class="sku-line" tabindex="0">重量：500g</p>
                                                                            <span tabindex="0" class="btn-edit-sku J_BtnEditSKU J_MakePoint" data-point="tbcart.8.10">修改</span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="td td-price">
                                                                        <div class="td-inner">
                                                                            <div class="item-price price-promo-">
                                                                                <div class="price-content">
                                                                                    <div class="price-line">
                                                                                        <em class="price-original">￥{{$v['goods_price']}}</em>
                                                                                    </div>
                                                                                    <div class="price-line">
                                                                                        <em class="J_Price price-now" tabindex="0">￥{{$v['goods_price']}}</em>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="td td-amount">
                                                                        <div class="td-inner">
                                                                            <div class="amount-wrapper ">
                                                                                <div class="item-amount ">
                                                                                    <a class="J_Minus minus active">-</a>
                                                                                    <input value="{{$v['goods_num']}}" class="text text-amount J_ItemAmount" data-max="4579" data-now="{{$v['goods_num']}}" autocomplete="off" type="text">
                                                                                    <a  class="J_Plus plus active ">+</a>
                                                                                </div>
                                                                                <div class="amount-msg J_AmountMsg">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="td td-sum">
                                                                        <div class="td-inner">
                                                                            <em tabindex="0" class="J_ItemSum number">￥{{$v['goods_num'] * $v['goods_price']}}</em>
                                                                            <div class="J_ItemLottery"></div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="{{$v['goodsId_lock']}}" name="goodsId_lock"  >
                                                    <input type="hidden" value="{{$v['cartId_lock']}}" name="cartId_lock" >
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="order-orderExt">
                                            <div class="order-extUser">
                                                <div class="order-memo">
                                                    <label class="memo-name" >给卖家留言：</label>
                                                    <div class="memo-hint">
                                                        <a class="hint-title">重要提醒</a>
                                                        <div class="mui-msg mui-msg-normal hint-content">
                                                            <ins class="mui-msg-icon mui-msg-icon-tip" ></ins>
                                                        </div>
                                                    </div>
                                                    <div class="memo-detail">
                                                        <textarea class="text-area-input memo-input" placeholder="选填:填写内容已和卖家协商确认" ></textarea>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-extInfo">
                                            <div class="order-deliveryMethod">
                                                <div>
                                                    <div class="delivery-title">运送方式:</div>
                                                    <div class="delivery-select">
                                                        <div>
                                                            <div class="select-item">
                                                                <div class="select-info">
                                                                    <div class="delivery-box">
                                                                        <div>
                                                                            <label>普通配送</label>
                                                                            <span data-price="{{$distribution_fee}}">快递&#165;{{$distribution_fee}}</span>
                                                                            <span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="select-price">{{$distribution_fee}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order-deliveryMethod">
                                                <div class="layui-clear">
                                                    <div class="paybox" style="float:left;margin-left: 100px">
                                                        <input value="1" type="hidden" name="pay_type"  class="pay" >
                                                        <i class="payway" style=" background: url({{asset('style/home/img/radio-checked.png')}}) no-repeat center center;display: block;height: 16px;width:16px;float: left;vertical-align: middle;"></i>
                                                        <label style="display: block;float:left;text-indent: 5px;">支付宝支付</label>
                                                    </div>
                                                    <div class="paybox" style="float:left;margin-left: 50px">
                                                        <input value="2" type="hidden" name="pay_type" class="pay">
                                                        <i class="payway" style=" background: url({{asset('style/home/img/radio-unchecked.png')}}) no-repeat center center;display: block;height: 16px;width:16px;float: left;vertical-align: middle;"></i>
                                                        <label style="display: block;float:left;text-indent: 5px;">微信支付</label>
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="orderPay">
                                            <span>合计</span>
                                            <span>(含运费)</span>
                                            <span class="price g_price">
                                                    <span>&#165;</span>
                                                    <em class="style-middle-bold-red J_ShopTotal">{{$distribution_fee}}</em>
                                                </span>
                                        </div>
                                        <div class="order-payInfo">
                                            <div class="payInfo-wrapper">
                                                <div class="payInfo-shadow">
                                                    <div class='order-realPay'>
                                                        <div>
                                                            <span class="realPay-title">实付款：</span>
                                                            <span class="order-price">&#165;</span>
                                                            <span class="realPay-price">{{$total_price}}</span>
                                                        </div>
                                                    </div>
                                                @if($address)
                                                    @foreach($address as $v)
                                                            {{--<span>{{$v->region}}</span>--}}
                                                            {{--<span>{{$v->address}}</span>--}}
                                                            {{--<span>（</span>--}}
                                                            {{--<span>{{$v->name}}</span>--}}
                                                            {{--<span> 收）</span>--}}
                                                            {{--<em>{{$v->tel}}</em>--}}
                                                        {{--</span>--}}
                                                        @if($v->default==1)
                                                            <div class="order-confirmAddr">
                                                                <div class="confirmAddr-addr" title="南岸区花园路街道 重庆市南岸区环湖路14号（聚丰花园）">
                                                                    <span class="confirmAddr-title">寄送至：</span>
                                                                    <span class="confirmAddr-addr-bd">
                                                                        <span class="prov">重庆</span>
                                                                        <span class="city" >重庆市</span>
                                                                        <span class="dist" >南岸区</span>
                                                                       <span class="town" >花园路街道</span>
                                                                      {{--   <span class="street" data-street="重庆市南岸区环湖路14号（聚丰花园）">重庆市南岸区环湖路14号（聚丰花园）</span>
                                                                   --}} </span>
                                                                </div>
                                                            </div>
                                                            <div class="confirmAddr-addr-user">
                                                                <span class="confirmAddr-title" >收货人：</span>
                                                                <span class="confirmAddr-addr-bd">
                                                                    <span >丽丽</span>
                                                                    <span >15123456789</span>
                                                                </span>
                                                            </div>
                                                        @endif

                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" value="" name="cartId_select" >
                                        <input type="hidden" value="" name="addressId_select" >
                                        <div id="submitOrder_1" class="order-submitOrder">
                                            <div class="wrapper">
                                                <a role="button" id="order_submit" title="提交订单" class="go-btn">提交订单</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        @stop
        @section('script')
        <script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.data.js')}}"></script>
        <script type="text/javascript" src="{{asset('/style/home/js/address/city-picker.js')}}"></script>
        <script type="text/javascript" src="{{asset('/style/home/js/shopcard.js')}}"></script>
        <script type="text/javascript">
            var height=document.body.scrollHeight,width=window.screen.availWidth;
            //设置遮罩层
            $('#bg').hide().css({'background':'rgba(0,0,0,0.5)',
                'height':height+'px',
                'width': width +'px',
                'marginTop':- height+200 +'px',
                'zIndex':'100'
            }).children('.form-box').hide().css({
                'margin':'0px auto',
                'marginTop': (height-$('.form-box').outerHeight(true))/2+'px',
                'textAglin':'center',
                'zIndex':'101',
                'position':'relative',

            }).find('#city-picker').css({"marginTop":'-28px','position':'relative'});

            //选择支付方式
            $(".payway").on("click",function () {
                $(".payway").css({
                    'background':'url({{asset('style/home/img/radio-unchecked.png')}}) no-repeat center center'
                });
                //$(".pay").val(0);
                if( $(this).css("backgroundUrl")=="url({{asset('style/home/img/radio-checked.png')}}) no-repeat center center"){
                    $(this).css({
                        'background':'url({{asset('style/home/img/radio-unchecked.png')}}) no-repeat center center'
                    });
                   // $(this).prev().val(2);
                }else{
                    $(this).css({
                       'background':'url({{asset('style/home/img/radio-checked.png')}}) no-repeat center center'
                    });
                    //$(this).prev().val(1);
                }
            })
            //选择配送地址
            $(".address-list>li").on("click",function () {
                $(".address-list>li").removeClass("selected").find("label.addressInfo").children("label").removeClass("check");
                $(this).addClass("selected").find("label.addressInfo").children("label").addClass("check");
                sendinfo();
            })
            //"提交订单"前面的收货地址
            function sendinfo() {
                $(".address-list>li").each(function () {
                    var _this=this;
                    if($(_this).hasClass("selected")){
                        var obj=$(_this).find(".user-address").children('span');
                        var address=obj.eq(0).html()+' '+obj.eq(1).html(),i=0,j=0;
                        var consignee=obj.eq(3).html()+' '+obj.eq(4).next().html();
                        var address_id=$(_this).find("input[name='address']").val();

                        address=address.split(" ");
                        consignee=consignee.split(" ");
                        $(".confirmAddr-addr-bd").eq(0).children('span').each(function () {//收货地址
                            var _t=this;
                            $(_t).html(address[i]);
                            i++;
                        });
                        $(".confirmAddr-addr-bd").eq(1).children('span').each(function () {//收货人
                            var _t=this;
                            $(_t).html(consignee[j]);
                            j++;
                        });
                        $("input[name='addressId_select']").val(address_id);
                    }
                })
            }
            sendinfo();
            //点击保存按钮
            $("#save").on('click',function(){
                $('#bg').hide().children('.form-box').hide();
            });
            //设置默认地址
            $('.address-wrap').on({
                'mouseover':function(){
                    $('.address-wrap').find('.set-default').hide();
                    $(this).find('.set-default').show()
                },
                'mouseout':function(){
                    $('.address-wrap').find('.set-default').hide();
                }
            });
            $(".set-default").on({
                'click':function(){
                    var _this=this;
                    $('.address-list').each(function(){
                        var _t=this;
                        console.log($(_t).find('.default'),111);
                        if($(_t).find('em').hasClass('default')){
                            var em=$(_t).find('em.default');
                            em.removeClass('default').addClass('set-default').html('设置为默认地址').parent().prev().prev().removeClass('check');
                        }
                    })
                    $(_this).removeClass('set-default').addClass('default').html('默认地址').show().parent().prev().prev().addClass('check');
                }
            });
            /*$(".order-deliveryMethod .paybox").each(function () {
                var _this=this,payway=0;
                if($(_this).find("i").css("background").indexOf("radio-checked.png")!=-1){
                    payway=$(_this).find("input").val();
                }
                console.log(payway,111);
            })*/

            //提交订单
            $("#order_submit").click(function () {
                var order=[];
                $(".order_confirm").each(function (index) {
                    var _this=this;
                    var goodsId=$(_this).children("input[name='goodsId_lock']").val(),
                        cartId=$(_this).children("input[name='cartId_lock']").val(),
                    num=$(_this).find(".J_ItemAmount").attr("data-now");
                    var orderArr={};
                    console.log(index,goodsId);
                    orderArr["goodsId"]=goodsId;
                    orderArr["cartId"]=cartId;
                    orderArr["num"]=num;
                    order.push(orderArr);
                });
                var total_price = $(".realPay-price").html();
                var addressId_select = $("input[name='addressId_select']").val();   //选择的收货地址
                var url='{{ route('order_submit') }}';
                var payway='';//支付方式的值
                $(".order-deliveryMethod .paybox").each(function () {
                    var _this=this;
                    if($(_this).find("i").css("background").indexOf("radio-checked.png")!=-1){
                        payway=$(_this).find("input").val();
                    }
                })
                console.log(JSON.stringify(order));
                console.log('订单',order);
                $.ajax(url,{
                    data:{
                        'order_info' : JSON.stringify(order),
                        'total_price' : total_price,
                        'addressId' : addressId_select,
                        '_token': '{{csrf_token()}}'
                    },
                    type:'post',
                    success: function (data) {
                        if(data.code == 1){
                            var id=data.order_id;
                            var url='{{ route('pay') }}';
                            $.post(url,{'order_id':id, 'payway':payway, '_token': '{{csrf_token()}}'},function (reg) {
                                if(reg.status==1){
                                    window.location.href=reg.pay_url;
                                }
                            },'json')
                            console.log(data.message,'success');
                        }else{
                            alert(data.message);
                        }
                    },
                    dataType:'json'
                })
            });
            //点击修改本地址，跳转到shipping-address.html
            $('.modify').on('click',function(){
                var info=$(this).prev().prev().children('span');
                var areaa=info.eq(0).html().trim(),//地区
                    detail=info.eq(1).html().trim(),//详细收货地址
                    name=info.eq(3).html().trim(),//收货人
                    phone=info.eq(4).next('em').html().trim(),//电话
                    address_id=$(this).siblings("input[name='address']").val();//地址id
                var userEntity ={
                    'areaa':areaa,
                    'detail':detail,
                    'name':name,
                    'phone':phone,
                    'address_id':address_id
                };
                // 存储值：将对象转换为Json字符串
                sessionStorage.setItem('consignee', JSON.stringify(userEntity));
                window.location.href='{{route('address')}}';
            })
            //用户在pay-now.html页面，点击“管理收货地址”，跳转到修改收货地址页面（shipping-address.html），销毁consignee
            $('.manage-address>a,.newAddrBtn').on('click',function () {
                sessionStorage.removeItem('consignee');
            })
        </script>
@endsection
