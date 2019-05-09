<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Session;
use App\Model\Admin\User;
use App\Model\Admin\Role;
use App\Model\Admin\Permission;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //后台登录方法
    public function login()
    {
    	return view('admin/login');
    }

    //生成验证码
    public function code()
    {
    	$code = new Code;
    	return $code->make();
    }

    //验证后台登录表单数据
    public function store(Request $request)
    {
        //验证用户信息
    	$input = $request->except('_token');
    	// dd($input);
    	//定义验证规则
    	$rule = [
    		'username'=>"alpha_dash|between:5,13|required",
    		'password'=>'required|between:6,22|alpha_num',
    		'code'=>'required',
    	];
    	//验证错误时返回的信息
    	$msg = [
    		'username.required'=>'用户名不能为空',
    		'username.between'=>'用户名长度必须5-13位',
    		'username.alpha_dash'=>'用户名必须是字母数字下划线',
    		'password.required'=>'密码不能为空',
    		'password.between'=>'密码长度必须6-22位',
    		'password.alpha_num'=>'密码必须是字母和数字',
    		'code.required'=>'验证码不能为空',
    	];
    	//如果用validate验证，那么第一个参数必须是$request,不能是数组，如果用$input接收$request，$input是数组
    	//$request应该不是数组，可能是个对象
    	$this->validate($request,$rule,$msg);
    	//验证验证码(注：验证码在类中生成的时候就已经存储到session中，这里直接可以比较)
    	//忘记了session中存储的验证码是没有转换成小写的
    	$code = strtolower(session('code'));
    	// var_dump($code);
    	if($code != $input['code']){
    		return redirect('admin/login')->witherrors('验证码错误');
    	}
    	//查询数据库验证
    	$res = User::where('username',$input['username'])->first();
    	// dd($res);
    	//因为在注册的时候密码是经过加密的，所以需要先把密码加密或者解密，才能去查数据库
    	$pwd = Crypt::decrypt($res['password']);
    	// $pwd = $res['password'];
    	// echo '<pre>';
    	// var_dump($res['password']);
    	if($pwd != $input['password']){
    		return redirect('admin/login')->witherrors('密码错误');
    	}
    	//如果验证成功，那么把登陆信息存储到session中
    	session(['username'=>$input['username'],'password'=>$input['password']]);
        //调用rule方法查询用户权限
        $this->rule($input['username']);
    	return view('admin/index');
    }

    //后台首页
    public function index()
    {
    	return view('admin/index');
    }

    //后台首页iframe欢迎模板
    public function welcome()
    {
    	return view('admin/welcome');
    }

    //退出登录
    public function logout()
    {
    	//删除session中所有数据
    	session()->flush();
    	return redirect('admin/login');
    }

    /**
     * 查询用户具有的权限，存到session中,在登录的时候调用即可
     */
    public function rule($username)
    {
        //查询用户拥有的角色
        $user = User::where('username',$username)->first();
        //
        $arr = [];
        //遍历角色，按照每个角色查找拥有的权限
        foreach($user->role as $role){
            $pers = Role::where('role_name',$role->role_name)->first()->permission()->get();
            foreach($pers as $per){
                $arr[] = $per->per_url;
            }
        }
        //arr中存储的就是权限，不过因为不同的角色相互会有重复的权限，
        //所以需要去重，在存储到session中
        $arr = array_unique($arr);
        session()->put('rule',$arr);
        return ;
    }

    //没有权限页面
    public function noaccess()
    {
        return view('admin/noaccess');
    }
}
