{{--引入模板--}}
@extends('layout.adminlayout')
{{--header区域--}}
@section('header')

@stop
{{--header区域结束--}}

{{--menu区域--}}
@section('menu')
@stop
{{--menu区域结束--}}

{{--内容区域--}}
@section('container')
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="{{url('admin/info')}}" target="main">后台管理</a> &raquo; 后台首页
    </div>

    <div class="result_wrap">
        <div class="result_title">
            <h3>基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
					<label>操作系统</label><span>{{PHP_OS}}</span>
				</li>
				<li>
					<label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
				</li>
				<li>
					<label>版本</label><span>v-1.0</span>
				</li>
				<li>
					<label>上传附件限制</label><span><?php echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></span>
				</li>
				<li>
					<label>北京时间</label><span><?php echo date('Y年m月d日 H时i分s秒')?></span>
				</li>
				<li>
					<label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} [ {{$_SERVER['SERVER_ADDR']}} ]</span>
				</li>
				<li>
					<label>Host</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
				</li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>联系我们</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>官方网站：</label><span><a href="http://www.elshequ.com" target="_blank">http://www.elshequ.com</a></span>
                </li>
                <li>
                    <label>官方邮箱：</label><span><a href="#">elshequ@163.com</a></span>
                </li>
            </ul>
        </div>
    </div>
@stop
{{--内容区域结束--}}

{{--footer区域--}}
@section('footer')

@stop
{{--footer区域结束--}}