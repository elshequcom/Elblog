<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/8
 * 时间: 10:14
 */

namespace app\Http\Model;
use Illuminate\Database\Eloquent\Model;

class NavsModel extends Model{
    protected $table='navs';

    protected $primaryKey='id';

    public $timestamps=false;

    //指定不能批量赋值的字段属性
    protected  $guarded = ['id'];

}