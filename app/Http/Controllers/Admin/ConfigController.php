<?php
/**
 * Created by 蝶梦网.
 * User: 自由鹰阿伦
 * Q  Q: 756182916
 * 邮箱：elshequ@163.com
 * 日期: 2016/11/8
 * 时间: 10:12
 */

namespace App\Http\Controllers\Admin;
use App\Http\Model\ConfigModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController{
    //get.admin/config  全部配置列表
    public function index(){
        $data = ConfigModel::orderBy('orders','asc')->get();
		foreach ($data as $k=>$v){
            switch ($v->field_type){
                case 'input':
                    $data[$k]->_html = '<input type="text" class="sg" name="content[]" value="'.$v->content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea type="text" class="sg" name="content[]">'.$v->content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启,0|关闭
                    $arr = explode(',',$v->field_value);
                    $str = '';
                    foreach($arr as $m=>$n){
                        //1|开启
                        $r = explode('|',$n);
                        $c = $v->content == $r[0] ? ' checked="checked" ' : '';
                        $str .= '<label for=""><input type="radio" name="content[]" value="'.$r[0].'"'.$c.' style="width: 13px">'.$r[1].'</label>';
                    }
                    $data[$k]->_html = $str;
                    break;
            }

        }
        return view('admin.config.index',compact('data'));
    }
	
	//修改配置内容
	public function changeContent(){
        $input = Input::all();
        foreach($input['id'] as $k=>$v){
            ConfigModel::where('id',$v)->update(['content'=>$input['content'][$k]]);
        }
        $this->putFile(); //更新配置文件内容
        return back()->with('errors','配置项更新成功！');
    }
	
	//写入生成配置文件
    public function putFile(){
        //使用方法： echo \Illuminate\Support\Facades\Config::get('web.web_title'); //文件web 配置键名 得到配置值
        $config = ConfigModel::pluck('content','title')->all(); //获取'content','name'字段的数据
        $path = base_path().'\config\web.php'; //获取路径
        $str = '<?php return '.var_export($config,true).';'; //将数组分解字符串
        file_put_contents($path,$str); //写入数据
    }

    //ajax 排序
    public function changeOrder(){
        $input = Input::all();
        $config = ConfigModel::find($input['id']);
        $config->orders = $input['orders'];
        $re = $config->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/config/create   添加配置
    public function create(){
        return view('admin/config/add');
    }

    //post.admin/config  添加配置提交
    public function store(){
        $input = Input::except('_token');
        $rules = [
            'name'=>'required',
            'title'=>'required',
        ];

        $message = [
            'name.required'=>'配置名称不能为空！',
            'title.required'=>'配置标题不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = ConfigModel::create($input);
            if($re){
                $this->putFile(); //更新配置文件内容
                return redirect('admin/config');
            }else{
                return back()->with('errors','配置失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/config/{config}/edit  编辑配置
    public function edit($id){
        $field = ConfigModel::find($id);
        return view('admin.config.edit',compact('field'));
    }

    //put.admin/config/{config}    更新配置
    public function update($id){
        $input = Input::except('_token','_method');
        $re = ConfigModel::where('id',$id)->update($input);
        if($re){
            $this->putFile(); //更新配置文件内容
            return redirect('admin/config');
        }else{
            return back()->with('errors','配置更新失败，请稍后重试！');
        }
    }

    //delete.admin/config/{Config}   删除配置
    public function destroy($id){
        $re = ConfigModel::where('id',$id)->delete();
        if($re){
            $this->putFile(); //更新配置文件内容
            $data = [
                'status' => 0,
                'msg' => '配置删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/config/{config}  显示单个配置信息
    public function show(){

    }
}