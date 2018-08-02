﻿<!doctype html>
<html>
<head>
<style type="text/css">
span{ color:#F00;}
</style>
<meta charset="utf-8">
<title>添加商品类型</title>
<!-- 导入富文本编辑器 -->
<include file="Common/link" />   
<include file="Common/father"/><!--富文本编辑器 -->
</head>
<link rel="stylesheet" href="{{asset('style/admin/css/bootstrap.min.css')}}">
<script src="{{asset('style/admin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('style/admin/js/jquery.js')}}"></script>
<body >
<div class="site-holder">
  <div class="box-holder">
    <div class="content">
      <div class="panel panel-cascade">
        <div class="panel-heading">
          <h3 class="panel-title">
            修改商品规格
          </h3>
        </div>
        <div class="panel-body ">
          <div class="ro">
            <div class="col-mol-md-offset-2">
              {{--<form class="form-horizontal cascade-forms" action="{{route('upsize')}}" method="post"  name="signup_form">--}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id"  value="{{$data->id}}"/>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品规格名称:</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="name"   value="{{$data->name}}" required placeholder="请在这里输入姓名" class="form-control form-cascade-control input-small"/>
                  <span name="pd_mingcheng">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
             <div>
                 <label class="col-lg-2 col-md-3 control-label">状态：</label>
                 <div class="col-lg-10 col-md-9">
                   @if($data->status)
                    <input type="radio" name="status" value="0" >禁用
                    <input type="radio" name="status" value="1" checked="checked">正常
                   @else
                     <input type="radio" name="status" value="0" checked="checked">禁用
                     <input type="radio" name="status" value="1">正常
                   @endif
                 </div>
             </div>              
            <div class="panel-footer">
              <div class="row">
                <div class="form-actions" align="center">
                  <input type="button" name="submit" value="提交" class="btn bg-primary text-white btn-lg">
                  <input type="button" name="reset" value="重置" class="btn bg-primary text-white btn-lg">
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
<script type="text/javascript">
    //提交
    $("input[name='submit']").click(function () {
        var name=$("input[name='name']").val(),id=$("input[name='id']").val();
        var status=$("input[name='status']:checked").val();
        var param={
            'id':id,
            "name":name,
            "status":status,
            "_token":"{{csrf_token()}}"
        }
        $.post("{{route('upsize')}}",param,function (reg) {
            alert(reg.message);
            if(reg.code==1){
                window.location.href="{{route('sizeshow')}}";
            }
        },'json')
    })
    //重置
    $("input[name='reset']").click(function () {
        $("input[name='name']").val('');
    })
</script>
</body>
</html>