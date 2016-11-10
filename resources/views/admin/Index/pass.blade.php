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
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; 密码管理
</div>
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
    </div>
</div>

<div class="result_wrap">
    <form method="post">
        {{--设置tooken值，防止跨站攻击--}}
        {{csrf_field()}}
        <table class="add_tab">
            <caption>当前管理员：{{ session('a_email') }}</caption>
            <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>原密码：</th>
                    <td>
                        <input type="password" maxlength="20" name="password_o"> </i>请输入原始密码</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>新密码：</th>
                    <td>
                        <input type="password" maxlength="20" name="password"> </i>新密码6-20位</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>确认密码：</th>
                    <td>
                        <input type="password" maxlength="20" name="password_confirmation"> </i>再次输入密码</span>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
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
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交" style="width: 100px">
                        <input type="button" class="back"  style="width: 100px" onclick="history.go(-1)" value="返回">
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