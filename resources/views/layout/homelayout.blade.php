<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  @yield('info')
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="icon" type="image/png" href="{{ asset('public/home/i/favicon.png') }}">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="{{ asset('public/home/i/app-icon72x72@2x.png') }}">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="{{ asset('public/home/i/app-icon72x72@2x.png') }}">
  <meta name="msapplication-TileImage" content="{{ asset('public/home/i/app-icon72x72@2x.png') }}">
  <meta name="msapplication-TileColor" content="#0e90d2">
  <link rel="stylesheet" href="{{ asset('public/home/css/amazeui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/home/css/app.css') }}">
</head>

<body id="blog">	
<header class="am-g am-g-fixed blog-fixed blog-text-center blog-header">
	<div class="am-u-sm-8 am-u-sm-centered">
		<img style="width: 200px;height: 200px"  class="am-img-thumbnail am-circle" src="{{url(Config::get('web.web_logo'))}}" alt="蝶梦网 www.elshequ.com"/>
		<h3 class="am-hide-sm-only">在自我中寻求一种平衡</h3>
	</div>
</header>
<hr>
<nav class="am-g am-g-fixed blog-fixed blog-nav">
	<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only blog-button" data-am-collapse="{target: '#blog-collapse'}" ><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
		<div class="am-collapse am-topbar-collapse" id="blog-collapse">
			<ul class="am-nav am-nav-pills am-topbar-nav">
                <li class="am-active"><a href="{{url('/')}}" title="蝶梦首页" target="_blank">首页</a></li>
                @foreach($catp as $cap)
                <li class="am-dropdown" data-am-dropdown>
                    <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                        {{  $cap['cat_name'] }} <span class="am-icon-caret-down"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        @foreach($catc as $cac)
                            @if($cap['id'] == $cac['parent_id'])
                                <li><a href="{{url('cat/'.$cac['id'])}}" target="_blank">{{$cac['cat_name']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endforeach
			</ul>
		</div>
	</nav>
<hr>

@yield('banner')



@yield('container')


<footer class="blog-footer">
    <div class="am-g am-g-fixed blog-fixed am-u-sm-centered blog-footer-padding" style="padding-top: 0px;">
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
            <ul class="links">
                @foreach($navs as $k=>$v)
                    <li><a href="{{$v->url}}" title="{{$v->descs}}" target="_blank">{{$v->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
            <ul class="links">
                <li>友情链接:</li>
            @foreach($links as $l)
                <li>
                    <a href="{{$l->url}}" target="_blank">{{ $l->name }}</a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>    
    <div class="blog-text-center">
        {!! Config::get('web.copyright')!!}{{Config::get('web.web_beian')}}
        <p>
            {!! Config::get('web.bai_widget') !!}
            {!! Config::get('web.51la_widget') !!}
            {!! Config::get('web.ym_widget') !!}
        </p>

    </div>
</footer>

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('public/home/js/jquery.min.js') }}"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="{{ asset('public/home/js/amazeui.ie8polyfill.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('public/home/js/amazeui.min.js') }}"></script>
</body>
</html>
