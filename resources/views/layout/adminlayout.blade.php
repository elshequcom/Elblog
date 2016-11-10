<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ asset('public/admin/css/admin.css') }}">
	<link rel="stylesheet" href="{{ asset('public/admin/font/css/font-awesome.min.css') }}">
	<script type="text/javascript" src="{{ asset('public/admin/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/admin/js/admin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/libraries/layer/layer.js') }}"></script>
	</head>
<body>

	{{--header start--}}
	@section('header')
	<div class="top_box">
		<div class="top_left">
			<div class="logo">蝶梦后台管理中心</div>
			<ul>
				<li><a href="{{url('admin/index')}}" class="active">管理首页</a></li>
				<li><a href="{{url('/')}}" target="_blank">博客首页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：{{ session('a_email') }}</li>
				<li><a href="{{url('admin/pass')}}" target="main">修改密码</a></li>
				<li><a href="{{url('admin/quit')}}">退出</a></li>
			</ul>
		</div>
	</div>
	@show
	{{--header end--}}
	
	{{--menu start--}}
	@section('menu')

	@show
	{{--menu end--}}

	
	{{--container start--}}
	@section('container')

	@show
	{{--container end--}}


	{{--footer start--}}
	@section('footer')
	<div class="bottom_box">
		CopyRight © 2016. Powered By <a href="http://www.elshequ.com">蝶梦网</a>.
	</div>
	@show
	{{--footer end--}}
</body>
</html>

