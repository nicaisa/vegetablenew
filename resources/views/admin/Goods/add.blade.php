<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加轮播图</title>
<!-- 导入富文本编辑器 -->
<!-- 导入富文本编辑器 -->
 @include('UEditor::head')
</head>
<link rel="stylesheet" href="{{asset('style/admin/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('style/home/layui/css/layui.css')}}">
<script src="{{asset('style/admin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('style/admin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('style/home/layui/layui.js')}}"></script>
<style type="text/css">
span{ color:#F00;}
.bar {
    height: 18px;
    background: green;
}
.aui-btn-default{
  background: none !important; 
  border: 0px solid #EAEAEA !important; 
  box-shadow: 0 0px 0px 0 #EFF1FA !important; 
}
.aui-content{
  margin-bottom: 50px;
}
.layui-upload-img {
  width: 92px;
  height: 92px;
  margin: 0 10px 10px 0;
}
</style>
<!--上传图片样式-->

<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
        ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.    
    });
</script>
<body class="" >
<div class="site-holder">
  <div class="box-holder">
    <div class="content">
      <div class="panel panel-cascade">
        <div class="panel-heading">
          <h3 class="panel-title">
            添加商品图片
          </h3>
        </div>
        <div class="panel-body ">
          <div class="ro">
            <div class="col-mol-md-offset-2">
                <div class="layui-upload form-group">
                  <label class="col-lg-2 col-md-3 control-label">
                    <button type="button" class="layui-btn " id="test2" style="float:right;margin: 20px auto;">多图片上传</button>
                  </label>
                  <div class="col-lg-10 col-md-9">
                    <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                      预览图：
                      @if(empty($data))
                        @else
                        <?PHP $imgs = explode(',',$data->img); ?>
                      @foreach($imgs as $v)
                        <img src="{{asset('/uploads/goods/'.$v)}}" class='img img-thumbnail' width="100px" style="">
                      @endforeach
                      @endif
                      <div class="layui-upload-list" id="demo2"></div>
                    </blockquote>
                  </div>
                </div>
                @if(empty($data))
                    <form class="form-horizontal cascade-forms" action="{{route('addgoods')}}" method="post"  name="signup_form">
                @else
                    <form class="form-horizontal cascade-forms" action="{{route('upgoods')}}" method="post"  name="signup_form">
                @endif
                   <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                   <input type="hidden" name="img" value="">
                        @if(empty($data))
                        @else
                            <input type="hidden" name="id" value="{{$data->id}}">
                        @endif
            <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品所属类型：</label>
                <div class="col-lg-10 col-md-9">
                  <select name="type_id" class="form-control form-cascade-control input-small">
                          @if(empty($data))
                                  @foreach($type as $p)
                                    <option value="{{$p->id}}" selected="selected">{{$p->name}}</option>
                                  @endforeach
                          @else
                                @foreach($types as $t)
                                    @if($t->id==$data->type_id)
                                      <option value="{{$t->id}}" selected="selected">{{$t->name}}</option>
                                    @else
                                      <option value="{{$t->id}}">{{$t->name}}</option>
                                    @endif
                               @endforeach
                          @endif
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品名称：</label>
                <div class="col-lg-10 col-md-9">
                  @if(empty($data))
                    <input type="text"  name="name"  required placeholder="请在这里输入商品名称" class="form-control form-cascade-control input-small"/>
                    <span name="pd_mima">&nbsp;</span><b>&nbsp;</b>
                  @else
                    <input type="text"  value="{{$data->name}}" name="name"  required placeholder="请在这里输入商品名称" class="form-control form-cascade-control input-small"/>
                    <span name="pd_mima">&nbsp;</span><b>&nbsp;</b>
                  @endif

                </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品价格：</label>
                <div class="col-lg-10 col-md-9">
                  @if(empty($data))
                    <input type="text"  name="price" required placeholder="请在这里输入商品价格" class="form-control form-cascade-control input-small"/>
                    <span name="pd_permission">&nbsp;</span><b>&nbsp;</b>
                  @else
                    <input type="text"   value="{{$data->price}}" name="price" required placeholder="请在这里输入商品价格" class="form-control form-cascade-control input-small"/>
                    <span name="pd_permission">&nbsp;</span><b>&nbsp;</b>
                  @endif
                </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品库存量：</label>
                <div class="col-lg-10 col-md-9">
                  @if(empty($data))
                    <input type="text"  name="stock"  required placeholder="请在这里输入商品库存量" class="form-control form-cascade-control input-small"/>
                    <span name="pd_permission">&nbsp;</span><b>&nbsp;</b>
                  @else
                    <input type="text"  name="stock"  value="{{$data->stock}}" required placeholder="请在这里输入商品库存量" class="form-control form-cascade-control input-small"/>
                    <span name="pd_permission">&nbsp;</span><b>&nbsp;</b>
                  @endif
                </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品规格：</label>
                <div class="col-lg-10 col-md-9">
                 <select name="rule" class="form-control form-cascade-control input-small">
                      @if(empty($data))
                                  @foreach($size as $size)
                                          <option value="{{$size->id}}" selected="selected">{{$size->name}}</option>
                                 @endforeach

                      @else      @foreach($sizes as $size)
                                     @if($size->id==$data->rule)
                                         <option value="{{$size->id}}" selected="selected">{{$size->name}}</option>
                                     @else
                                         <option value="{{$size->id}}">{{$size->name}}</option>
                                     @endif
                                @endforeach
                      @endif
                 </select>
                </div>
            </div>
            <div class="form-group">
               <div>
                  <label class="col-lg-2 col-md-3 control-label">状态：</label>
                  <div class="col-lg-10 col-md-9">
                      @if(empty($data))
                          <input type="radio" name="status" value="0">下架
                          <input type="radio" name="status" value="1" checked="checked">上架
                      @else
                          @if($data->status==1)
                              <input type="radio" name="status" value="0">下架
                              <input type="radio" name="status" value="1" checked="checked">上架
                          @else
                              <input type="radio" name="status" value="0" checked="checked">下架
                              <input type="radio" name="status" value="1">上架
                          @endif
                      @endif
                  </div>
              </div>
            </div> 
            <div class="form-group">
              <label class="col-lg-2 col-md-3 control-label">商品描述：</label>
              <div class="col-lg-10 col-md-9">
                @if(empty($data->describe))
                <textarea id="container" name="describe" type="text/plain"  style="height:150px; height:200px;"></textarea>
                @else
                  <textarea id="container" name="describe" type="text/plain"  style="height:150px; height:200px;">{{$data->describe}}</textarea>
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

