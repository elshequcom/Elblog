<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/8
 * 时间: 10:12
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\NavsModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController{
    //get.admin/navs  全部友情链接列表
    public function index(){
        $data = NavsModel::orderBy('orders','asc')->get();
        return view('admin.navs.index',compact('data'));
    }

    //ajax 排序
    public function changeOrder(){
        $input = Input::all();
        $navs = NavsModel::find($input['id']);
        $navs->orders = $input['orders'];
        $re = $navs->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '友情链接排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '友情链接排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/navs/create   添加友情链接
    public function create(){
        return view('admin/navs/add');
    }

    //post.admin/navs  添加友情链接提交
    public function store(){
        $input = Input::except('_token');
        $rules = [
            'name'=>'required',
            'url'=>'required',
        ];

        $message = [
            'name.required'=>'友情链接名称不能为空！',
            'url.required'=>'友情链接URL不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = NavsModel::create($input);
            if($re){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','友情链接失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/navs/{navs}/edit  编辑友情链接
    public function edit($id){
        $field = NavsModel::find($id);
        return view('admin.navs.edit',compact('field'));
    }

    //put.admin/navs/{navs}    更新友情链接
    public function update($id){
        $input = Input::except('_token','_method');
        $re = NavsModel::where('id',$id)->update($input);
        if($re){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','友情链接更新失败，请稍后重试！');
        }
    }

    //delete.admin/navs/{navs}   删除友情链接
    public function destroy($id){
        $re = NavsModel::where('id',$id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '友情链接删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '友情链接删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/navs/{navs}  显示单个分类信息
    public function show(){

    }
}