<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/3
 * 时间: 21:16
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\ArticleModel;
use App\Http\Model\ArticleCatModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController{

    //get.admin/article  全部文章列表
    public function index(){
		$data = ArticleModel::orderBy('id','desc')->paginate(5);
        return view('admin.article.index',compact('data'));
    }

    //get.admin/article/create   添加文章
    public function create(){
        $data = (new ArticleCatModel)->tree();
        return view('admin/article/add',compact('data'));
    }

    //post.admin/article  添加文章提交处理
    public function store(){
        $input = Input::except('_token');
        $rules = [
            'title'=>'required',
            'content'=>'required',
        ];

        $message = [
            'title.required'=>'文章名称不能为空！',
            'content.required'=>'文章内容不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = ArticleModel::create($input);
            if($re){
                return redirect('admin/article');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/article/{article}  显示单个文章信息
    public function show(){

    }

	//get.admin/article/{article}/edit  编辑文章
    public function edit($id){
        $data = (new ArticleCatModel)->tree();
        $field = ArticleModel::find($id);
        return view('admin.article.edit',compact('data','field'));
    }

    //put.admin/article/{article}    对编辑的数据进行处理
    public function update($id){
        $input = Input::except('_token','_method');
        $re = ArticleModel::where('id',$id)->update($input);
        if($re){
            return redirect('admin/article');
        }else{
            return back()->with('errors','文章更新失败，请稍后重试！');
        }
    }

    //delete.admin/article/{article}   删除单个文章
    public function destroy($id)
    {
        $re = ArticleModel::where('id',$id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '文章删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '文章删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
}