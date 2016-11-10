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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/articlecat')}}" target="main">文章分类管理</a> &raquo; 编辑分类
</div>

<div class="result_wrap">
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/articlecat/create')}}"><i class="fa fa-plus"></i>添加分类</a>
            <a href="{{url('admin/articlecat')}}"><i class="fa fa-fw fa-list-ul"></i>分类列表</a>
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
    <form action="{{url('admin/articlecat/'.$field->id.'')}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>父级分类：</th>
                <td>
                    <select name="parent_id">
                        <option value="0">==顶级分类==</option>
                        @foreach($data as $d)
                        <option value="{{$d->id}}"
                            @if($d->id==$field->parent_id)
								selected 
							@endif
                        >
						{{$d->cat_name}}
						</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>分类名称：</th>
                <td>
                    <input type="text" name="cat_name" value="{{$field->cat_name}}">
                    <span>分类名称必须填写</span>
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