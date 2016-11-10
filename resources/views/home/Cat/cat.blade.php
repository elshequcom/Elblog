{{--引入模板--}}
@extends('layout.homelayout')
@section('info')
    <title>{{$field->cat_name}} - {{Config::get('web.seo_title')}}</title>
    <meta name="keywords" content="{{Config::get('web.keywords')}}" />
    <meta name="description" content="{{Config::get('web.description')}}" />
@stop
{{--banner区域结束--}}


{{--内容区域--}}
@section('container')
<div class="am-g am-g-fixed blog-fixed">
    <div class="am-u-md-12 am-u-sm-12">
        @foreach($data as $d)
        <article class="am-g blog-entry-article">
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
                <img src="{{url($d->thumbnail)}}" alt="{{$d->title}}" class="am-u-sm-12">
            </div>
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
                <h1><a href="{{url('a/'.$d->id)}}" target="_blank">{{$d->title}}</a></h1>
                <span><a href="{{url('cat/'.$d->cat_id)}}" target="_blank" class="blog-color">{{$field->cat_name}} &nbsp;</a></span>
                <span>{{ $d->author}}  &nbsp;</span>
                <span>{{ $d->created_at}}</span>
                <p>
                    {{ str_limit($d->description, 169,'... ...')}}
                </p>
                <p style="text-align: right;"><a href="{{url('a/'.$d->id)}}" title="{{$d->title}}" target="_blank" class="blog-continue">查看全文... ...</a></p>
            </div>
        </article>
        @endforeach
        {{$data->links()}}
    </div>
	
</div>
@stop
{{--内容区域结束--}}

