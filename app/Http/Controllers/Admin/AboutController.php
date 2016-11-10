<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/9
 * 时间: 17:01
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\AboutModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AboutController extends CommonController{
    //get.admin/about  全部关于我列表
    public function index(){
        $data = AboutModel::orderBy('id','desc')->paginate(5);
        return view('admin.about.index',compact('data'));
    }

    //get.admin/about/create   添加关于我
    public function create(){
        //return view('admin/about/add');
    }

    //post.admin/about  添加关于我提交处理
   /* public function store(){
        $input = Input::except('_token');
        $rules = [
            'cn_name'=>'required',
            'en_name'=>'required',
        ];

        $message = [
            'cn_name.required'=>'名字不能为空！',
            'en_name.required'=>'名字不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = AboutModel::create($input);
            if($re){
                return redirect('admin/about');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/about/{about}  显示单个关于我信息
    public function show(){

    }*/

    //get.admin/about/{about}/edit  编辑关于我
    public function edit($id){
        $field = AboutModel::find($id);
        return view('admin.about.edit',compact('field'));
    }

    //put.admin/about/{about}    对编辑的数据进行处理
    public function update($id){
        $input = Input::except('_token','_method');
        $re = AboutModel::where('id',$id)->update($input);
        if($re){
            return redirect('admin/about');
        }else{
            return back()->with('errors','关于我更新失败，请稍后重试！');
        }
    }

    //delete.admin/about/{about}   删除单个文章
    /*public function destroy($id){
        $re = AboutModel::where('id',$id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '关于我删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '关于我删除失败，请稍后重试！',
            ];
        }
        return $data;
    }*/
}