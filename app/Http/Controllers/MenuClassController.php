<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuClassController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }
    public function index(){
              if(Auth::user()){
                  $row=DB::table('menus')
                      ->where('goodsnews_id', '=',Auth::user()->goodsnews_id)
                      ->first();
                  $rows=MenuClass::all()->where('id','=',$row->menuclass_id);
                  return view('menuclass.index',compact('rows'));
              }else{
                   session()->flash('success','请登录!');
                   return redirect()->route('login');
              }
    }
    public function create(){
        return view('menuclass.create');
    }
    public function store(Request $request){
//        var_dump($request->name);die;
        $this->validate($request,[
            'name'=>'required|min:2',
            'description'=>'required|min:5',
        ],[
            'name.required'=>'菜品分类名称不能为空!',
            'name.min'=>'菜品分类名称不能小于2!',
            'description.required'=>'菜品分类描述不能为空!',
            'description.min'=>'菜品分类长度不能小于5'
        ]);
        MenuClass::create(['name'=>$request->name,'description'=>$request->description,'type_accumulation'=>$request->type_accumulation,'is_selected'=>$request->is_selected]);
        session()->flash('success','添加成功!');
        return redirect()->route('menuclass.index');
    }
    public function edit(MenuClass $menuclass){
        return view('menuclass.edit',compact('menuclass'));
    }
    public function update(Request $request,MenuClass $menuclass){
        $this->validate($request,[
            'name'=>'required|min:2',
            'description'=>'required|min:5',
        ],[
            'name.required'=>'菜品分类名称不能为空!',
            'name.min'=>'菜品分类名称不能小于2!',
            'description.required'=>'菜品分类描述不能为空!',
            'description.min'=>'菜品分类长度不能小于5'
        ]);
        $menuclass->update(['name'=>$request->name,'description'=>$request->description,'type_accumulation'=>$request->type_accumulation,'is_selected'=>$request->is_selected]);
        session()->flash('success','修改成功!');
        return redirect()->route('menuclass.index');
    }
    public function destroy(MenuClass $menuclass){
            $menuclass->delete();
            echo 'success';
    }
}
