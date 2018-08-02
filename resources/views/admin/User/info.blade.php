<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查看用户</title>
	<style>
	 td{
	 	
	 	border: 0px;
	 }
	 .table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th {
     	    background: none !important;
 	}
	.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
	    padding: 8px;
	    line-height: 1.42857143;
	    vertical-align: top;
	    border-top: 0px solid #ddd !important; 
	}
	img{
		width: 100px;
		height: 100px;
		border-radius: 50%;
		display: block;
		vertical-align: middle;
		margin-left: 92%;
		margin-bottom: 20px;
	}
	td{display: inline-block;width: 50%;margin:10px auto;line-height: 30px;float: left;}
	tr>td:nth-child(even){text-align: left; color: green;}
	tr>td:nth-child(odd){text-align: right; color:plum;}
	var{font-style: normal;}
	.nicheng{
		width: 100%
	}
	.nicheng>span,.nicheng>var{display: block;margin-right: 10px;float:left;}
	.table{margin-top:-100px;}
    </style>
	<link rel="stylesheet" href="{{asset('style/admin/css/bootstrap.min.css')}}">
	<script src="{{asset('style/admin/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
</head>
<body>
	<div class="container">
		<div class="row"><h3 class='text-primary'>个人信息 <a  href="{{route('user')}}" class='btn btn-sm btn-warning'>返回</a></h3></a>
		<div class="row">
		<h4 class='text-info'>详细资料</h4>
			<table class='table table-hover table-striped'>
				<!-- SELECT `id`, `user_id`, `name`, `sex`, `address`, `nickname`, `creat_time`, `integral` FROM `user_info` WHERE 1 -->
				<tr>
					<td  colspan="2">
						<img src="{{asset('/uploads/user/'.$user->headimg)}}" >
						<var style="dispaly:block;text-align: center;margin-right:-20px">{{$userinfo->nickname}}</var>
						<!-- <div class="nicheng"><span>昵称</span><var>阿诗丹顿发·</var></div> -->
						<!-- SELECT `id`, `status`, `username`, `password`, `phone`, `headimg` FROM `user` WHERE 1 -->
					</td>
				</tr>
				<tr>
					<td>真实姓名</td>	
					<td >{{$user->username}}</td>
				</tr>
				<tr>
					<td>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</td>	
					@if($userinfo->sex==1)
						<td><span class="btn btn-success btn-xs">女</span></td>
						@else
						<td><span class="btn btn-danger btn-xs">男</span></td>
						@endif		
				</tr>
				<tr>
					<td>注册时间</td>
					<td>{{date('Y:m:d,H:i:s'),$userinfo->creat_time}}</td>
				</tr>
				<tr>
					<td>收货地址</td>
					<td>{{$userinfo->address}}</td>
				</tr>
				<tr>
					<td>积&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分</td>
					<td>{{$userinfo->integral}}</td>
				</tr>
				<tr>
					<td>电话号码</td>
					<td>{{$user->phone}}</td>
				</tr>
				<tr>
					<td>用户状态</td>
					@if($user->status==1)
						<td><span class="btn btn-success btn-xs">正常</span></td>
						@else
						<td><span class="btn btn-danger btn-xs">禁用</span></td>
						@endif
				</tr>
			</table>
		</div>
	</div>
</body>
</html>