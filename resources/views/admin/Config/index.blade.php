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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/config')}}">配置管理</a> &raquo; 配置列表
</div>

    <div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置</a>
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
        <div class="result_content">
			<form action="{{url('admin/config/changecontent')}}" method="post">
            {{csrf_field()}}
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>名称</th>
                    <th>标题</th>
					<th>内容</th>
                    <th>操作</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$v->id}})" value="{{$v->orders}}">
                    </td>
                    <td class="tc">{{$v->id}}</td>
                    <td><a href="#" title="{{$v->descs}}">{{$v->name}}</a></td>
					<td>{{$v->title}}</td>
					<td>
						<input type="hidden" name="id[]" value="{{$v->id}}">
                        {!! $v->_html !!}
					</td>
                    <td>
                        <a href="{{url('admin/config/'.$v->id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="delLinks({{$v->id}})">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
			<div class="btn_group" style="margin: 0 auto;max-width: 406px;">
                <input type="submit" value="提交">
                <input type="button" class="back" onclick="history.go(-1)" value="返回" >
            </div>
            </form>
        </div>
    </div>


<script>
    function changeOrder(obj,id){
        var orders = $(obj).val();
        $.post("{{url('admin/config/changeorder')}}",{'_token':'{{csrf_token()}}','id':id,'orders':orders},function(data){
            if(data.status == 0){
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    //删除配置项
    function delLinks(id) {
        layer.confirm('您确定要删除这个配置项吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/config/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if(data.status==0){
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            });
//            layer.msg('的确很重要', {icon: 1});
        }, function(){

        });
    }



</script>

@stop
{{--内容区域结束--}}

{{--footer区域--}}
@section('footer')

@stop
{{--footer区域结束--}}
