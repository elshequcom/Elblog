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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/quotes')}}" target="main">语录管理</a> &raquo; 语录列表
</div>

<div class="result_wrap">
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/quotes/create')}}"><i class="fa fa-plus"></i>添加语录</a>
        </div>
    </div>
</div>

<div class="result_wrap">
    <div class="result_content">
        <table class="list_tab">
            <tr>
                <th class="tc">ID</th>
                <th>中文</th>
                <th>英文</th>
                <th>发布时间</th>
				<th>修改时间</th>
                <th>操作</th>
            </tr>
            @foreach($data as $v)
            <tr>
                <td class="tc">{{$v->id}}</td>
                <td>{{$v->cn_title}}</td>
                <td>{{$v->en_title}}</td>
                <td>{{$v->created_at}}</td>
                <td>{{$v->updated_at}}</td>
                <td>
                    <a href="{{url('admin/quotes/'.$v->id.'/edit')}}">修改</a>
                    <a href="javascript:;" onclick="delArt({{$v->id}})">删除</a>
                </td>
            </tr>
            @endforeach
        </table>

        <div class="page_list">
            {{$data->links()}}
        </div>
    </div>
</div>

<style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
</style>

<script>
    //删除分类
    function delArt(id) {
        layer.confirm('您确定要删除这篇文章吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/quotes/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
