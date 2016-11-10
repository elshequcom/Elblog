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
use App\Http\Model\LinksModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController{
    //get.admin/links  全部友情链接列表
    public function index(){
        $data = LinksModel::orderBy('orders','asc')->get();
        return view('admin.links.index',compact('data'));
    }

    //ajax 排序
    public function changeOrder(){
        $input = Input::all();
        $links = LinksModel::find($input['id']);
        $links->orders = $input['orders'];
        $re = $links->update();
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

    //get.admin/links/create   添加友情链接
    public function create(){
        return view('admin/links/add');
    }

    //post.admin/links  添加友情链接提交
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
            $re = LinksModel::create($input);
            if($re){
                return redirect('admin/links');
            }else{
                return back()->with('errors','友情链接失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/links/{links}/edit  编辑友情链接
    public function edit($id){
        $field = LinksModel::find($id);
        return view('admin.links.edit',compact('field'));
    }

    //put.admin/links/{links}    更新友情链接
    public function update($id){
        $input = Input::except('_token','_method');
        $re = LinksModel::where('id',$id)->update($input);
        if($re){
            return redirect('admin/links');
        }else{
            return back()->with('errors','友情链接更新失败，请稍后重试！');
        }
    }

    //delete.admin/links/{links}   删除友情链接
    public function destroy($id){
        $re = LinksModel::where('id',$id)->delete();
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

    //get.admin/category/{category}  显示单个分类信息
    public function show(){

    }
}