<!doctype html>
<html>
<head>
<style type="text/css">
span{ color:#F00;}
</style>
<meta charset="utf-8">
<title>添加轮播图</title>
<!-- 导入富文本编辑器 -->
<include file="Common/link" />   
<include file="Common/father"/><!--富文本编辑器 -->
</head>
<link rel="stylesheet" href="{{asset('style/admin/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('style/home/layui/css/layui.css')}}">
<script src="{{asset('style/admin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('style/admin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('style/home/layui/layui.js')}}"></script>
<link rel="stylesheet"  href="{{asset('style/admin/css/uploads.css')}}">
<body >
<div class="site-holder">
  <div class="box-holder">
    <div class="content">
      <div class="panel panel-cascade">
        <div class="panel-heading">
          <h3 class="panel-title">
            添加轮播图
          </h3>
        </div>
        <div class="panel-body ">
          <div class="ro">
            <div class="col-mol-md-offset-2">
                <div class="layui-upload">
                    <button type="button" class="layui-btn" id="test1">上传图片</button>
                    <div class="layui-upload-list">
                        <img class="layui-upload-img" id="demo1">
                        <p id="demoText"></p>
                    </div>
                </div>
          <form class="form-horizontal cascade-forms" action="{{route('addsilder')}}" method="post"  name="signup_form">
                   <input type="hidden" name="_method" value="post"/>
                   <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                  <input type="hidden" name="img" value="">
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">轮播图标题：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="title"  required placeholder="请在这里输入轮播图标题" class="form-control form-cascade-control input-small"/>
                  <span name="pd_mima">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">排序：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="order"  required placeholder="请在这里输入密码" class="form-control form-cascade-control input-small"/>
                  <span name="pd_mima">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">友情链接：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="href" required placeholder="请在这里输入权限" class="form-control form-cascade-control input-small"/>
                  <span name="pd_permission">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
              <div class="form-group">
              <div>
                  <label class="col-lg-2 col-md-3 control-label">状态：</label>
                  <div class="col-lg-10 col-md-9">
                    <input type="radio" name="status" value="0">禁用
                    <input type="radio" name="status" value="1" checked="checked">正常
                  </div>
              </div>
              </div>
            <div class="panel-footer">
              <div class="row">
                <div class="form-actions" align="center">
                  <input type="submit" value="提交" class="btn bg-primary text-white btn-lg" id='tijiao'>
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
<script type="text/javascript">
    var img='';
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;
        //普通图片上传
        var uploadInst = upload.render({
            elem: '#test1'
            ,url: "{{route('upload')}}"
            ,data:{
                _token:"{{ csrf_token()}}",
                _method:"post"
            }
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
                }
                //上传成功
                //status=1代表上传成功,获取上传图片的名字
                if(res.status ==  1){
                    var url=res.url;
                    url=url.substr(url.indexOf('silder-'));
                    img=url;
                    $('input[name="img"]').val(img);
                }
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });
</script>
</body>
</html>