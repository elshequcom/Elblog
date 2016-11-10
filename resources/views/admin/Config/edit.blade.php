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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/config')}}">配置管理</a> &raquo; 编辑配置
</div>

<div class="result_wrap">
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置</a>
            <a href="{{url('admin/config')}}"><i class="fa fa-fw fa-list-ul"></i>配置列表</a>
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
    <form action="{{url('admin/config/'.$field->id)}}" method="post">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>配置名称：</th>
                <td>
                    <input type="text" name="name" value="{{ $field->name }}" placeholder="配置名称必须填写">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>配置标题：</th>
                <td>
                    <input type="text" name="title" value="{{ $field->title }}" placeholder="配置标题必须填写">
                </td>
            </tr>
            <tr>
                <th>配置类型：</th>
                <td>
                    <label for=""><input type="radio" name="field_type" value="input" onclick="showTr()" style="width: 13px"  @if($field->field_type == 'input')  checked="checked" @endif >input</label>
                    <label for=""><input type="radio" name="field_type" value="textarea" onclick="showTr()" style="width: 13px" @if($field->field_type == 'textarea')  checked="checked" @endif >textarea</label>
                    <label for=""><input type="radio" name="field_type" value="radio" onclick="showTr()" style="width: 13px" @if($field->field_type == 'radio')  checked="checked" @endif >radio</label>
                </td>
            </tr>
            <tr class="field_value">
                <th>配置类型值：</th>
                <td>
                    <input type="text" class="lg" name="field_value" value="{{ $field->field_value }}">
					<p>类型值只有在radio的情况下才需要配置，格式: 1|开启,0|关闭</p>
                </td>
            </tr>
            <tr>
                <th>配置排序：</th>
                <td>
                    <input name="orders" min="0" max="100" type="number" value="{{ $field->orders }}">
                </td>
            </tr>
            <tr>
                <th>配置说明：</th>
                <td>
                    <textarea cols="30" rows="10" name="descs">{{ $field->descs }}</textarea>
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
<script>
    showTr();
    function showTr() {
        var type = $('input[name=field_type]:checked').val();
        if(type=='radio'){
            $('.field_value').show();
        }else{
            $('.field_value').hide();
        }
    }
</script>
@stop
{{--内容区域结束--}}

{{--footer区域--}}
@section('footer')

@stop
{{--footer区域结束--}}
