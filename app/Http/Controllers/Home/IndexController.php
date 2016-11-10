<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/9
 * 时间: 10:15
 */

namespace App\Http\Controllers\Home;
use App\Http\Model\ArticleCatModel;
use App\Http\Model\ArticleModel;

class IndexController extends CommonController{
    public function index(){
         //站长推荐的6篇文章
        $pics = ArticleModel::where(['is_show'=>'1','is_recom'=>1])->orderBy('hitcount','desc')->take(6)->get();

        //点击量最高的6篇文章
        $hot = ArticleModel::where(['is_show'=>'1'])->orderBy('hitcount','desc')->take(5)->get();

        //最新文章8篇（带分页）
        $new = ArticleModel::where(['is_show'=>'1'])->orderBy('created_at','desc')->paginate(8);

        return view('home.index.index',compact('hot','new','pics'));
    }

    public function cat($cid){
        //图文列表5篇（带分页）
        $data = ArticleModel::where('cat_id',$cid)->orderBy('created_at','desc')->paginate(5);

        $field = ArticleCatModel::find($cid);//获取当前分类信息

        return view('home.cat.cat',compact('field','data'));
    }

    public function article($id){
        $field = ArticleModel::Join('article_cat','article.cat_id','=','article_cat.id')->where('article.id',$id)->first();
        //查看次数自增
        ArticleModel::where('id',$id)->increment('hitcount');
		
		//点击量最高的6篇文章
        $hot = ArticleModel::where(['is_show'=>'1'])->orderBy('hitcount','desc')->take(4)->get();
		
		//上一篇文章
        $article['pre'] = ArticleModel::where('id','<',$id)->orderBy('id','desc')->first();
		//下一篇文章
        $article['next'] = ArticleModel::where('id','>',$id)->orderBy('id','asc')->first();
		
		//相关分类文章
        $data = ArticleModel::where('cat_id',$field->cat_id)->orderBy('id','desc')->take(4)->get();

        return view('home.article.act',compact('field','article','hot','data'));
    }

}