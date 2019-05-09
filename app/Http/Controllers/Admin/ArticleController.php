<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Article;
use App\Model\Admin\Cate;
use Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderby('art_id','asc')->paginate(10);
        $total = Article::count();
        return view('admin/article/list',compact('articles','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = (new Cate)->getTree();
        return view('admin/article/add',compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','pic');
        $res = Article::create($input);
        if($res){
            return redirect('/article');
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
        $article = Article::where('art_id','=',$id)->first();
        $cates = (new Cate)->getTree();
        return view('admin/article/edit',compact('cates','article'));
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
        $input = $request->except('_token','_method','pic');
        $res = Article::where('art_id','=',$id)->update($input);
        if($res){
            return redirect('/article');
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
        //
    }

    //添加文章时文件上传
    public function uploadFile(Request $request)
    {
        $file = $request->file('pic');
        if(!$file->isValid()){
            return response()->json(['ServerNo'=>400,'ResultData'=>'无效的上传文件']);
        }
        //获取源文件的扩展名
        $suffix = $file->getClientOriginalExtension();
        $newFile = md5(time().rand(1000,9999)).'.'.$suffix;
        $path = public_path('uploads');
        //将文件移动到指定目录
        $res = Image::make($file)->resize(100,100)->save($path.'/'.$newFile);
        if($res){
           //上传成功
            return response()->json(['ServerNo'=>200,'ResultData'=>$newFile]); 
        }else{
            return response()->json(['ServerNo'=>400,'ResultData'=>'上传失败']);
        }
        
        // if(!$file->move($path,$newfile)){
        //     //上传失败
        //     return response()->json(['ServerNo'=>400,'ResultData'=>'上传失败']);
        // }
        // return response()->json(['ServerNo'=>200,'ResultData'=>$newfile]);
    }

    //删除原文件
    public function delFile(Request $request)
    {
        // $input = $request->input('art_thumb');
        // $res = unlink($input);
        // if($res){
        //     $status = 1;
        // }else{
        //     $status = 0;
        // }
        // return $status;
    }
}
