<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/1
 * Time: 22:53
 */

namespace App\Http\Controllers;
use App\StudentM;
use Illuminate\Support\Facades\DB;

class StudentControllers extends Controller{
    //显示学生信息列表
    public function index(){
        echo "index";
        //要指定的命名空间use Illuminate\Support\Facades\DB;
        //$bool = DB::insert('INSERT INTO el_student(name,age) VALUES(?,?)',['lisi','18']);

        //$num = DB::update('UPDATE el_student set age= ? where name = ?',['22','wangwu']);

        // echo "<pre>";
        // $arr = DB::select('SELECT * FROM el_student');
        //找出ID大于100的数据
        // $arr = DB::select('SELECT * FROM el_student where id >?',[100]);

        //dd($arr);

        //$num = DB::delete('DELETE FROM el_student where id >?',[100]);

        /* return view('',[
             'name'=>$name
         ]);*/
    }

    public function query1(){
        /*
###############################################################################
         //插入1数据 返回的是bool值
        $bool = DB::table('student')->insert(['name'=>'zhangsan','age'=>18]);
        //插入多条数据
        $bool = DB::table('student')->insert([
            ['name'=>'zhangsan','age'=>18] ,
            ['name'=>'lisi','age'=>28]
        ]);

        var_dump($bool);*/
        //获取最后一条插入的ID
       /* $id = DB::table('student')->insertGetId(
            ['name'=>'zhangsan','age'=>18]
        );*/

        //更新数据 受影响的行数
        //更新ID等于3的数据
       /* $num = DB::table('student')
            ->where('id',3)
            ->update(['name'=>'呼呼哈哈','age'=>18]
        );
        var_dump($num);*/

        /* //数据加N积分
        $num = DB::table('student')->increment('jifen'); //增加1
        $num = DB::table('student')->increment('jifen','2');//增加2

       //减少N积分
        $num = DB::table('student')->decrement('jifen'); //增加1积分
        $num = DB::table('student')->decrement('jifen','2');//增加2积分

        //带条件的减少N积分
        $num = DB::table('student')
            ->where('id',4)
            ->decrement('jifen','2');

        //减少积分的同时修改其他字段呢
        $num = DB::table('student')
            ->where('id',3)
            ->decrement('jifen','2',['name'=>'胡巴']);

        //删除操作
        //删除ID大于3的数据
        $num = DB::table('student')
            ->where('id','>=',3)
            ->delete();

        //删除ID为3的数据
        $num = DB::table('student')
            ->where('id',3)
            ->delete();

        //删除所有数据
        $num = DB::table('student')->delete();

        //清空数据表数据 不返回数据 请慎用
        DB::table('student')->truncate();

        //查询数据
        //获取表全部数据
        $arrs = DB::table('student')->get();

        //获取表1条数据
        $arr = DB::table('student')->first(); //从最前获取第一条
        $arr = DB::table('student')->orderBy('id','desc')->first(); //从最后获取一条
        $arr = DB::table('student')->orderBy('id','asc')->first(); //从最前获取一条

        //获取ID大于等于12的数据
        $arrs = DB::table('student')->where('id','>=','12')->get();

        //获取ID大于等于12 并且年龄大于等于22岁的数据
        $arrs = DB::table('student')
            ->where('id >= ? and age >= 22',['12','22'])
            ->get();

        //获取表所有的name字段数据 这个数据数组的键是0、1、2、3...
        $arrs = DB::table('student')->pluck('name');

        //获取表所有的name字段数据 这个数据数组的键是0、1、2、3...
        $arrs = DB::table('student')->lists('name');

        //获取表所有的name字段数据 这个数据数组的键是ID字段值
        $arrs = DB::table('student')->lists('name','id');

        //指定查询那几个字段数据
        $arrs = DB::table('student')->select('id','name','age')->get();

        //假如数据库有几十万数据，不能一次性拿出来，我们就要分批获取数据
        //每次从数据库中查询200条数据
        DB::table('student')->chunk(1000,function($arrs){
            var_dump($arrs);
            if(条件）{
                return fales; //只查询一批，然后结束，没有return 就会分批查，直到查询完毕
            }
        });

        //聚合函数的查询
        $count = DB::table('student')->count();   //查询有多少条数据
        $max = DB::table('student')->max();   //查询本表中最大年龄是多少岁
        $min = DB::table('student')->min();   //查询本表中最小年龄是多少岁
        $avg = DB::table('student')->avg();   //查询本表中平均年龄是多少岁
        $sum = DB::table('student')->sum();   //查询本表中总共年龄是多少岁

###############################################################################
        //Eloquent ORM 、模型建立与查询数据
        //要指定的命名空间 use App\StudentM;
        //返回的都是对象数据
        //查询所有数据 all()
        StudentM::all();
        StudentM::get();//效果一样

        //查询一条数据 根据主键字段ID等于12的数据
        StudentM::find(12);

        //根据主键ID进行查找 如果找到输出数据，如果没找到抛出异常
        StudentM::findOrFail(122);

        //条件查询 1条数据 跟find()很像
        StudentM::where('id','>=','100')
            ->orderBy('age','desc') //asc
            ->first();

        //假如数据库有几十万数据，不能一次性拿出来，我们就要分批获取数据
        //每次从数据库中查询200条数据
        StudentM::chunk(1000,function($arrs){
            var_dump($arrs);
            if(条件）{
                return fales; //只查询一批，然后结束，没有return 就会分批查，直到查询完毕
            }
        });

        //聚合函数
        $count = StudentM::count();   //查询有多少条数据
        $count = StudentM::where('id','>','100')->count();   //查询ID大于100的有多少条数据
        $max = StudentM::max();   //查询本表中最大年龄是多少岁
        $min = StudentM::min();   //查询本表中最小年龄是多少岁
        $avg = StudentM::avg();   //查询本表中平均年龄是多少岁
        $sum = StudentM::sum();   //查询本表中总共年龄是多少岁

###############################################################################
        //使用模型对象操作数据
        $stu = new StudentM();
        $stu->name = 'kaka'; //模型属性赋值
        $stu->age = '200'; //模型属性赋值
        $bool = $stu->save();//模型添加数据

        //获取ID为12的添加时间字段的数据
        $stu =StudentM::find(12);
        echo $stu->created_at;

        //使用模型中的create方法新增数据
        //注意：需要在对应的模型中，添加一个protected $fillable = ['name','age'];属性，并指明允许批量赋值的字段有哪些
        $stuobj = StudentM::create(
            ['name'=>'huangye','age'=>12]
        );
        // 查询数据，没有该数据，就新增这条数据
        $stuobj = StudentM::firstOrCreate(
            ['name'=>'huangye']
        );

        //查询数据，有就返回，没有就不做任何操作，需要写入数据，需要调用seve()方法
        $stuobj = StudentM::firstOrNew(
            ['name'=>'huangye']
        );
        $bool = $stuobj->seve();//新增数据


        //更新数据
        $stuobj = StudentM::find(12); //获取到到更改的数据对象
        $stuobj->name = '李泽'; //给对应的属性赋值
        $bool = $stuobj->seve(); //修改数据

        //查询批量修改数据
        $num = StudentM::where('id','>','100')->update(
            ['age',22]
        );


        //根据ID字段删除
        $stuobj = StudentM::find(12);
        $bool = $stuobj->delete();

        //批量删除
        $num = StudentM::destroy(12);         //删除一条
        $num = StudentM::destroy(12,22,54,65); //删除多条
        $num = StudentM::destroy([12,34,34,23]); //删除多条

        //按条件批量删除
        $num = StudentM::where('id','>',123)->delete();
        */

###############################################################################
        //Blade模板的引用
        //return view('Student.index');

        //传递数据
        //return view('Student.index',[
        //    'name'=>'zhangsan '
        //]);

        //多个值
        $name = 'zhangsan ';
        $arr = ['zhangsan','lisi']
        return view('Student.index',[
            'name'=>$name,
            'arr'=>$arr,
        ]);

         //session使用
        // 存值
        //$request->session->put(key,value);
        // 取值
        //$request->session->get(key);
        // 清空
        //$request->session->flush();
//
//        数据库事务
//        可以使用DB门面的transaction方法，如果事务闭包中抛出异常，事务将会自动回滚。
//        如果闭包执行成功，事务将会自动提交。使用transaction方法时不需要担心手动回滚或提交：
//        DB::transaction(function () {
//            DB::table('users')->update(['votes' => 1]);
//            DB::table('posts')->delete();
//        });





    }

}

