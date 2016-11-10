<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/3
 * 时间: 8:41
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\AdminModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController  extends CommonController{
    //显示后台首页
    public function index(){
        return view('admin.index.index');
    }

    //显示后台内容
    public function info(){
        return view('admin.index.info');
    }

    //更改管理员密码
    public function pass(){
        if($arr = Input::all()){
            //验证规则
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            //验证提示信息
            $message = [
                'password.required'=>'字段不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！',
            ];

            //验证之后，错误返回错误信息
            $validator = Validator::make($arr,$rules,$message);

            if($validator->passes()){
                $email = session('a_email');
                $admin = AdminModel::where('email','=',$email)->first();

                //数据库原密码
                $_password = Crypt::decrypt($admin->password);

                if($arr['password_o'] == $_password){
                    //旧密码填写正确
                    $admin->password = Crypt::encrypt($arr['password']);
                    $admin->update();
                    return back()->with('correct','修改密码成功!');
                }else{
                    //原密码填写错误
                    return back()->with('errors','原密码错误!');
                }
            }else{
                //返回多个错误
                return back()->withErrors($validator);
            }

        }else{
            return view('admin.index.pass');
        }
    }

    //导出数据库数据的方法
    public function exportSql(){

    }


}