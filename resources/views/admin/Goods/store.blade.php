<!doctype html>
<html>
<head>
<style type="text/css">
span{ color:#F00;}
</style>
<meta charset="utf-8">
<title>添加商品</title>
<!-- 导入富文本编辑器 -->
<include file="Common/link" />   
<include file="Common/father"/><!--富文本编辑器 -->
</head>
<script type="text/javascript" src="{{asset('/admin/js/jquery.js')}}"></script>
<body >    
<div class="site-holder">
            <div class="box-holder">
            <div class="content">
		<div class="panel panel-cascade">
			<div class="panel-heading">
				<h3 class="panel-title" >
					商品添加
				</h3>
			</div>
			<div class="panel-body ">
				<div class="ro">
					<div class="col-mol-md-offset-2">
					<form class="form-horizontal cascade-forms" enctype="multipart/form-data" action="" method="post"  name="signup_form" id="signup_form" novalidate enctype="multipart/form-data">
                    	<div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品名称：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_name" value="" required placeholder="请在这里输入商品名称(不能超购15个文字)" class="form-control form-cascade-control input-small"/>
                                <span name="pd_mingcheng">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品英文：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_ename" value="" required placeholder="请在这里输入商品英文名称(不能超过50个字母)" class="form-control form-cascade-control input-small"/>
                                <span name="pd_emingcheng">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品系列：</label>
							<div class="col-lg-10 col-md-9">
								<select  name="series_id"   class="form-control form-cascade-control input-small">
                                <foreach name="series" item="xl">
                                <option value="{$xl.id}">{$xl.series_name}</option>
                                </foreach>
                                </select>
                                <span>&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品封面图片：</label>
							<div class="col-lg-10 col-md-9">
							<input type="file" name="goods_image"/>
                                <span>&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品价格：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_price" value=""  required  placeholder="请在这里输入商品价格(单位：元)"  onKeyUp="value=value.replace(/[^\d]/g,'')" class="form-control form-cascade-control input-small"/>
                                 <span name="pd_jiage">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">容量：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_capacity" value=""   required  placeholder="请在这里输入容量(单位：mL)" onKeyUp="value=value.replace(/[^\d]/g,'')"  class="form-control form-cascade-control input-small"/>
                                 <span name="pd_rongliang">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                       <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品产地：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_producing " value="" required placeholder="请在这里输入商品产地(不能超购15个文字)" class="form-control form-cascade-control input-small"/>
                                <span name="pd_mingcheng">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品等级：</label>
							<div class="col-lg-10 col-md-9">
								<select  name="goods_variety"  class="form-control form-cascade-control input-small">
                                <option value="优等">优等</option>
                                <option value="上等">上等</option>
                                <option value="特等">特等</option>
                                <option value="上上等">上上等</option>
                                </select>
                                 <span name="pd_zhongbie">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">状态：</label>
							<div class="col-lg-10 col-md-9">
								<select type="text"  name="goods_status" class="form-control form-cascade-control input-small">
                                <option value="1">上架</option>
                                <option value="0">下架</option>
                                </select>
                                <span>&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">适饮温度：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_pleasant" value=""  required  placeholder="请在这里输入放置温度(单位：℃)" class="form-control form-cascade-control input-small"/>
                                 <span name="pd_wendu">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                       
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">年份：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_year" value=""  required   placeholder="请在这里输入该商品的年份(单位：年)  如：1982年   输入：1982" onKeyUp="value=value.replace(/[^\d]/g,'')" class="form-control form-cascade-control input-small"/>
                                 <span name="pd_nianfen">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">库存：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="goods_inventory" value=""  required  placeholder="请在这里输入该商品的库存量(单位：件数)" onKeyUp="value=value.replace(/[^\d]/g,'')" class="form-control form-cascade-control input-small"/>
                                 <span name="pd_kucun">&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">是否推荐：</label>
							<div class="col-lg-10 col-md-9">
								<select  name="goods_recommend" class="form-control form-cascade-control input-small">
                                <option value="1">推荐</option>
                                <option value="0">不推荐</option>
                                </select>
                                <span>&nbsp;</span><b>&nbsp;</b>
							</div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">备注：</label>
							<div class="col-lg-10 col-md-9">
								<input type="text"  name="remark" value="" placeholder="请在这里输入商品的备注，没有备注可以不输入" class="form-control form-cascade-control input-small"/>
								<span>&nbsp;</span><b>&nbsp;</b>
                            </div>
						</div>
                        
                        <div class="form-group">
							<label class="col-lg-2 col-md-3 control-label">商品描述：</label>
							<div class="col-lg-10 col-md-9">
								<textarea id="container" name="goods_describe"  style="height:150px; height:200px;"></textarea>
							</div>
						</div>
                        
		 				<div class="panel-footer">
  							<div class="row">
   								<div class="form-actions" align="center">
									<input type="submit" value="确定"  disabled="disabled" class="btn bg-primary text-white btn-lg">
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
