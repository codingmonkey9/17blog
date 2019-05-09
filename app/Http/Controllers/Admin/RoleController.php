<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Role;
use App\Model\Admin\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::paginate(5);
        $total = Role::count();
        return view('admin/role/list',compact('role','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/role/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input('role_name');
        $res = Role::create(['role_name'=>$input]);
        if($res){
            return redirect('/role');
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
        //当前选择的角色名
        $roles = Role::find($id);
        //当前角色拥有的权限
        $pers = $roles->permission;
        //全部权限
        $allpers = Permission::all();
        //把当前角色拥有的权限遍历,只把ID传到修改页面
        $arr = [];
        foreach($pers as $v){
            $arr[] = $v['id'];
        }
        return view('admin/role/role_per',compact('roles','allpers','arr'));
    }

    //
    public function access(Request $request)
    {
        //不要忘记隐藏传输role id
        $input = $request->except('_token');
        // dd($input);
        //还是先删除原有的数据，再插入
        DB::table('role_permission')->where('role_id','=',$input['role_id'])->delete();
        //判断per_id是否为空，避免报错
        if(!empty($input['per_id'])){
            foreach($input['per_id'] as $v){
                DB::table('role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$v]);
            }
        }
        return redirect('/role');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        // dd($role);
        return view('admin/role/edit',compact('role'));
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
        $role = Role::find($id);
        $role['role_name'] = $input['role_name'];
        $res = $role->save();
        if($res){
            return redirect('/role');
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
        $res = Role::destroy($id);
        if($res){
            $data = ['status'=>1,'msg'=>'删除成功'];
        }else{
            $data = ['status'=>0,'msg'=>'删除失败'];
        }
        return $data;
    }
}
