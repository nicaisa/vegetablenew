<!doctype html>
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
<link rel="stylesheet" href="../../style/admin/css/bootstrap.min.css">
<script src="../../style/admin/js/jquery-1.11.1.min.js"></script>
<script src="../../style/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../style/admin/js/jquery.js"></script>
<body >
           
<div class="site-holder">
  <div class="box-holder">
    <div class="content">
      <div class="panel panel-cascade">
        <div class="panel-heading">
          <h3 class="panel-title">
            添加商品类型
          </h3>
        </div>
        <div class="panel-body ">
          <div class="ro">
            <div class="col-mol-md-offset-2">
              <!-- SELECT `id`, `addtime`, `name`, `status` FROM `shop_type` WHERE 1 -->
              <form class="form-horizontal cascade-forms" action="{{route('addtype')}}" method="POST"  name="signup_form">
                    <!-- <input type="hidden" name="_method" value="PUT"> -->
                    <!-- 这里的value非常重要，要与路由的方式一致 -->
                    <input type="hidden" name="_method" value="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品类型名称：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="name"  required placeholder="请在这里输入商品类型" class="form-control form-cascade-control input-small"/>
                  <span name="pd_mingcheng">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
              <div>
                   <label class="col-lg-2 col-md-3 control-label">状态：</label>
                   <div class="col-lg-10 col-md-9">
                     <input type="radio" name="status" value="0">禁用
                     <input type="radio" name="status" value="1" checked="checked">正常
                   </div>
               </div>    
            <div class="panel-footer">
              <div class="row">
                <div class="form-actions" align="center">
                  <input type="submit" value="提交" class="btn bg-primary text-white btn-lg">
                  <input type="reset" value="重置" class="btn bg-primary text-white btn-lg">
                </div>
              </div>
            </div> 
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div> 
</div>
</body>
</html>