<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/9
 * 时间: 17:03
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\QuotesModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class QuotesController extends CommonController{
    //get.admin/quotes  全部格言列表
    public function index(){
        $data = QuotesModel::orderBy('id','desc')->paginate(5);
        return view('admin.quotes.index',compact('data'));
    }

    //get.admin/quotes/create   添加格言
    public function create(){
        return view('admin/quotes/add');
    }

    //post.admin/quotes  添加格言提交处理
    public function store(){
        $input = Input::except('_token');
        $rules = [
            'cn_title'=>'required',
            'en_title'=>'required',

        ];

        $message = [
            'cn_title.required'=>'中文格言名称不能为空！',
            'en_title.required'=>'英文格言内容不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = QuotesModel::create($input);
            if($re){
                return redirect('admin/quotes');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/quotes/{quotes}  显示单个格言信息
    public function show(){

    }

    //get.admin/quotes/{quotes}/edit  编辑格言
    public function edit($id){
         $field = QuotesModel::find($id);
        return view('admin.quotes.edit',compact('field'));
    }

    //put.admin/quotes/{quotes}    对编辑的数据进行处理
    public function update($id){
        $input = Input::except('_token','_method');
        $re = QuotesModel::where('id',$id)->update($input);
        if($re){
            return redirect('admin/quotes');
        }else{
            return back()->with('errors','格言更新失败，请稍后重试！');
        }
    }

    //delete.admin/quotes/{quotes}   删除单个格言
    public function destroy($id)
    {
        $re = QuotesModel::where('id',$id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '格言删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '格言删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
}