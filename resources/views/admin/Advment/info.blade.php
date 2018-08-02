<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查看用户</title>
	<link rel="stylesheet" href="__PUBLIC__/admin/css/bootstrap.min.css">
	<script src="__PUBLIC__/admin/js/jquery-1.11.1.min.js"></script>
	<script src="__PUBLIC__/admin/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row"><h3 class='text-primary'>个人信息 <button onclick="history.go(-1)" class='btn btn-sm btn-warning'>返回</button></h3></div>
		<div class="row" style='margin-right: 10px;'>
		<h4 class='text-info'>详细资料</h4>
			<table class='table table-hover table-striped'>
				<tr>
					<th width='200px'>历史头像</th>
					<td>
					<volist name='head_img' id='img'>
						<img src="__PUBLIC__/head_img/{$img.img}"  width='50px' height='50px'> 
					</volist>
					</td>
				</tr>
				<volist name='info' id='i'>
				<tr>
					<th>真实姓名</th>
					<td>{$i.name}</td>
				</tr>

				<tr>
					<th>性别</th>
					<td><?php if($i['sex']==1){echo "男";}else{echo "女";} ?></td>
				</tr>

				<tr>
					<th>体重</th>
					<td>{$i.weight} KG</td>
				</tr>

				<tr>
					<th>身高</th>
					<td>{$i.height} CM</td>
				</tr>

				<tr>
					<th>月收入</th>
					<td>{$i.income} 元</td>
				</tr>

				<tr>
					<th>星座</th>
					<td>{$i.constellation_name}</td>
				</tr>

				<tr>
					<th>血型</th>
					<td><?php 
						switch ($i['blood_type']) {
							case '1':
								echo "A型血";
								break;
							case '2':
								echo "B型血";
								break;
							case '3':
								echo "AB型血";
								break;
							case '4':
								echo "O型血";
								break;
							default:
								echo "未知";
								break;
						}
					 ?></td>
				</tr>

				<tr>
					<th>民族</th>
					<td>{$i.nation_name}</td>
				</tr>

				<tr>
					<th>学历</th>
					<td>{$i.education_name}</td>
				</tr>

				<tr>
					<th>学校</th>
					<td>{$i.school}</td>
				</tr>
				</volist>
			</table>
		</div>

		<div class="row" >
			<h4 class='text-info'>择偶标准</h4>
			<table class='table table-hover table-striped'>
				<volist name='mate_selection' id='s'>
				<tr>
					<th>婚姻状况</th>
					<td>
						<?php 
							switch ($s['marital_status']) {
								case '1':
									echo "不限";
									break;
								case '2':
									echo "未婚";
									break;
								case '3':
									echo "离异";
									break;
								case '4':
									echo "丧偶";
									break;
							}
						 ?>
					</td>
				</tr>

				<tr>
					<th>工作地点</th>
					<td>{$s.native_place_name}</td>
				</tr>

				<tr>
					<th>性别</th>
					<td><?php echo $s['sex']==1? "男":"女"; ?></td>
				</tr>

				<tr>
					<th>爱好</th>
					<td>{$hobby}</td>
				</tr>

				<tr>
					<th>身高</th>
					<td>{$s.height} </td>
				</tr>
<!-- 
				<tr>
					<th>体重</th>
					<td>{$s.weight} KG</td>
				</tr> -->

				<tr>
					<th>血型</th>
					<td><?php 
						switch ($s['blood_type']) {
							case '1':
								echo "不限";
								break;
							case '2':
								echo "A型血";
								break;
							case '3':
								echo "B型血";
								break;
							case '4':
								echo "AB型血";
								break;
							case '5':
								echo "O型血";
								break;
							default:
								echo "不限";
								break;
						}
					 ?></td>
				</tr>

				<tr>
					<th>收入</th>
					<td>月收入{$s.income}</td>
				</tr>

			<!-- 	<tr>
					<th>星座</th>
					<td>{$s.constellation_name}</td>
				</tr> -->

				<tr>
					<th>学历</th>
					<td>{$s.education_name}</td>
				</tr>

				<tr>
					<th>籍贯</th>
					<td>{$s.native_place_name}</td>
				</tr>
				</volist>
			</table>
		</div>
		<div class="row" >
			<h4 class='text-info'>身份信息</h4>
			<table class='table table-hover table-striped'>
				<volist name='identity' id='id'>
				<tr>
					<th>真实姓名</th>
					<td>{$info.0.name}</td>
				</tr>
				<tr>
					<th>真实姓名</th>
					<td><img src="__PUBLIC__/id_img/{$id.id_img_1}" width='300px' alt=""></td>
				</tr>
				<tr>
					<th>真实姓名</th>
					<td><img src="__PUBLIC__/id_img/{$id.id_img_2}"  width='300px' alt=""></td>
				</tr>
				</volist>
			</table>
		</div>
	</div>
</body>
</html>