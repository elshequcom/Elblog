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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model{

    //指定表名
    protected  $table = 'admin';

    //指定主键
    protected  $primaryKey = 'id';

    //设置不自动地将维护 created_at 和 updated_at 字段
    public $timestamps = false;

}