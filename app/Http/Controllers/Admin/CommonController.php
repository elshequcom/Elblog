<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/2
 * 时间: 16:06
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
class CommonController extends Controller{
	//图片上传
    public function upload(){
        $file = Input::file('Filedata');
        if($file -> isValid()){
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension; //重新设置文件名
            $path = str_replace('\\','/',$file -> move(base_path().'/public/upload/Uploadify',$newName)); //base_path()网站根目录 获取的是完整路径
            $filepath = str_replace('\\','/','/public/upload/Uploadify/'.$newName); // /public/upload/Uploadify\20161107093936827.png
            return $filepath; //替换/
        }
    }

}