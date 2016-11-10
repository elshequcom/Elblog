<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/2
 * 时间: 20:46
 */

namespace app\Http\Model;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model{

    //指定表名
    protected  $table = 'user';

    //指定主键
    protected  $primaryKey = 'id';

}