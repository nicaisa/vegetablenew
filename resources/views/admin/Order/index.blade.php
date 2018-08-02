<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品订单列表</title>
    <style>
        .add-group{
            margin-top: 10px;
            float: left;
        }
        .row{
            margin-top: -10px;
        }
    </style>
    <link rel="stylesheet" href="../../style/admin/css/bootstrap.min.css">
    <script src="../../style/admin/js/jquery-1.11.1.min.js"></script>
    <script src="../../style/admin/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4" style="padding:20px 0 0 0;">
            <div class="input-group">
                <input type="text" class="form-control" name="order_id"    placeholder="请输入订单号">
                <span class="input-group-btn">
                   <button class="btn bg-primary" style="color:white;" data-toggle="tooltip" data-placement="right" title="点我">搜索</button>
               </span>
            </div>
            <input type="hidden" name="_method" value="get">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
        </div>
    </div>
    <br/>
    <div class="row">
        <!-- SELECT `id`, `name`, `state` FROM `shop_type` WHERE 1 -->
        <table class='table table-hover table-bordered table-striped table1'>
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>订单号</th>
                <th>商品总价</th>
                <th>收货地址</th>
                <th>联系人电话</th>
                <th>收货人</th>
                <th>支付时间</th>
                <th>下单时间</th>
                <th>修改时间</th>
                <th>备注</th>
                <th>订单状态</th>
            </tr>
            </thead>
            <tbody>
            </tbody>

        </table>
        <div class="pages" style="margin-left:0px;"></div>
        <div class="getOrder" style="display: none;">
            <table class="table table-hover table-bordered table-striped">
                <tbody>
                    <tr>
                        <td >订单号</td>
                        <td class="ddh"></td>
                    </tr>
                    <tr>
                        <td >运单号</td>
                        <td><input value="" placeholder="请输入运单号" name="expressNum" class="width:300px;height:20px;"></td>
                    </tr>
                </tbody>
            </table>
            <div style="margin: 0px auto;width: 100%;">
                <button type="button" class="btn btn-success" name="confrim">确认</button>
                <button type="button" class="btn btn-danger" name="qx">取消</button>
            </div>
        </div>
    </div>
</div>
</body>
<!-- Ajax无刷新修改状态 -->
<script type="text/javascript">
    //确认
    $("button[name='confrim']").click(function () {
        var expressNum=$('input[name="expressNum"]').val();
        var orderId= $(".ddh").html();
        $.post("{{route('delivery')}}",{"orderId":orderId,'expressNum':expressNum,'_token':'{{csrf_token()}}'},function (data) {
             console.log(data);
        },'json')

    })
    //取消
    $("button[name='qx']").click(function () {
        $(".getOrder").hide();
    })
    $(".input-group-btn").on("click",function () {
        sou(1);
    })
    function state(obj,id,status){
        if (status) {
            //route('ajaxstatus')是根据路由那边的name来的路径
            //"_token":"{{csrf_token()}}是post传值必须带的参数
            //ajax提交参数都是根据id:id方式提交
            if(status==2){
                var text=$(obj).parent().parent().children('td').eq(2).html();
                $(".getOrder").show();
                $(".ddh").html(text);
            }
        }else{
            //禁用变为正常json一定要记住写
            $.post('{{url("Silder/status")}}',{id:id,"_token":"{{csrf_token()}}","status":"1"},function(data){
                if (data.status==1) {
                    //弹出状态码
                    alert(data.message);
                    $(obj).parent().html('<td><span class="btn btn-success btn-xs"  onclick="status(this,'+id+',1)">正常</span></td>')
                }else{
                    alert("修改失败");
                }
            },'json')

        }
    }
    function del(obj,id){
        $.post('{{route("del")}}',{id:id,"_token":"{{csrf_token()}}"},function(data){
            if (data.code==1) {
                $(obj).parent().parent().remove();
                alert(data.message)
            }else{
                alert(data.message);
            }
        },'json');
    }
    function sou(page){
        var name=$('input[name="order_id"]').val();
        $.get("{{route('ordershow')}}", { 'pages':page,'order_id':name},function(data){
            console.log(data);
            //替换整个页面
            //$(".container").html(data);
            add(data.list,data.page);
        } );
    }
    function add(data,page) {
        var str='';
        for(var i=0;i<data.length;i++){
            var state=data[i]['state'],classname='';
            // 1待付款(已提交)  2已付款(待发货)  3待收货  4已收货(待评价) 5已完成
            if(state==1){
                state="待付款";
                classname="btn btn-danger btn-xs";
            }else if(state==2){
                state="待发货";
                classname="btn btn-primary btn-xs";
            }else if(state==3){
                state="待收货";
                classname="btn btn-warning btn-xs";
            }else if(state==4){
                state="已发货";
                classname="btn btn-info btn-xs";
            }else if(state==5){
                state="已完成";
                classname="btn btn-success btn-xs";
            }
            var url="//"+location.host+location.pathname.substr(0,location.pathname.indexOf("show"));
            var urlinfo=url.substr(0,url.indexOf("index"))+"upadv/"+data[i]["id"],//广告修改路径
                urlimg=url.substr(0,url.indexOf("index"))+"uploads/adv/"+data[i]["img"];//头像路径
            var wei=i*54;
            wei+='px';
            var  simg="<img src='"+urlimg+"' width='80px' height='50px' class='img img-thumbnail' onmouseover='bigshow(this)' onmouseout='bighide(this)'>" ;
            var bimg="<div class='hide' style='position:fixed; margin-left:"+wei+";margin-top: 5px;'>"+
                "<img class='img-thumbnail' src="+urlimg+" width='350px'>"+
                "</div>";
            var img=simg+bimg;
            str+="<tr>\n" +
                "                        <td>"+data[i]["id"]+"</td>\n"+
                "                        <td>"+data[i]["user_id"]+"</td>\n"+
                "                        <td class='order-id'>"+data[i]["order_id"]+"</td>\n" +
                "                        <td>"+data[i]["total_price"]+"</td>\n" +
                "                        <td>"+data[i]["address"]+"</td>\n" +
                "                        <td>"+data[i]["tel"]+"</td>\n" +
                "                        <td>"+data[i]["Consignee"]+"</td>\n" +
                "                        <td>"+data[i]["pay_time"]+"</td>\n" +
                "                        <td>"+data[i]["create_time"]+"</td>\n" +
                "                        <td>"+data[i]["update_time"]+"</td>\n" +
                "                        <td>"+data[i]["remark"]+"</td>\n" +
                "<td><span class=\""+classname+"\"onclick=\"state(this,"+data[i]["id"]+","+data[i]['state']+")\">"+state+"</span></td>" +
                "                    </tr>";
        }
        $("table.table1>tbody").html(str);
        $(".pages").html(page);
    }
    function bigshow(obj) {
        $(obj).next().removeClass('hide');
    }
    function bighide(obj) {
        $(obj).next().addClass('hide');
    }
    //ajax
    function get(id,thishi,geturl,url) {
        if(confirm(thishi)){
            $.get(""+geturl+"",{"id":id},function (reg) {
                if (reg.code==1){
                    alert(reg.message);
                    window.location.href=url+"show";
                }else {
                    alert(reg.message)
                }

            })
        }else{
            return false;
        }
    }
    sou(1);
</script>
</html>