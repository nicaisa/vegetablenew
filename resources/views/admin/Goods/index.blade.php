<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品列表</title>
    <style>
        .add-group{
            margin-top: 10px;
            float: left;
        }
        .row{
            margin-top: -10px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('style/admin/css/bootstrap.min.css')}}">
    <script src="{{asset('style/admin/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4" style="padding:20px 0 0 0;">
            <div class="input-group">
                <input type="text" class="form-control" name="name"    placeholder="请输入商品名称">
                <span class="input-group-btn">
                           <button class="btn bg-primary" style="color:white;" data-toggle="tooltip" data-placement="right" title="点我">搜索</button>
                       </span>
            </div>
            <input type="hidden" name="_method" value="get">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="add-group">
                <a href="{{route('add')}}"  class="btn btn-success">添加</a>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <!-- SELECT `id`, `name`, `state` FROM `shop_type` WHERE 1 -->
        <table class='table table-hover table-bordered table-striped'>
            <thead>
                <tr>
                    <th>商品名称</th>
                    <th width="200px">图片</th>
                    <th>价格（数字）</th>
                    <th>规格</th>
                    <th>商品类型</th>
                    <th>商品状态</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

        </table>
        <div class="pages" style="margin-left:0px;"></div>
    </div>
</div>
</body>
<!-- Ajax无刷新修改状态 -->
<script type="text/javascript">
    $(".input-group-btn").on("click",function () {
        sou(1);
    })
    function status(obj,id,status){
        if (status) {
            //route('ajaxstatus')是根据路由那边的name来的路径
            //"_token":"{{csrf_token()}}是post传值必须带的参数
            //ajax提交参数都是根据id:id方式提交
            $.post('{{route("goodstatus")}}',{id:id,"_token":"{{csrf_token()}}","status":"0"},function(data){
                // 正常变为禁用
                if (data.status==1) {
                    alert(data.message);
                    $(obj).parent().html('<td><span class="btn btn-danger btn-xs"  onclick="status(this,'+id+',0)">禁用</span></td>')
                }else{
                    alert("修改失败");
                }
            },'json')
        }else{
            //禁用变为正常json一定要记住写
            $.post('{{route("goodstatus")}}',{id:id,"_token":"{{csrf_token()}}","status":"1"},function(data){
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

    function sou(page){
        // 搜索的值
        /*$(".pages a").click(function () {
            console.log(12);
            page=$(this).attr("data-page");
        })*/
        var name=$('input[name="name"]').val();
        $.get("{{route('showgoods')}}", { 'pages':page,'name':name},function(data){
            add(data.list,data.page);
        } );
    }
    function add(data,page) {
        var str='';
        for(var i=0;i<data.length;i++){
            var status=data[i]['status'],classname='';
            if(status==0){
                status="下架";
                classname="btn btn-danger btn-xs";
            }else{
                status="上架";
                classname="btn btn-success btn-xs";
            }
            var urlup="{{route('upgoods')}}"+"?id="+data[i]["id"],//修改商品地址
                imgArr=data[i]["img"],imgStr='';
            imgArr=imgArr.split(",");
            for(var j=0;j<imgArr.length;j++){
               var  urlImg="{{asset('uploads/goods/')}}"+"/"+imgArr[j],wei=j*54;
               var img="<img src='"+urlImg+"' class=\"img img-thumbnail\" width=\"50px\" onmouseover='showBig(this)' onmouseout='hideBig(this)'>";
               var div="<div class=\"hide\" style=\"position:fixed; margin-left:"+wei+"px;margin-top: 5px;\">\n" +
                   "                                    <img class=\"img-thumbnail\" src="+urlImg+" width=\"350px\">\n" +
                   "                                </div>";
               var simg=img+div;
               imgStr+=simg;
            }
            str+="<tr>\n" +
                "                        <td>"+data[i]["name"]+"</td>\n" +
                "                        <td>"+imgStr+"</td>\n"+
                "                        <td>"+data[i]["price"]+"</td>\n" +
                "                        <td>"+data[i]["sizename"]+"</td>\n" +
                "                        <td>"+data[i]["typename"]+"</td>\n" +
                "<td><span class=\""+classname+"\"onclick=\"status(this,"+data[i]["id"]+","+data[i]['status']+")\">"+status+"</span></td>" +
                "           <a  href='"+urlup+"'class=\"btn btn-warning btn-xs\"  data-id="+data[i]["id"]+">修改</a></td>"+
                "                    </tr>";
        }//onclick='if (confirm("你确定要删除吗？")==false)return false'
        //console.log(str,1323);
        $("table>tbody").html(str);
        $(".pages").html(page);
    }
    //显示大图
    function showBig(obj) {
      $(obj).next().removeClass('hide').css({"zIndex":"100"});
    }
    //隐藏大图
    function hideBig(obj) {
        $(obj).next().addClass("hide");
    }

    console.log(location.pathname);
    //修改
    function up(obj) {
        var id=$(obj).attr("data-id");
        var urlup="{{route('upgoods')}}"+"?id="+id;
        get(id,"你确定要修改吗？",urlup,url);
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