<!doctype html>
<html>
<head>
<style type="text/css">
span{ color:#F00;}
</style>
<meta charset="utf-8">
<title>修改轮播图信息</title>
<!-- 导入富文本编辑器 -->
<include file="Common/link" />   
<include file="Common/father"/><!--富文本编辑器 -->
</head>
<link rel="stylesheet" href="{{asset('style/admin/css/bootstrap.min.css')}}">
<script src="{{asset('style/admin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('style/admin/js/jquery.min.js')}}"></script>
<link rel="stylesheet"  href="{{asset('style/admin/css/uploads.css')}}">
<body >
<div class="site-holder">
  <div class="box-holder">
    <div class="content">
      <div class="panel panel-cascade">
        <div class="panel-heading">
          <h3 class="panel-title">
            修改播图信息
          </h3>
        </div>
        <div class="panel-body ">
          <div class="ro">
            <div class="col-mol-md-offset-2">
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">轮播图：</label>
                <div class="col-lg-10 col-md-9">
                <div class="container">
                    <div class="preview-image-box">
                        <div class="inside-image-box">
                            <img class="uploaded-image" src="../../uploads/lun/{{$data->img}}"  alt=""/>
                        </div>
                        <div class="loading-shadow">
                            <div class="loading-icon">
                                <img src="{{asset('uploads/lun/loading.gif')}}" alt=""/>
                            </div>
                        </div>
                    </div>
                    <div class="js-reset-image">
                        <span class="upload-text on">上传</span>
                        <span class="re-upload-text">重新上传</span>
                    </div>
                    <form id="uploadForm" action="{{url('upload')}}" method="post"">
                    {{csrf_field()}}
                    <input style="display: none;" name="image" type="file" class="inputFile" />
                    </form>
                </div>
                </div>
              </div>
          <form class="form-horizontal cascade-forms" action="{{route('upsilder')}}" method="post"  name="signup_form">
                   <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                   <input type="hidden" name="img" value=""/>
                   <input type="hidden" name="id" value="{{$data->id}}"/>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">轮播图标题：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="title"  value="{{$data->title}}" required placeholder="请在这里输入轮播图标题" class="form-control form-cascade-control input-small"/>
                  <span name="pd_mima">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">排序：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="order"   value="{{$data->order}}" required placeholder="请在这里输入密码" class="form-control form-cascade-control input-small"/>
                  <span name="pd_mima">&nbsp;</span><b>&nbsp;</b>
                </div>
              </div>
              <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">友情链接：</label>
                <div class="col-lg-10 col-md-9">
                  <input type="text"  name="href"  value="{{$data->href}}" required placeholder="请在这里输入权限" class="form-control form-cascade-control input-small"/>
                  <span name="pd_permission">&nbsp;</span><b>&nbsp;</b>
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
$(function (e) {
    $('#uploadForm').submit(function(e){
      e.preventDefault();
        $.ajax({
            url: "{{route('upload')}}",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            // 显示加载图片
            beforeSend: function () {
                $('.loading-shadow').addClass('active');
            },
            success: function (data) {
                // 移除loading加载图片
                $('.loading-shadow').removeClass('active');
                // 显示上传图片
                $('.uploaded-image').attr('src', "{{asset('uploads/lun')}}" + '/'+data.msg)
                ;
                //获取图片名字
                var imgsrc=$('.uploaded-image').attr('src'),imgname='';
                //截取图片名字
                imgname=imgsrc.substr(imgsrc.lastIndexOf("/")+1);
                //赋值图片名字到隐藏input
                 $("input[name='img']").val(imgname);
                console.log(imgsrc,imgname,1123);
                // 更换上传提示文本为重新上传
                $('.upload-text').removeClass('on');
                $('.re-upload-text').addClass('on');
            },
            error: function(){}             
        });
    })
    $('input[name=image]').on('change', function () {
        // 如果确认已经选择了一张图片, 则进行上传操作
        if ($.trim($(this).val())) {
            $("#uploadForm").trigger('submit');
            
        }
    })
    // 触发文件选择窗口
     $('.js-reset-image span').on('click', function () {
      $('input[name=image]').trigger('click');
    })

});
function chang(){
  var r=new FileReader();
  f=document.getElementById('file').files[0];
  r.readAsDataURL(f);
  r.onload=function(e){
    document.getElementById('show').src=this.result;
  };
}
</script>
</body>
</html>