<script >
    /*-------------多图上传-------------*/
    var arrimg=[];
    layui.use('upload', function(){
        var $ = layui.jquery
            ,upload = layui.upload;
        //多图片上传
        upload.render({
            elem: '#test2'
            ,url: "{{route('goodsimg')}}"
            ,data:{
                _token:"{{ csrf_token()}}",
                _method:"post"
            }
            ,multiple: true
            ,auto:true//自动上传
            ,allDone: function(obj){ //当文件全部被提交后，才触发
                //console.log(obj.total); //得到总文件数
               // console.log(obj.successful); //请求成功的文件数
                //console.log(obj.aborted); //请求失败的文件数
            }
            ,choose: function(obj){
                //将每次选择的文件追加到文件队列
                var files = obj.pushFile();

                //预读本地文件，如果是多文件，则会遍历。(不支持ie8/9)
                obj.preview(function(index, file, result){//重新上传
                    //console.log(index); //得到文件索引
                    //console.log(file); //得到文件对象
                    //console.log(result); //得到文件base64编码，比如图片
                    //这里还可以做一些 append 文件列表 DOM 的操作
                    //obj.upload(index, file); //对上传失败的单个文件重新上传，一般在某个事件中使用
                    //delete files[index]; //删除列表中对应的文件，一般在某个事件中使用
                });
            }
            ,before: function(obj){//obj参数包含的信息，跟 choose回调完全一致，可参见上文
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" data-img="'+ file.name +'" class="layui-upload-img">')
                });
            }
            ,done: function(res){
                //status=1代表上传成功,获取上传图片的名字
                if(res.status ==  1){
                    var url=res.url;
                    url=url.substr(url.indexOf('goods-'));
                    arrimg.push(url);
                    $('input[name="img"]').val(arrimg);
                }
                //文件保存失败
                layer.closeAll('loading'); //关闭loading
                //上传完毕
            }
            ,error: function(index, upload){//上传请求失败的回调
                layer.closeAll('loading'); //关闭loading
            }
        });
    });
    //点击“保存”按钮
  $('#tijiao').on('click',function () {
      var imgName=$('input[name="img"]').val();//获取上传图片的名字

  })
</script>

</body>
</html>