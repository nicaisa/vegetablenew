<!doctype html>
<html>
<head>
<style type="text/css">
span{ color:#F00;}
</style>
<meta charset="utf-8">
<title>添加管理员</title>
</head>
 <link rel="stylesheet" href="{{asset('style/admin/css/bootstrap.min.css')}}">
 <script src="{{asset('style/admin/jquery/jq-3.3.1.min.js')}}"></script>
 <script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
<body >
<div class="site-holder">
  <div class="box-holder">
    <div class="content">
      <div class="panel panel-cascade">
        <div class="panel-heading">
          <h3 class="panel-title">
            添加管理员
          </h3>
        </div>
        <div class="panel-body ">
          <div class="ro">
            <div class="col-mol-md-offset-2">
              <form class="form-horizontal cascade-forms" action="" name="signup_form" id="addform" onsubmit="return false">
               <input type="hidden" name="_token" value="{{ csrf_token()}}">
              <div class="form-group">
              <!--管理员text-->
              <label class="col-lg-2 col-md-3 control-label">姓名：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="name"  required placeholder="请在这里输入姓名" class="form-control form-cascade-control input-small" id="name" />
                      <div id="nameinfo" style="width:80%; height:10%;">
                         
                      </div>
                </div>
              </div>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">密码：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="password"  name="pwd"  required placeholder="请在这里输入密码" class="form-control form-cascade-control input-small" id="pwd" />
                       <div id="pwdinfo" style="width:80%; height:10%;">
                         
                       </div>
                </div>
              </div>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">确认密码：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="password"  name="repwd" required placeholder="请在这里输入权限" class="form-control form-cascade-control input-small" id="repwd" />
                  <span name="pd_permission">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
            <div class="panel-footer">
              <div class="row">
                <div class="form-actions" align="center">
                  <input type="submit" value="提交" class="btn bg-primary text-white btn-lg" onclick="adds()"/>
                  <input type="reset" value="重置" class="btn bg-primary text-white btn-lg" id="reset">
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
<!-- ajax无刷新添加 -->
<script type="text/javascript">
  function adds(){
     // 表单序列化
    str=$("#addform").serialize();
    //提交数据
    $.post('{{route("store")}}',{str:str,'_token':'{{csrf_token()}}'},function(data){
      if (data.code==1) {
        //重置表单
        $("#reset").click();
        //清空提示信息
        $("#nameinfo").html('');
        $("#passinfo").html('');
        //提示用户添加成功
        alert(data.message);
        //跳转到首页
        window.location.href="{{route('findadmin')}}";
      } else if(data){
             var str='';
             //用户
             if (data.name) {
               str="<div class='alert alert-danger'>"+data.name+"</div>"
             }else{
               str="<div class='alert alert-success'>√</div>"
             }
             //赋值给html
             $("#nameinfo").html(str);
             //密码
             if (data.pwd) {
               str="<div class='alert alert-danger'>"+data.pwd+"</div>"
             }else{
               str="<div class='alert alert-success'>√</div>"
             }
             //赋值给html
             $("#pwdinfo").html(str);
      }
      else{
        //提示用户添加失败
        alert(data.message);
      }
      
    },'json');  

  }
</script>