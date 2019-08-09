<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\HomeUser;
use App\Model\Admin\Comment;
use Illuminate\Support\Facades\DB;
use Image;

class IndexController extends Controller
{
    //个人中心
    public function usercenter()
    {
    	//从数据库查询个人信息
    	$homeuser = session('homeuser');
    	//查询数据库是因为如果用户修改了信息，能够及时更新
    	$userInfo = HomeUser::where('user_id',$homeuser['user_id'])->first();
        //根据用户pro_id去查个人信息
        $profile = DB::table('profile')->where('id',$userInfo['pro_id'])->first();
    	return view('home.usercenter',['userInfo'=>$userInfo,'profile'=>$profile]);
    }

    //编辑用户个人信息
    public function useredit($id)
    {
    	// echo '个人信息修改页面'.$id;
    	// $userInfo = HomeUser::where('user_id',$id)->first();
        $profile = DB::table('profile')->where('id',$id)->first();
    	return view('home.useredit',['profile'=>$profile]);
    }

    //修改个人信息提交数据库
    public function userupdate(Request $request)
    {
    	$input = $request->except('_token','headpic');
        //数据库中爱好字段设置为not null，所以这里验证一下，用户不能不选择爱好
        if(empty($input['hobby'])){
            return back()->with('error','请选择爱好！！！');
        }
        //爱好是数组，需要处理成字符串才能存入数据库
        $input['hobby'] = implode(',',$input['hobby']);
        //万一用户填写年龄的时候，写小数，需要取整
        $input['age'] = round($input['age']);
        // dd($input);
    	// $res = HomeUser::where('user_id',$input['user_id'])->update($input);//homeuser表
        $res = DB::table('profile')->where('id',$input['id'])->update($input);
    	if($res){
    		return redirect('/usercenter')->with('success','修改成功');
    	}else{
    		return back()->with('error','修改失败');
    	}
    }

    //上传头像
    public function upload(Request $request)
    {
        $file = $request->file('headpic');
        var_dump($file);
        if(!$file->isValid()){
            return response()->json(['statusCode'=>400,'responseData'=>'上传文件不存在']);
        }
        //获取源文件扩展名
        $extension = $file->getClinetOriginalExtension();
        $newfile = md5(time().uniqid().rand(1000,9999)).'.'.$extension;
        $path = public_path('headpic');
        //将文件移动到指定目录
        $res = Image::make($file)->resize(80,80)->save($path.'/'.$newfile);
        if($res){
            return response()->json(['statusCode'=>200,'responseData'=>$newfile]);
        }else{
            return response()->json(['statusCode'=>400,'responseData'=>'上传失败']);
        }
    }

    //提交评论
    public function commentCreate(Request $request)
    {
        $input = $request->except('_token');
        if(empty($input['content'])){
            return false;
        }
        //整理数据添加到数据库
        $input['create_time'] = time();
        $res = Comment::create($input);
        if($res){
            $data = ['status'=>1];
        }else{
            $data = ['statis'=>0];
        }
        return $data;
    }
}
