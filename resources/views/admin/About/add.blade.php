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
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/about')}}" target="main">关于我</a> &raquo; 添加关于我
    </div>
	<div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/about')}}"><i class="fa fa-recycle"></i>关于我详情</a>
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
        <form action="{{url('admin/about')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>中文名：</th>
                        <td>
                            <input type="text" name="cn_name">
                        </td>
                    </tr>
                    <tr>
                        <th>英文名：</th>
                        <td>
                            <input type="text" name="en_name">
                        </td>
                    </tr>
                    <tr>
                        <th>简单介绍：</th>
                        <td>
                            <textarea name="introduce" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>头像：</th>
                        <td>
                        	<input type="text" name="pic">
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
											$('input[name=pic]').val(data); //更改文本框的内容
											$('#pic').attr('src',"{{url('/')}}"+data); //显示图片
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
							<img src="" alt="" id="pic" style="max-width: 350px; max-height:100px;">
						</td>
					</tr>
					<tr>
                        <th>爱好：</th>
                        <td>
                            <textarea name="hobby" placeholder="可写170个字符"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>QQ：</th>
                        <td>
                            <input type="text" name="qq">
                        </td>
                    </tr>
                    <tr>
                        <th>微信：</th>
                        <td>
                            <input type="text" name="weixin">
                        </td>
                    </tr>
                    <tr>
                        <th>微博：</th>
                        <td>
                            <input type="text" name="weibo">
                        </td>
                    </tr>
                    <tr>
                        <th>推特：</th>
                        <td>
                            <input type="text" name="twitter" class="lg" >
                        </td>
                    </tr>
                    <tr>
                        <th>新浪：</th>
                        <td>
                            <input type="text" name="sina" class="lg" >
                        </td>
                    </tr>
                    <tr>
                        <th>搜狐：</th>
                        <td>
                            <input type="text" name="souhu" class="lg" >
                        </td>
                    </tr>
                    <tr>
                        <th>GitHub：</th>
                        <td>
                            <input type="text" name="github" class="lg" >
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