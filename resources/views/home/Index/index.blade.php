{{--引入模板--}}
@extends('layout.homelayout')
@section('info')
    <title>{{Config::get('web.web_title')}} - {{Config::get('web.seo_title')}}</title>
    <meta name="keywords" content="{{Config::get('web.keywords')}}" />
    <meta name="description" content="{{Config::get('web.description')}}" />
@stop
{{--banner区域结束--}}

@section('banner')
<div class="am-g am-g-fixed blog-fixed am-u-sm-centered blog-article-margin">
    <div data-am-widget="slider" class="am-slider am-slider-b1" data-am-slider='{&quot;controlNav&quot;:false}' >
		<ul class="am-slides">
            @foreach($pics as $p)
			<li>
				<img src="{{url($p->thumbnail)}}">
				<div class="blog-slider-desc am-slider-desc ">
					<div class="blog-text-center blog-slider-con">             
						<h1 class="blog-h-margin"><a href="{{url('a/'.$p->id)}}" target="_blank">{{$p->title}}</a></h1>
						<p>
                            {{ str_limit($p->description, 169,'... ...')}}
						    <span class="blog-bor" style="float: right">{{ $p->created_at}}</span>
						</p>           
					</div>
				</div>
			</li>
            @endforeach
		</ul>
    </div>
</div>
@stop
{{--banner区域结束--}}



{{--内容区域--}}
@section('container')
<div class="am-g am-g-fixed blog-fixed">
    <div class="am-u-md-8 am-u-sm-12">
        @foreach($new as $n)
        <article class="am-g blog-entry-article">
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
                <img src="{{url($n->thumbnail)}}" alt="{{$n->title}}" class="am-u-sm-12">
            </div>
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
                <h1><a href="{{url('a/'.$n->id)}}" target="_blank">{{$n->title}}</a></h1>
                @foreach($catc as $ck => $c)
                    @if($c['id'] == $n->cat_id)
                    <span><a href="{{url('cat/'.$n->cat_id)}}" target="_blank" class="blog-color">{{$c['cat_name']}} &nbsp;</a></span>
                    @endif
                @endforeach
                <span>{{ $n->author}}  &nbsp;</span>
                <span>{{ $n->created_at}}</span>
                <p>
                    {{ str_limit($n->description, 169,'... ...')}}
                </p>
                <p style="text-align: right;"><a href="{{url('a/'.$n->id)}}" class="blog-continue">查看全文... ...</a></p>
            </div>
        </article>
        @endforeach
        {{$new->links()}}
    </div>

	
    <div class="am-u-md-4 am-u-sm-12 blog-sidebar">
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>关于我</span></h2>
            <img src="{{ asset($about['pic']) }}" alt="about me" class="blog-entry-img" >
            <p>{{$about['cn_name']}} &bull; <small>{{$about['en_name']}}</small></p>
            <p>
				{{$about['introduce']}}
			</p>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>联系我</span></h2>
            <p style="text-align:left;">
            QQ:{{$about['qq']}} <br/>
            微信号:{{$about['weixin']}} <br/>
            <a href="{{$about['weibo']}}" title="{{$about['weibo']}}">微博</a> <br/>
            <a href="{{$about['twitter']}}" title="{{$about['twitter']}}">推特主页</a> <br/>
            <a href="{{$about['sina']}}" title="{{$about['sina']}}">新浪博客</a> <br/>
            <a href="{{$about['souhu']}}" title="{{$about['souhu']}}">搜狐博客</a> <br/>
            <a href="{{$about['github']}}" title="{{$about['github']}}">github</a> <br/>
            </p>
        </div>
        <div class="blog-clear-margin blog-sidebar-widget blog-bor am-g ">
            <h2 class="blog-title"><span>兴趣 &bull; 爱好</span></h2>
            <div class="am-u-sm-12 blog-clear-padding">
                @foreach($about['hobby'] as $h=>$hv)
                    <span class="blog-tag">{{$hv}}</span>
                @endforeach
            </div>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-title"><span>人生 &bull; 语录</span></h2>
            <ul class="am-list" style="text-align:left;">
                @foreach($quotes as $q)
                <li>
                    <a href="#" title="{{$q->en_title}}">{{$q->cn_title}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="blog-sidebar-widget blog-bor" style="text-align:left;">
            <h2 class="blog-title"><span>热门文章</span></h2>
            <ul class="am-list">
                @foreach($hot as $h)
                <li><a  class="am-text-truncate" href="{{url('a/'.$h->id)}}">{{$h->title}}</a></li>
                 @endforeach
            </ul>
        </div>
    </div>
</div>
@stop
{{--内容区域结束--}}

