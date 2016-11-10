<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/4
 * 时间: 10:46
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\ArticleCatModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class ArticleCatController extends CommonController{

    //get.admin/articlecat  全部分类列表
    public function index(){
        $arrs = (new ArticleCatModel)->tree();
       // dd($arrs);
        return view('admin.articlecat.index')->with('data',$arrs);
    }

    //get.admin/articlecat/create   添加分类
    public function create(){
        $data = ArticleCatModel::where('parent_id',0)->get();
        return view('admin/articlecat/add',compact('data'));
    }

    //post.admin/articlecat  添加分类提交处理
    public function store(){
        $input = Input::except('_token');
        $rules = [
            'cat_name'=>'required',
        ];

        $message = [
            'cat_name.required'=>'分类名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){

            $re = ArticleCatModel::create($input);
            if($re){
                return redirect('admin/articlecat');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/articlecat/{articlecat}  显示单个分类信息
    public function show(){

    }

    //delete.admin/articlecat/{articlecat}   删除单个分类
    public function destroy($id){
        $re = ArticleCatModel::where('id',$id)->delete();
        ArticleCatModel::where('parent_id',$id)->update(['parent_id'=>0]);
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类删除失败，请稍后重试！',
            ];
        }
        return $data;
    }


    //put.admin/articlecat/{articlecat}   对编辑的数据进行处理
    public function update($id){
        $input = Input::except('_token','_method');
        $re = ArticleCatModel::where('id',$id)->update($input);
        if($re){
            return redirect('admin/articlecat');
        }else{
            return back()->with('errors','分类信息更新失败，请稍后重试！');
        }
    }

    //get.admin/articlecat/{articlecat}/edit  编辑分类
    public function edit($id){
        $field = ArticleCatModel::find($id);
        $data = ArticleCatModel::where('parent_id',0)->get();
        return view('admin.articlecat.edit',compact('field','data'));
    }
}