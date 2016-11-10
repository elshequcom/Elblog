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
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/quotes')}}" target="main">文章管理</a> &raquo; 编辑文章
    </div>
	<div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/quotes/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('admin/quotes')}}"><i class="fa fa-recycle"></i>文章列表</a>
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
        <form action="{{url('admin/quotes/'.$field->id)}}" method="post">
            <input type="hidden" name="_method" value="put">
			{{csrf_field()}}
            <table class="add_tab">
                <tbody>
					<tr>
                        <th><i class="require">*</i>语录中文：</th>
                        <td>
                            <textarea name="cn_title" class="lg" placeholder="可写83个字汉字">{{$field->cn_title}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>语录英文：</th>
                        <td>
                            <textarea name="en_title" class="lg" placeholder="可写83个字汉字">{{$field->en_title}}</textarea>
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