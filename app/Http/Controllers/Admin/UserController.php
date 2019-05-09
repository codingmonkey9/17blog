<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use App\Model\Admin\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**  闭包没弄明白
         * 这里需要注意的是访问index方法只能是get方式，所以在表单提交method要设置成get，不能使用post
         */
        // $input = $request->all();
        //查询数据库遍历数据 闭包没弄明白   use()里的参数必须是$request为什么?我试了$input不行的
        $users = User::orderBy('id','asc')->where(function($query) use($request){
            //这里的input后面是括号不能用[]********************************************************************
            $username = $request->input('username');
            $email = $request->input('email');
            if(!empty($username)){
                $query->where('username','like','%'.$username.'%');
            }
            if(!empty($email)){
                $query->where('email','like','%'.$email.'%');
            }
        })->paginate($request->input('num')?$request->input('num'):3);
        //查询用户表总共多少条数据
        $total = DB::table('user')->count();
        // dd($user[0]['username']);
        //后台用户列表页
        return view('admin/user/list',compact('users','total','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加用户页面
        return view('admin/user/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','repass');
        //密码加密
        $input['password'] = Crypt::encrypt($input['password']);
        $res = User::create($input);
        if($res){
            return redirect('/user');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //获取所有的角色名
        $allroles = Role::all();
        $user = User::find($id);
        //获取指定用户的角色名
        $r = $user->role;
        //遍历角色存到数组中，为了显示用户拥有哪些角色作对比
        $roles = [];
        foreach($r as $v){
            $roles[] = $v->id;
        }
        return view('admin/user/user_role',compact('user','roles','allroles'));
    }

    //处理用户授权
    public function access(Request $request)
    {
        $input = $request->except('_token');
        //表单页面需要隐藏传输一个用户ID
        //为避免一个用户拥有的角色重复，在插入数据之前先要删除原有数据
        DB::table('user_role')->where('user_id','=',$input['user_id'])->delete();
        if(!empty($input['role_id'])){
            foreach($input['role_id'] as $v){
                DB::table('user_role')->insert(['user_id'=>$input['user_id'],'role_id'=>$v]);
            } 
        }
        return redirect('/user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin/user/edit',['user'=>$user]);
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
        $input = $request->except('_token','_method');
        $res = User::where('id','=',$id)->update($input);
        if($res){
            return redirect('/user');
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = User::destroy($id);
        if($res){
            $data=['a'=>1,'msg'=>'删除成功'];
        }else{
            $data=['a'=>0,'msg'=>'删除失败'];
        }
        return $data;
    }
}
