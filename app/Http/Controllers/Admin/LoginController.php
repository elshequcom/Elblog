<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/2
 * 时间: 15:41
 */
namespace App\Http\Controllers\Admin;
use App\Http\Model\AdminModel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;


require_once '/libraries/verification/Code.class.php';
class LoginController extends CommonController{

    public function login(){
        if($arr = Input::all()){
            $code = $this->getcode(); //获取验证码
            if(strtoupper($arr['code']) !== $code){
                return back()->with('msg','验证码错误');
            }else{
                //接收表单数据
                $email = $arr['u_email'];
                $password = $arr['u_password'];
                if(empty($email) || empty($password)){
                    return back()->with('msg','邮箱和密码必填!');
                }else{
                    $admin = AdminModel::where('email','=',$email)->first();
                    if($admin){
                        //如果是超管ID为1
                        if($admin->id ==1) {
                            //说明是超管登录
                            if(Crypt::decrypt($admin->password) !== $password) {
                                //echo Crypt::encrypt($str); //加密
                                //echo Crypt::decrypt($str_p);//解密
                                //说明密码错了
                                return back()->with('msg','您的密码错误!');
                            }else {
                                //说明密码正确，也没被禁用，返回数据
                                //登录成功;
                                session(['a_id'=>$admin->id,'a_email'=>$admin->email]);
                                //print_r($admin);
                                //跳转到／home页
                                //return redirect('/home');

                                //登录成功后跳转登录前的那页，但一般我不这么用根据情况使用
                                //return redirect()->back();

                                //我一般使用这个，成功后登录我想使用的控制器
                                return redirect()->action('Admin\IndexController@index');
                            }
                        }else{
                            if($admin->is_use !== 0){
                                //普管登录
                                if(Crypt::decrypt($admin->password) !== $password) {
                                    //echo Crypt::encrypt($str); //加密
                                    //echo Crypt::decrypt($str_p);//解密
                                    //说明密码错了
                                    return back()->with('msg','您的密码错误!');
                                }else {
                                    //说明密码正确，也没被禁用，返回数据
                                    //登录成功;
                                    session(['a_id'=>$admin->id,'a_email'=>$admin->email]);
                                    return redirect()->action('Admin\IndexController@index');
                                }
                            }else{
                                //说明该用户已被管理员禁用
                                return back()->with('msg','该管理员已被禁用!');
                            }
                        }
                    }else{
                        //说明没有该用户
                        return back()->with('msg','管理员不存在!');
                    }
                }
            }
        }else{
            return view('admin.login.login');
        }
    }

    //输出到页面验证码
    public function code(){
        $Code = new \Code();
        $Code->make();
    }
    //测试从session中获取验证码的方法
    protected function getcode(){
        $Code = new \Code();
        //echo $Code->get();
        return $Code->get();
    }

    //退出管理后台
    public function quit(){
        session(['a_id'=>null]);
        session(['a_email'=>null]);
        return redirect('admin/login');
    }
}





