<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//路由组必须登录并且有权限的
Route::group(['middleware'=>['adminLogin','rule']],function(){
	
	
});

//这个必须登录不需要有权限的
Route::group(['middleware' => 'adminLogin'],function(){
	//退出登录路由
	Route::get('admin/logout','Admin\LoginController@logout');
});

//后台首页路由
Route::get('admin/index','Admin\LoginController@index');
//后台首页欢迎模板路由
Route::get('admin/welcome','Admin\LoginController@welcome');
//后台登录路由
Route::get('admin/login','Admin\LoginController@login');
//验证码路由
Route::get('admin/code','Admin\LoginController@code');
//处理验证表单数据路由
Route::post('admin/store','Admin\LoginController@store');
//没有权限页面
Route::get('admin/noaccess','Admin\LoginController@noaccess');


//后台用户列表页路由
Route::resource('user','Admin\UserController');
//用户授予角色路由
Route::post('user/access','Admin\UserController@access');
//角色路由
Route::resource('role','Admin\RoleController');
//权限路由
Route::resource('per','Admin\PermissionController');
//分类排序路由
Route::post('cate/order/{id}','Admin\CateController@order');
//分类路由
Route::resource('cate','Admin\CateController');
//添加时文件上传路由
Route::post('article/upload','Admin\ArticleController@uploadFile');
//修改文章时删除文件路由
Route::post('article/delFile','Admin\ArticleController@delFile');
//文章模块路由
Route::resource('article','Admin\ArticleController');
//批量修改网站配置路由
Route::post('config/change','Admin\ConfigController@change');
//网站配置路由
Route::resource('config','Admin\ConfigController');


//前台登录中间件
Route::group(['middleware'=>'homeLogin'],function(){
	//退出登录路由
	Route::get('loginout','Home\LoginController@logout');
	//个人中心信息
	Route::get('usercenter','Home\IndexController@usercenter');
	//编辑个人中心信息
	Route::get('useredit/{id}','Home\IndexController@useredit');
	//修改个人中心信息
	Route::post('userupdate','Home\IndexController@userupdate');
	//收藏文章路由
	Route::post('collect','Home\LoginController@collect');
	//前台首页路由
	Route::get('/home/index','Home\LoginController@index');
	//前台列表页
	Route::get('lists/{id}','Home\LoginController@list');
	//前台详情页
	Route::get('detail/{id}','Home\LoginController@detail');
	//提交评论,发表和回复都只用这一个控制器足矣
	Route::post('comment','Home\IndexController@commentCreate');
	//上传头像
	Route::post('usercenter/upload','Home\IndexController@upload');
});


//前台登录路由
Route::get('home/login','Home\LoginController@login');
//處理登錄信息路由
Route::post('dologin','Home\LoginController@doLogin');

//發送QQ郵件路由
Route::post('email','Home\LoginController@email');
//郵件註册路由
Route::get('emailregister','Home\LoginController@emailRegister');
//激活邮箱路由
Route::get('active','Home\LoginController@active');
//忘记密码
Route::get('forget','Home\LoginController@forget');
Route::post('editpwd','Home\LoginController@editpwd');
Route::get('editpassword','Home\LoginController@editpassword');
Route::post('updatepwd','Home\LoginController@updatepwd');