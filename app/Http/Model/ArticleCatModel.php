<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/4
 * 时间: 10:54
 */

namespace app\Http\Model;
use Illuminate\Database\Eloquent\Model;

class ArticleCatModel extends Model{
    protected $table='article_cat';

    protected $primaryKey='id';

    public $timestamps=false;


    //指定不能批量赋值的字段属性
    protected  $guarded = ['id'];

    //这是外面调用的方法
    public function tree(){
        $catarrs = $this->all();
        return $this->getTree($catarrs);
    }

//    public static function tree()
//    {
//        $categorys = Category::all();
//        return (new Category)->getTree($categorys,'cate_name','cate_id','cate_pid');
//    }

    /*
     * 二级分类生成树形结构
     * $data 分类表的所有数据
     * $cat_name 分类的name字段
     * $cat_id 分类表ID
     * $parent_id 顶级分类字段名
     * $pid 顶级分类的ID值 0表示顶级
     */
    protected function getTree($data,$cat_name='cat_name',$cat_id='id',$parent_id='parent_id',$pid=0){
        $arr = array();
        foreach ($data as $k=>$v){
            if($v->$parent_id==$pid){
                //$data[$k]['ding'] = '顶级分类'; //存入顶级分类的名字
                $data[$k]["_".$cat_name] = $data[$k][$cat_name]; //顶级分类
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if($n->$parent_id == $v->$cat_id){
                        //$data[$m]['fu'] = $data[$k][$cat_name]; //存入他所对应的父级分类名字
                        $data[$m]["_".$cat_name] = '-- '.$data[$m][$cat_name]; //二级分类
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }

    /*
     * 无限极分类获取所有分类
     * 递归方式
     * */
    public function getCats($arr,$pid=0,$level=0){
        static $tree = array();
        foreach ($arr as $k=>$v){
            if ($v->parent_id == $pid){
                $v->level = $level;
                $tree[] = $v;
                $this->getCats($arr,$v->id,$level+1);
            }
        }
        return $tree;
    }
}