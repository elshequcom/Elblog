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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/links')}}">友情链接管理</a> &raquo; 添加友情链接
</div>

<div class="result_wrap">
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/links')}}"><i class="fa fa-fw fa-list-ul"></i>链接列表</a>
        </div>
    </div>
    <div class="result_title">
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
</div>

<div class="result_wrap">
    <form action="{{url('admin/links')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>链接名称：</th>
                <td>
                    <input type="text" name="name" placeholder="链接名称必须填写">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>链接Url：</th>
                <td>
                    <input type="text" class="lg" name="url" value="http://">
                </td>
            </tr>
            <tr>
                <th>链接备注说明：</th>
                <td>
					<textarea name="descs" class="lg" placeholder="可写200个字符"></textarea>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
					<input name="orders" min="0" max="100" type="number" value="0">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
@stop
{{--内容区域结束--}}

{{--footer区域--}}
@section('footer')

@stop
{{--footer区域结束--}}