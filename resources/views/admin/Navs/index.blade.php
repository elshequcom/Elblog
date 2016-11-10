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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/navs')}}">自定义导航管理</a> &raquo; 导航列表
</div>

<div class="result_wrap">
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加导航</a>
        </div>
    </div>
</div>

<div class="result_wrap">
    <div class="result_content">
        <table class="list_tab">
            <tr>
                <th class="tc" width="5%">排序</th>
                <th class="tc" width="5%">ID</th>
                <th>导航名称</th>
                <th>URL地址</th>
                <th>导航别名</th>
                <th>操作</th>
            </tr>

            @foreach($data as $v)
            <tr>
                <td class="tc">
                    <input type="text" onchange="changeOrder(this,{{$v->id}})" value="{{$v->orders}}">
                </td>
                <td class="tc">{{$v->id}}</td>
                <td><a href="#">{{$v->name}}</a></td>
                <td>{{$v->url}}</td>
                <td>{{$v->descs}}</td>
                <td>
                    <a href="{{url('admin/navs/'.$v->id.'/edit')}}">修改</a>
                    <a href="javascript:;" onclick="delLinks({{$v->id}})">删除</a>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>



<script>
    function changeOrder(obj,id){
        var orders = $(obj).val();
        $.post("{{url('admin/navs/changeorder')}}",{'_token':'{{csrf_token()}}','id':id,'orders':orders},function(data){
            if(data.status == 0){
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    }

    //删除导航
    function delLinks(id) {
        layer.confirm('您确定要删除这个导航吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/navs/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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