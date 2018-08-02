<meta charset="utf-8">
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<include file="Common/link"/>
<title>{$detail_goods.goods_name}[{$detail_goods.goods_ename}]商品详细信息</title>
</head>
<script type="text/javascript" src="/style/admin/js/jquery.js"></script>
<script type="text/javascript">
$(function(){
	$("#fanhui").click(function(){
		history.back();
		});
});
</script>
<body>
<table aria-describedby="example_info" role="grid" class="table table-bordered table-hover table-striped display dataTable" id="example">
<thead>

</thead>
  <tbody>
    <tr> <th width="120px">1.商品名称</th>
      <td>{$detail_goods.goods_name}</td>
    </tr>  
    
    <tr> <th width="120px">2.商品类型</th>
      <td>{$detail_goods.goods_type}</td>
    </tr>
    
    <tr> <th width="120px">3.商品系列</th>
      <td>
      <foreach name="series" item="xilie">
          <if condition="$xilie['id']==$detail_goods['series_id']">
          {$xilie.series_name}
          </if>
      </foreach>
      </td>
    </tr>
    
    <tr> <th width="120px">4.商品价格</th>
      <td>{$detail_goods.goods_price}元</td>
    </tr>
    
    <tr> <th width="120px">5.容量</th>
      <td>{$detail_goods.goods_capacity}mL</td>
    </tr>
    
    <tr> <th width="120px">6.图片</th>
      <td>
      <a href="{:U('ProductImages/show_product_images')}?id={$detail_goods.id}"><img src="/style/admin/images/jian.jpg" width="50" height="50"></a>&nbsp;
      <foreach name="goods_images" item="images">
      <if condition="$images['product_id']==$detail_goods['id']">
      <img width="80px" height="80px" src="/style/web/img/goods/{$images.image}">&nbsp;
      </if>
      </foreach>
      <a href="{:U('ProductImages/add_product_images')}?id={$detail_goods.id}"><img src="/style/admin/images/jia.jpg" width="60" height="60"></a>
      </td>
    </tr>
    
    <tr> <th width="120px">7.状态</th>
      <td>
      <if condition="$detail_goods.goods_status eq '1'">
      <b>上架</b>
      <else/>
      <b style=" color:#999">下架</b>
      </if>
      
      </td>
    </tr>
    
    <tr> <th width="120px">8.商品品种</th>
      <td>{$detail_goods.goods_variety}</td>
    </tr>
    
    <tr> <th width="120px">9.储存温度</th>
      <td>{$detail_goods.goods_pleasant}℃</td>
    </tr>
    
    <tr> <th width="120px">10.年份</th>
      <td>{$detail_goods.goods_year}年</td>
    </tr>
    
    <tr> <th width="120px">11.库存</th>
      <td>{$detail_goods.goods_inventory}件</td>
    </tr>
    
    <tr> <th width="120px">12.是否推荐</th>
      <td>
      <if condition="$detail_goods.goods_recommend eq '1'">
      <b>推存</b>
      <else/>
      <b>不推存</b>
      </if>
      </td>
    </tr>
    
    <tr> <th width="120px">13.浏览量</th>
      <td>
      <if condition="$detail_goods.goods_view eq ''">
      0
      </if>
      {$detail_goods.goods_view}
      
      次</td>
    </tr>
    
    <tr> <th width="120px">14.添加时间</th>
      <td>{$detail_goods.goods_time}</td>
    </tr>
    
    <tr> <th width="120px">15.备注</th>
      <td>{$detail_goods.remark}</td>
    </tr>
    
    <tr> <th width="120px">16.产地</th>
      <td>{$detail_goods.goods_producing}</td>
    </tr>
    
    <tr> <th width="120px">17.商品描述</th>
      <td>{$detail_goods.goods_describe}</td>
    </tr>
     <tr> 
     <td colspan="2" align="center"> 
   
     <span class="btn btn-success" id="fanhui" >返回</span>
     <a href="{:U('ProductImages/add_product_images')}?id={$detail_goods.id}" class="btn btn-success btn-animate-demo">添加图片</a>
     <a href="{:U('Goods/update_goods_inventory')}?id={$detail_goods.id}" class="btn btn-primary btn-animate-demo">更改库存</a>
     <a href="{:U('Goods/upd_goods')}?id={$detail_goods.id}" class="btn btn-warning btn-animate-demo">修改信息</a>
     <if condition="$detail_goods.goods_status eq '1'">
    <a  href="{:U('Goods/xiajia_goods')}?id={$detail_goods.id}" onClick="return confirm('该商品库存{$detail_goods.goods_inventory}，是否确定商品下架');" class="btn btn-danger btn-animate-demo"> 下架</a>
    <else/>
    <a  href="{:U('Goods/shangjia_goods')}?id={$detail_goods.id}" onClick="return confirm('该商品库存{$detail_goods.goods_inventory}，是否确定商品上架');" class="btn btn-danger btn-animate-demo">上架</a>
    </if>
     </td>
    </tr> 
 </tbody>
</table>
</body>
</html>
