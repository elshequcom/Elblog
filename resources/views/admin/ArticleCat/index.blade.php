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
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}" target="main">首页</a> &raquo; <a href="{{url('admin/articlecat')}}">分类管理</a> &raquo; 分类列表
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/articlecat/create')}}"><i class="fa fa-plus"></i>添加分类</a>
            </div>
        </div>
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">ID</th>
                    <th>分类名称</th>
                    <th>顶级分类</th>
                    <th>操作</th>
                </tr>

                @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->id}}</td>
                        <td>{{$v->_cat_name}}</td>
                        <td>
                            @if($v->parent_id >0 && $v->id)
                                {{$v->fu}}
                            @else
                                {{$v->ding}}
                            @endif

                        </td>
                        <td>
                            <a href="{{url('admin/articlecat/'.$v->id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->id}})">删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

	
	
<script>
    //删除分类
    function delCate(id) {
        layer.confirm('您确定要删除这个分类吗？', {
			btn: ['确定','取消']
        }, function(){
            $.post("{{url('admin/articlecat/')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if(data.status==0){
                    location.href = location.href; //删除后刷新页面
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
	
	
{{--
发送Ajax修改数据
<input type="text" onchange="changeOrder(this,{{$v->id}})" value="{{$v->order}}">
<script>
    function changeOrder(obj,id){
        var order = $(obj).val(); //获取内容
        //发送post请求 csrf_token是表单token值 修改的ID 修改的字段
        $.post("{{url('admin/cate/changeorder')}}",{'_token':'{{csrf_token()}}','id':id,'order':order},function(data){
            if(data.status == 0){
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
    }
</script>
分配路由
Route::post('cate/changeorder', 'CategoryController@changeOrder');
控制器中的方法
public function changeOrder(){
    $input = Input::all();
    $cate = Category::find($input['cate_id']);
    $cate->cate_order = $input['cate_order'];
    $re = $cate->update();
    if($re){
        $data = [
            'status' => 0,
            'msg' => '分类排序更新成功！',
        ];
    }else{
        $data = [
            'status' => 1,
            'msg' => '分类排序更新失败，请稍后重试！',
        ];
    }
    return $data;
}
--}}

@stop
{{--内容区域结束--}}

{{--footer区域--}}
@section('footer')

@stop
{{--footer区域结束--}}