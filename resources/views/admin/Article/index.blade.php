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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/article')}}" target="main">文章管理</a> &raquo; 文章列表
</div>

<div class="result_wrap">
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
        </div>
    </div>
</div>

<div class="result_wrap">
    <div class="result_content">
        <table class="list_tab">
            <tr>
                <th class="tc">ID</th>
                <th>标题</th>
                <th>缩略图</th>
                <th>点击</th>
                <th>作者</th>
				<th>是否显示</th>
                <th>发布时间</th>
                <th>操作</th>
            </tr>
            @foreach($data as $v)
            <tr>
                <td class="tc">{{$v->id}}</td>
                <td><a href="#">{{$v->title}}</a></td>
                <td>
                    <a href="#">
                        <img src="{{url('/').$v->thumbnail}}" style="height: 50px;width: 100px;" alt="{{$v->title}}"/>
                    </a>
                </td>
                <td>{{$v->hitcount}}</td>
                <td>{{$v->author}}</td>
				<td>{{$v->is_show ? "显示" : "不显示"}}</td>
                <td>{{$v->created_at}}</td>
                <td>
                    <a href="{{url('admin/article/'.$v->id.'/edit')}}">修改</a>
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
            $.post("{{url('admin/article/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
