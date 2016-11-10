<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/9
 * 时间: 17:04
 */

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class AboutModel extends Model{
    protected $table='about';

    protected $primaryKey='id';

    public $timestamps=false;

    //指定不能批量赋值的字段属性
    protected  $guarded = ['id'];


}