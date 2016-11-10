<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ asset('public/admin/css/admin.css') }}">
	<link rel="stylesheet" href="{{ asset('public/admin/font/css/font-awesome.min.css') }}">
	<!--邮箱自动补全插件-->
	<script src="{{ asset('public/admin/js/jquery.js') }}"></script>
	<script src="{{ asset('public/admin/js/mailCompletion.js') }}"></script>
</head>
<body style="height: auto">
	<div class="login_box">
		<div class="form" style="margin-top: 50px">
			<img src="{{ asset('public/admin/img/logo.png') }}" class="logoimg" alt="蝶梦网">
			<form  method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="u_email" id="email" class="text" maxlength="18" placeholder="管理员邮箱"/>
						<span><i class="fa fa-envelope"></i></span>
					</li>
					<li>
						<input type="password" name="u_password" maxlength="22" class="text" placeholder="管理员密码"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" maxlength="4" name="code" placeholder="验证码"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('/admin/code')}}" alt="网络忙,无法显示，请稍后再试" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
						@if(session('msg'))
							<p class="msg">{{session('msg')}}</p>
						@endif
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p class="loginfooter"><a href="{{url('/')}}">返回首页</a> &copy; 2016 Powered by <a href="http://www.elshequ.com/" target="_blank">蝶梦网</a></p>
		</div>
	</div>
	<script type="text/javascript">
		var mail = new hcMailCompletion('email');
		mail.run();
	</script>
</body>
</html>