<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>轮播图列表</title>
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
				<input type="text" class="form-control" name="title"    placeholder="请输入商品规格名称">
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
		<table class='table table-hover table-bordered table-striped'>
			<thead>
			<tr>
				<th>轮播图片</th>
				<th>排序</th>
				<th>标题</th>
				<th>友情链接</th>
				<th>添加时间</th>
				<th>状态</th>
				<th>操作</th>
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
            $.post('{{url("Silder/status")}}',{id:id,"_token":"{{csrf_token()}}","status":"0"},function(data){
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
        var name=$('input[name="title"]').val();
        $.get("{{url('Silder/index')}}", { 'pages':page,'title':name},function(data){
            console.log(data);
            //替换整个页面
            //$(".container").html(data);
            add(data.list,data.page);
        } );
    }
    function add(data,page) {
        var str='';
        for(var i=0;i<data.length;i++){
            var status=data[i]['status'],classname;
            if(status==0){
                status="禁用";
                classname="btn btn-danger btn-xs";
            }else{
                status="正常";
                classname="btn btn-success btn-xs";
            }
            //src="../../uploads/lun/silder-2018-04-24-06-25-16-T42pM0a4.jpg"
			////127.0.0.1/abc/FV_heart/public/uploads/adv/silder-2018-04-24-06-25-16-T42pM0a4.jpg
            var url="//"+location.host+location.pathname.substr(0,location.pathname.indexOf("show"));
            var urlinfo="{{route('upsilder')}}"+"?id="+data[i]["id"],//轮播图修改路径
                urlimg=url.substr(0,url.indexOf("index"))+"uploads/lun/"+data[i]["img"];//头像路径
            var wei=i*54;
            wei+='px';
            var  simg="<img src='"+urlimg+"' width='80px' height='50px' class='img img-thumbnail' onmouseover='bigshow(this)' onmouseout='bighide(this)'>" ;
            var bimg="<div class='hide' style='position:fixed; margin-left:"+wei+";margin-top: 5px;'>"+
                "<img class='img-thumbnail' src="+urlimg+" width='350px'>"+
                "</div>";
            var img=simg+bimg;
            str+="<tr>\n" +
                "                        <td>"+img+"</td>\n"+
                "                        <td>"+data[i]["order"]+"</td>\n" +
                "                        <td>"+data[i]["title"]+"</td>\n" +
                "                        <td>"+data[i]["href"]+"</td>\n" +
                "                        <td>"+data[i]["time"]+"</td>\n" +
                "<td><span class=\""+classname+"\"onclick=\"status(this,"+data[i]["id"]+","+data[i]['status']+")\">"+status+"</span></td>" +
                "<td><a  href='"+urlinfo+"'class=\"btn btn-warning btn-xs\"  data-id="+data[i]["id"]+">修改</a></td>"+
                "                    </tr>";
        }
        $("table>tbody").html(str);
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