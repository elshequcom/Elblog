{{--引入模板--}}
@extends('layout.homelayout')
@section('info')
    <title>{{$field->title}} - {{Config::get('web.seo_title')}}</title>
    <meta name="keywords" content="{{$field->keywords}}" />
    <meta name="description" content="{{$field->description}}" />
@stop





{{--内容区域--}}
@section('container')
<ol class="am-breadcrumb">
  <li><a href="{{url('/')}}">首页</a></li>
  <li><a href="{{url('cat/'.$field->cat_id)}}">{{$field->cat_name}}</a></li>
  <li class="am-active">{{$field->title}}</li>
</ol>
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
      <article class="am-article blog-article-p">
        <div class="am-article-hd">
          <h1 class="am-article-title blog-text-center">{{$field->title}}</h1>
          <p class="am-article-meta blog-text-center">
              <span><a href="#" class="blog-color">{{$field->cat_name}} &nbsp;</a></span>-
              <span>{{$field->author}} &nbsp;</span>-
              <span><a href="#">{{$field->created_at}}</a></span>-
			  <span>已查看{{$field->hitcount}}次</span>
          </p>
        </div>        
        <div class="am-article-bd">
        <img src="{{url($field->thumbnail)}}" alt="" class="blog-entry-img blog-article-margin">          
        <p class="class="am-article-lead"">
         {!! $field->content !!}
        </p>
        </div>
      </article>
        
        <div class="am-g blog-article-widget blog-article-margin">
          <div class="am-u-sm-12 am-u-sm-centered blog-text-center">
            <span class="am-icon-tags"> &nbsp;</span>
			<a href="#">{{$field->keywords}}</a>
            <hr>
			<style>
	.get-codes-bdshare a{
		height: 24px;margin: 0 2px;
	}
</style>
		<div class="content" style="clear: both;height: auto;margin: 0 auto;overflow: hidden;width: 421px;">
			<div id="bdshare" style="" class="bdshare_t bds_tools get-codes-bdshare" data="{'bdDes':{{$field->keywords}},'text':{{$field->description}},'title':{{$field->title}},'pic':{{url($field->thumbnail)}},'bdComment':'这个篇文章蛮有意思，我看你们还是不要看了','url': {{url('a/'.$article['next']->art_id)}}}">
				<a class="bds_mshare" data-cmd="mshare"></a>
				<a class="bds_qzone" data-cmd="qzone"></a>
				<a class="bds_tsina" data-cmd="tsina"></a>
				<a class="bds_baidu" data-cmd="baidu"></a>
				<a class="bds_renren" data-cmd="renren"></a>
				<a class="bds_tqq" data-cmd="tqq"></a>
				<a class="bds_more" data-cmd="more">更多</a>	
			</div>
		</div>
            <script type="text/javascript" id="bdshare_js" data="type=tools" ></script>
			<script type="text/javascript" id="bdshell_js"></script>
			<script type="text/javascript">
				document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
			</script>
          </div>
        </div>

        <hr>
        <div class="am-g blog-author blog-article-margin">
          <div class="am-u-sm-3 am-u-md-3 am-u-lg-2">
            <img src="{{ asset($about['pic']) }}" alt="" class="blog-author-img am-circle">
          </div>
          <div class="am-u-sm-12">
          <h3><span>作者 &nbsp;: &nbsp;</span><span class="blog-color">{{$about['cn_name']}} &bull;</span> <small>{{$about['en_name']}}</small></h3>
            <p class="am-kai">
			{{$about['introduce']}}
			</p>
          </div>
        </div>
        <hr>
        <ul class="am-pagination blog-article-margin"> 
			<li class="am-pagination-prev">
			@if($article['pre'])
				<a href="{{url('a/'.$article['pre']->id)}}">&laquo; {{$article['pre']->title}}</a>
			@else
				<span>没有上一篇了</span>
			@endif
			</li>
			<li class="am-pagination-next">
			@if($article['next'])
				<a href="{{url('a/'.$article['next']->id)}}"> {{$article['next']->title}}&raquo;</a>
			@else
				<span>没有下一篇了</span>
			@endif
			</li>
        </ul>
		<hr>
		
        <div class="blog-sidebar-widget blog-bor" style="text-align:left;">
            <h2 class="blog-title"><span>热门文章</span></h2>
			<ul data-am-widget="gallery" class="am-gallery am-avg-sm-4 am-avg-md-4 am-avg-lg-4 am-gallery-imgbordered" data-am-gallery="{  }" >
				@foreach($hot as $h)
				<li>
					<div class="am-gallery-item">
						<a href="{{url('a/'.$h->id)}}" title="{{$h->title}}">
						  <img src="{{ asset($h->thumbnail) }}"  alt="{{$h->title}}"/>
							<h3 class="am-gallery-title">{{$h->title}}</h3>
							<div class="am-gallery-desc">{{$h->created_at}}<span style="float: right;">已查看{{$h->hitcount}}次</span></div>
						</a>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
		
		
		
        <hr>
		
		<div class="blog-sidebar-widget blog-bor" style="text-align:left;">
            <h2 class="blog-title"><span>相关文章</span></h2>
			<ul data-am-widget="gallery" class="am-gallery am-avg-sm-4 am-avg-md-4 am-avg-lg-4 am-gallery-imgbordered" data-am-gallery="{  }" >
				@foreach($data as $d)
				<li>
					<div class="am-gallery-item">
						<a href="{{url('a/'.$d->id)}}" title="{{$d->title}}">
						  <img src="{{ asset($d->thumbnail) }}"  alt="{{$d->title}}"/>
							<h3 class="am-gallery-title">{{$d->title}}</h3>
							<div class="am-gallery-desc">{{$d->created_at}}  <span style="float: right;">已查看{{$d->hitcount}}次</span></div>
						</a>
					</div>
				</li>
				@endforeach
			</ul>
        </div>
		 <hr>
		
		<!-- 有言社会化评论开始  -->
		<div id="uyan_frame"></div>
		<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2100241"></script>

        <hr>
    </div>
</div>
@stop
{{--内容区域结束--}}

