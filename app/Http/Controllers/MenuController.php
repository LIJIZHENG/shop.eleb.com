<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index']
        ]);
    }
    public function index(){
        if(Auth::user()){
            $rows = Menu::all()->where('goodsnews_id','=',Auth::user()->goodsnews_id);
            return view('menu.index',compact('rows'));
        }else{
            session()->flash('success','请登录!');
            return redirect()->route('login');
        }
    }
    public function create(){
        $rows=MenuClass::all();
        return view('menu.create',compact('rows'));
    }
    public function store(Request $request){
      $this->validate($request,[
          'menu_name'=>'required|min:2',
          'menu_price'=>'required',
          'description'=>'required|min:5',
          'tips'=>'required|min:5',
          'menu_img'=>'required|image',
      ],[
          'menu_name.required'=>'菜品名称不能为空!',
          'menu_name.min'=>'菜品名称长度必须大于2位!',
          'menu_price.required'=>'菜品价格不能为空!',
          'description.required'=>'菜品描述不能为空!',
          'description.min'=>'菜品描述长度必须大于5!',
          'tips.required'=>'菜品提示不能为空!',
          'tips.min'=>'菜品提示不能小于五位!',
          'menu_img.required'=>'图片不能为空!',
          'menu_img.image'=>'图片格式不对!'
      ]);
      $fileName=$request->file('menu_img')->store('public/logo');
        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile(getenv('OSS_BUCKET'), $fileName, storage_path('app/'.$fileName));
        } catch(OssException $e) {
            printf($e->getMessage() . "\n");
            return;
        }
      Menu::create(['menu_name'=>$request->menu_name,'menu_price'=>$request->menu_price,'description'=>$request->description,'tips'=>$request->tips,'menu_img'=>'https://lijizheng-laravel.oss-cn-beijing.aliyuncs.com/'.$fileName,'menuclass_id'=>$request->menuclass_id,'goodsnews_id'=>Auth::user()->goodsnews_id]);
      session()->flash('success','添加成功!');
      return redirect()->route('menu.index');
    }
    public function edit(Menu $menu){
        $rows=MenuClass::all();
        return view('menu.edit',compact('menu','rows'));
    }
    public function update(Request $request,Menu $menu){
        $this->validate($request,[
            'menu_name'=>'required|min:2',
            'menu_price'=>'required',
            'description'=>'required|min:5',
            'tips'=>'required|min:5',
        ],[
            'menu_name.required'=>'菜品名称不能为空!',
            'menu_name.min'=>'菜品名称长度必须大于2位!',
            'menu_price.required'=>'菜品价格不能为空!',
            'description.required'=>'菜品描述不能为空!',
            'description.min'=>'菜品描述长度必须大于5!',
            'tips.required'=>'菜品提示不能为空!',
            'tips.min'=>'菜品提示不能小于五位!'
        ]);
        if ($request->menu_img){
            $fileName=$request->file('menu_img')->store('public/logo');
            $client = App::make('aliyun-oss');
            try{
                $client->uploadFile(getenv('OSS_BUCKET'), $fileName, storage_path('app/'.$fileName));
            } catch(OssException $e) {
                printf($e->getMessage() . "\n");
                return;
            }
            $menu->update(['menu_name'=>$request->menu_name,'menu_price'=>$request->menu_price,'description'=>$request->description,'tips'=>$request->tips,'menu_img'=>'https://lijizheng-laravel.oss-cn-beijing.aliyuncs.com/'.$fileName,'menuclass_id'=>$request->menuclass_id,'goodsnews_id'=>Auth::user()->goodsnews_id]);
            session()->flash('success','修改成功!');
            return redirect()->route('menu.index');
        }else{
            $menu->update(['menu_name'=>$request->menu_name,'menu_price'=>$request->menu_price,'description'=>$request->description,'tips'=>$request->tips,'menuclass_id'=>$request->menuclass_id,'goodsnews_id'=>Auth::user()->goodsnews_id]);
            session()->flash('success','修改成功!');
            return redirect()->route('menu.index');
        }
    }
    public function destroy(Menu $menu){
        $menu->delete();
        echo 'success';
    }
}
