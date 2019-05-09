<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = new Cate;
        $cates = $cate->getTree();
        $total = Cate::count();
        return view('admin/cate/list',compact('cates','total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Cate::all();
        return view('admin/cate/add',compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $res = Cate::create($input);
        if($res){
            return redirect('/cate');
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
        //用户要修改的那条数据
        $cate = Cate::where('cate_id','=',$id)->first();
        //查询所有的为了显示分类供用户修改选择
        $cates = (new Cate)->getTree();
        return view('admin/cate/edit',compact('cate','cates'));
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
        $res = Cate::where('cate_id','=',$id)->update($input);
        if($res){
            return redirect('/cate');
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

    //分类排序
    public function order(Request $request,$id)
    {
        $input = $request->except('_token');
        $res = Cate::where('cate_id','=',$id)->update($input);
        if($res){
            $data = ['status'=>1,'msg'=>'修改排序成功'];
        }else{
            $data = ['status'=>0,'msg'=>'修改排序失败'];
        }
        return $data;
    }
}
