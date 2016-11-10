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
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/article')}}" target="main">文章管理</a> &raquo; 编辑文章
    </div>
	<div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>文章列表</a>
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
        <form action="{{url('admin/article/'.$field->id)}}" method="post">
            <input type="hidden" name="_method" value="put">
			{{csrf_field()}}
            <table class="add_tab">
                <tbody>
					<tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="title" value="{{$field->title}}" placeholder="最多可写20个汉字">
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>文章分类：</th>
                        <td>
                            <select name="cat_id">
                                @foreach($data as $d)
                                    <option value="{{$d->id}}"  @if($field->cat_id==$d->id) selected @endif  @if(!stristr($d->_cat_name,'--')) disabled="disabled" @endif >{{$d->_cat_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>文章作者：</th>
                        <td>
                            <input type="text" name="author" value="{{$field->author}}" placeholder="最多可写10个汉字">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>缩略图：</th>
                        <td>
                        	<input type="text" name="thumbnail" value="{{$field->thumbnail}}">
							<input type="file" name="file_upload" id="file_upload" multiple="true">
							<link rel="stylesheet" type="text/css" href="{{asset('/libraries/uploadify/uploadify.css')}}">
							<script type="text/javascript" src="{{asset('/libraries/uploadify/jquery.uploadify.js')}}"></script>
							<script type="text/javascript">
							    <?php $timestamp = time();?>
								$(function() {
									$('#file_upload').uploadify({
		                                'buttonText' : '图片上传',
		                                'formData'     : {
		                                    'timestamp' : '<?php echo $timestamp;?>',
		                                    '_token'     : "{{csrf_token()}}"
		                                },
		                                'swf'      : "{{asset('/libraries/uploadify/uploadify.swf')}}",
		                                'uploader' : "{{url('admin/upload')}}",
										'onUploadSuccess' : function(file, data, response) {
											$('input[name=thumbnail]').val(data); //更改文本框的内容
											$('#thumbnail').attr('src',"{{url('/')}}"+data); //显示图片
											//alert(data); //这个就是返回的路径
										}
		                            });
								});
						    </script>
							<style>
		                        .uploadify{display:inline-block;}
		                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
		                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
		                    </style>
                        </td>
                    </tr>
					<tr>
						<th></th>
						<td>
							<img alt="" id="thumbnail" style="max-width: 350px; max-height:100px;" src="{{url('/')}}{{$field->thumbnail}}">
						</td>
					</tr>
                    <tr>
                        <th>是否显示：</th>
                        <td>
                            <label for=""><input type="radio" name="is_show" value="1" style="width:15px" @if($field->is_show == 1)  checked="checked" @endif >显示</label>
                            <label for=""><input type="radio" name="is_show" value="0" style="width: 15px" @if($field->is_show == 0)  checked="checked" @endif >不显示</label>
                        </td>
                    </tr>
					<tr>
                        <th>是否推荐：</th>
                        <td>
                            <label for=""><input type="radio" name="is_recom" value="1" style="width:15px" @if($field->is_recom == 1)  checked="checked" @endif >推荐</label>
                            <label for=""><input type="radio" name="is_recom" value="0" style="width: 15px" @if($field->is_recom == 0)  checked="checked" @endif >不推荐</label>
                        </td>
                    </tr>
                    <tr>
                        <th>网站内容：</th>
                        <td>
							<script type="text/javascript" charset="utf-8" src="{{ asset('/libraries/ueditor/ueditor.config.js') }}"></script>
							<script type="text/javascript" charset="utf-8" src="{{ asset('/libraries/ueditor/ueditor.all.min.js') }}"></script>
							<script type="text/javascript" charset="utf-8" src="{{ asset('/libraries/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
							<style>
								.edui-default{line-height: 28px;}
								div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
								{overflow: hidden; height:20px;}
								div.edui-box{overflow: hidden; height:22px;}
							</style>
							<script id="editor"  name="content"type="text/plain" style="width:590px;height:400px;">{!! $field->content !!}</script>
							<script>
								var ue = UE.getEditor('editor');
							</script>
                        </td>
                    </tr>
					<tr>
                        <th>SEO关键词：</th>
                        <td>
                            <textarea name="keywords" placeholder="可写170个字符">{{$field->keywords}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>SEO描述：</th>
                        <td>
                            <textarea class="lg" name="description" placeholder="可写190个字符">{{$field->description}}</textarea>
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