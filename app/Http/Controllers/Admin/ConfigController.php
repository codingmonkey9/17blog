<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Config;
use DB;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Config::paginate(10);
        $total = Config::count();
        
        foreach($configs as $k=>$v){
            //判断是什么标签
            switch($v['field_type']){
                case 'input':
                $v['conf_content'] = '<input type="text" name="conf_content[]" required value="'.$v['conf_content'].'" placeholder="请输入标题" autocomplete="off" class="layui-input">';
                break;
                case 'textarea':
                $v['conf_content'] = '<textarea name="conf_content[]" placeholder="请输入内容" class="layui-textarea">'.$v['conf_content'].'</textarea>';
                break;
                case 'radio':
                $arr = explode(',',$v['field_value']);
                $str = '';
                foreach($arr as $val){
                    $con = explode('|',$val);
                    if($con[0] == $v['conf_content']){
                        $str .= '<input type="radio" name="conf_content[]" value="'.$con[0].'" title="'.$con[1].'" checked>'.$con[1];
                    }else{
                        $str .= '<input type="radio" name="conf_content[]" value="'.$con[0].'" title="'.$con[1].'" >'.$con[1];
                    }
                }
                $v['conf_content'] = $str;
            }
        }
        return view('admin/config/list',compact('configs','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //网站配置为什么提交的时候，只会接收到两个字段，因为只有conf_content是表单，和隐藏提交的id是表单，其他的是表格
    //批量修改网站配置
    public function change(Request $request)
    {
        $input = $request->except('_token');
        //使用事务提交
        //开启事务
        DB::beginTransaction();
        try{
            foreach($input['conf_id'] as $k=>$v){
                DB::table('config')->where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
            }
            DB::commit();
            $this->write();
            return redirect('/config');
        }catch(Exception $e){
            DB::rollBack();
            return back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    //把网站配置项写入文件中
    //当数据库内容改变的时候就需要调用此方法把数据库相关数据再次写入配置文件*******
    //如果想要把网站配置应用到页面中，使用函数config()  比如 {{config('webconfig.web_title')}} 即可
    public function write()
    {
        //从数据库读取两个字段
        $contents  = Config::pluck('conf_content','conf_name')->all();
        //写入文件后的形式是数组，但是需要以字符串写入，所以需要拼接
        $str = '<?php return '.var_export($contents,true).';';
        //写入文件
        file_put_contents(config_path().'/webconfig.php', $str);
    }
}
