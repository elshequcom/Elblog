{{--引入模板--}}
@extends('layout.adminlayout')

{{--header区域--}}
@section('header')
    @parent
@stop
{{--header区域结束--}}

{{--menu区域--}}
@section('menu')
    <div class="menu_box">
        <ul>
            <li>
                <h3><i class="fa fa-fw fa-clipboard"></i>文章管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/articlecat/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加分类</a></li>
                    <li><a href="{{url('admin/articlecat')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>分类列表</a></li>
					<li><a href="{{url('admin/article/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加文章</a></li>
                    <li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>文章列表</a></li>
                </ul>
            </li>
            <li>
                <h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>
                <ul class="sub_menu">
					<li><a href="{{url('admin/links')}}" target="main"><i class="fa fa-fw fa-cubes"></i>友情链接</a></li>
					<li><a href="{{url('admin/navs')}}" target="main"><i class="fa fa-fw fa-navicon"></i>底部自定义导航</a></li>
					<li><a href="{{url('admin/config')}}" target="main"><i class="fa fa-fw fa-cogs"></i>网站配置</a></li>
                    <li><a href="{{url('admin/about')}}" target="main"><i class="fa fa-fw fa-user"></i>关于我</a></li>
                    <li><a href="{{url('admin/quotes')}}" target="main"><i class="fa fa-fw fa-book"></i>人生格言</a></li>
                </ul>
            </li>
        </ul>
    </div>
@stop
{{--menu区域结束--}}

{{--内容区域--}}
@section('container')
	<div class="main_box">
		<iframe src="{{ url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe> 
	</div>
@stop
{{--内容区域结束--}}


{{--footer区域--}}
@section('footer')
    @parent
@stop
{{--footer区域结束--}}