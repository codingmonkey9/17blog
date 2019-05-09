<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;
use App\Model\Admin\Article;
use App\Model\Admin\Comment;
use App\Model\Admin\Collect;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Model\HomeUser;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
	//前台登录
    public function login()
    {
    	return view('home.login');
    }

    public function doLogin(Request $request)
    {
        $input = $request->except('_token');
        //判断用户是否之前勾选了记住密码
        // if(isset($input['rememberme'])){
        //     //记住密码
        //     $timeout = time()+3600*24*30; //过期时间
        //     setcookie('user_name',$input['user_name'],$timeout);
        //     setcookie('user_pass',$input['user_pass'],$timeout);
        // }else{
        //     //没有勾选记住密码
        //     setcookie('user_name','',time()-1);
        //     setcookie('user_pass','',time()-1);
        // }

        //查询数据库是否有此用户，并且要激活了才能登录
        $user = HomeUser::where([['user_name',$input['user_name']],['active',1]])->first();
        if(empty($user)){
            return redirect('/home/login')->with('msg','用戶名不存在');
        }
        $password = Crypt::decrypt($user['user_pass']);
        if($password != $input['user_pass']){
            return redirect('/home/login')->with('msg','密碼錯誤');
        }
        //把信息存到session
        session()->put('homeuser',$user);
        return redirect('/home/index');
    }

    //前台首页
    public function index()
    {
    	$cate_arts = Cate::where('cate_pid','<>',0)->with('article')->get();
    	return view('home/index',compact('cate_arts'));
    }

    //前台列表页
    public function list($id)
    {
    	$cate = DB::table('category')->where('cate_id', '=', $id)->get();
    	// dd($cate);
    	$cateid = $cate[0]->cate_id;
    	$catename = $cate[0]->cate_name;
    	//这个id是文章的分类id,查询分类ID是这个ID的文章
    	$arts = Article::where('cate_id','=',$id)->paginate(8);
    	return view('home.lists',compact('arts','cateid','catename'));
    }

    //前台详情页
    public function detail($id)
    {
    	//根据ID查询指定文章
    	$art = Article::where('art_id',$id)->get();
    	// dd($art);
    	$art = $art[0];
    	//查询上一篇文章
    	$pre = Article::where('art_id','<',$id)->orderby('art_id','desc')->first();
    	//查询下一篇
    	$next = Article::where('art_id','>',$id)->orderby('art_id','asc')->first();
    	//没查询一次代表浏览一次，浏览次数加1 
    	DB::table('article')->where('art_id',$id)->increment('art_view');
    	  // 相关文章
        $similar = Article::where('cate_id',$art->cate_id)->take(4)->get();
        // 文章评论
        $comment = Comment::where('post_id',$art->art_id)->get();
        //发表文章距离当前时间
        $time = (time()-$art->art_time);
        //查询文章是否已被收藏
        $uid = session()->get('homeuser')->user_id;
        $res = Collect::where([['uid',$uid],['art_id',$art->art_id]])->first();
    	return view('home/detail',compact('art','pre','next','similar','comment','time','res'));
    }

    //收藏
    public function collect(Request $request)
    {
    	$act = $request->input('act');
    	$uid = $request->input('uid');
    	$artid = $request->input('artid');
    	
    	// dd($collect);
    	switch($act){
    		//添加收藏操作
    		case 'add':
    		$collect = Collect::where([['art_id','=',$artid],['uid','=',$uid]])->first();
    			if(!empty($collect)){
    				//說明已經收藏過
    				$data = ['status'=>1,'msg'=>'已收藏'];
    				return $data;
    			}else{
    				//說明未收藏
    				$res = Collect::create(['uid'=>$uid,'art_id'=>$artid]);
    				if($res){
    					//添加收藏記錄成功，在文章表中將收藏人數加1
    					Article::where('art_id','=',$artid)->increment('art_collect');
    					$data = ['status'=>6,'msg'=>'已收藏'];
    					return $data;
    				}else{
    					$data = ['status'=>0,'msg'=>'收藏失敗'];
    					return $data;
    				}
    			}
    		break;
    		case 'remove':
    		$collect = Collect::where([['art_id','=',$artid],['uid','=',$uid]])->first();
    			if(!empty($collect)){
    				//說明已經收藏過
    				$res = Collect::where([['uid','=',$uid],['art_id','=',$artid]])->delete();
    				if($res){
    					//取消收藏成功，在文章表中將收藏人數減1
    					Article::where('art_id','=',$artid)->decrement('art_collect');
    					$data = ['status'=>6,'msg'=>'點擊收藏'];
    					return $data;
    				}else{
    					$data = ['status'=>0,'msg'=>'取消收藏失敗'];
    					return $data;
    				}
    			}else{
    				$data = ['status'=>1,'msg'=>'點擊收藏'];
    				return $data;
    			}
    		break;
    	}
    }

    //郵箱註冊頁面
    public function emailRegister()
    {
        return view('home/emailregister');
    }

    //發送郵件
    public function email(Request $request)
    {
        $input = $request->except('_token');
        //先判断此邮箱是否已经注册并激活
        $u = HomeUser::where([['user_name',$input['user_name']],['active',1]])->first();
        // dd($u);
        if(!empty($u)){
            //根据active判断是否已经激活账号
            //说明已经激活
            return redirect('/home/login')->with('msg','该账号已激活可以直接登录');
        }
        //处理数据存到数据库
        $input['user_pass'] = Crypt::encrypt($input['user_pass']);
        $input['email'] = $input['user_name'];
        $input['token'] = md5(time().$input['email']);
        $input['expire'] = time()+3600*24;
        $user = HomeUser::create($input);
        if($user){
            Mail::send('email.active',['user'=>$user],function($msg)use($user){
                $msg->to($user->email,$user->name)->subject('激活邮箱');
            });
            return redirect('/home/login')->with('msg','请登录邮箱激活账号');
        }else{
            return redirect('/emailregister');
        }
    }

    //激活账号
    public function active(Request $request)
    {

        $user_id = $request->userid;
        $user = HomeUser::where('user_id', '=', $user_id)->firstOrFail();
        //验证token，确认是通过邮箱过来的
        if($request->token != $user->token){
            return '当前链接非有效链接，请确保您是通过邮箱激活链接激活的';
        }
        //判断激活时间是否还有效
        if(time() > $user->expire){
            return '激活时间已过，请重新注册';
        }
        //要激活的用户对应的active设置为1代表激活
        $res = $user->update(['active'=>1]);
        if($res){
            //激活成功
            return redirect('home/login')->with('msg','账号激活成功');
        }else{
            return '账号激活失败，请检查激活链接或重新注册';
        }
    }

    //退出登录
    public function logout()
    {
        //清空session
        session()->forget('homeuser');
        return redirect('/home/login');
    }
}
