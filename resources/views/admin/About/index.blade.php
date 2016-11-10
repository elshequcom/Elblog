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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/about')}}" target="main">关于我管理</a> &raquo; 关于我详情
</div>

<div class="result_wrap">
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/about/1/edit')}}"><i class="fa fa-plus"></i>修改关于我</a>
        </div>
    </div>
</div>

<div class="result_wrap">
    <div class="result_content">
        <ul style="width: 80%;margin: 0 auto">
            @foreach($data as $v)
                <li>
                    <img alt="无图片"  style="max-width: 350px; max-height:100px;" src="{{url('/')}}{{$v->pic}}">
                </li>
            <li>
                中文名：{{$v->cn_name}}
            </li>
            <li>
                英文名：{{$v->en_name}}
            </li>
            <li>
                我的爱好：{{$v->hobby}}
            </li>
            <li>
                QQ：{{$v->qq}}
            </li>
            <li>
                微信：{{$v->weixin}}
            </li>
            <li>
                微博：{{$v->weibo}}
            </li>
            <li>
                推特：{{$v->twitter}}
            </li>
            <li>
                新浪：{{$v->sina}}
            </li>
            <li>
                搜狐：{{$v->souhu}}
            </li>
            <li>
                GitHub：{{$v->github}}
            </li>
            @endforeach
        </ul>
    </div>
</div>

<style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
</style>

{{--<script>
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
</script>--}}

@stop
{{--内容区域结束--}}

{{--footer区域--}}
@section('footer')

@stop
{{--footer区域结束--}}
