<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/9
 * 时间: 10:14
 */

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Model\AboutModel;
use App\Http\Model\LinksModel;
use App\Http\Model\NavsModel;
use App\Http\Model\QuotesModel;
use App\Http\Model\ArticleCatModel;
use Illuminate\Support\Facades\View;


class CommonController extends Controller{

    //获取导航
    public function __construct(){
        $navs = NavsModel::all(); //获取自定义导航

        $links = LinksModel::orderBy('orders','asc')->get();//友情链接
        $quotes = QuotesModel::orderBy('created_at','desc')->get(); //获取人生语录

        $cats = ArticleCatModel::get()->toArray(); //获取分类
        foreach($cats as $k =>$v){
            if($v['parent_id'] ==0){
                $catp[] = $v;
            }else{
                $catc[] = $v;
            }
        }

        $about = AboutModel::find(1)->toArray();//获取关于我
        $hs = str_replace('，', ',', $about['hobby']);
        $about['hobby'] = explode(',', $hs);

        View::share('navs',$navs); //把数据共享到继承这个控制器的所有页面中去
        View::share('links',$links);
        View::share('about',$about);
        View::share('quotes',$quotes);
        View::share('catp',$catp);
        View::share('catc',$catc);
    }
	
	
}