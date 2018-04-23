<?php

namespace App\Http\Controllers;

use App\Goodsaccount;
use App\Goodsclass;
use App\Goodsnews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GoodsaccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create','store','login','check']
        ]);
    }
    //商家注册页面显示
    public function create(){
     $rows=Goodsclass::all();
     return view('goodsaccount.create',compact('rows'));
    }
    //商家注册验证
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'required',
            'email'=>'required|email|unique:goodsaccounts',
            'logo'=>'required|image',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'estimate_time'=>'required',
        ],[
            'name.required'=>'商家名称不能为空!',
            'name.min'=>'商家名称不能大于2!',
            'password'=>'密码不能为空!',
            'email.required'=>'邮箱不能为空!',
            'email.unique'=>'邮箱必需唯一!',
            'email.email'=>'邮箱格式不对!',
            'logo.required'=>'图片不能为空!',
            'logo.image'=>'图片有错!',
            'brand.required'=>'品牌不能为空!',
            'on_time.required'=>'准时送达不能为空!',
            'fengniao.required'=>'是否蜂鸟配送不能为空!',
            'bao.required'=>'是否保标记不能为空!',
            'piao.required'=>'是否票标记不能为空!',
            'zhun.required'=>'是否准标记不能为空!',
            'start_send.required'=>'起送金额不能为空!',
            'send_cost.required'=>'配送费不能为空!',
            'estimate_time.required'=>'预计时间不能为空!',
        ]);
        DB::transaction(function ()use($request) {
            $fileName=$request->file('logo')->store('public/logo');
//            var_dump(url(Storage::url($fileName)));die;
            $client = App::make('aliyun-oss');
            try{
                $client->uploadFile(getenv('OSS_BUCKET'), $fileName, storage_path('app/'.$fileName));
            } catch(OssException $e) {
                printf($e->getMessage() . "\n");
                return;
            }
            $add=Goodsnews::create([
                'shop_name'=>$request->name,
                'shop_img'=>'https://lijizheng-laravel.oss-cn-beijing.aliyuncs.com/'.$fileName,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'estimate_time'=>$request->estimate_time,
                'notice'=>$request->notice,
                'discount'=>$request->discount
            ]);
//            var_dump($add->id);die;
            Goodsaccount::create([
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
                'logo'=>url(Storage::url($fileName)),
                'goods_class_id'=>$request->goods_class_id,
                'goodsnews_id'=>$add->id
            ]);
        });
        session()->flash('success','商家注册成功!');
        return redirect()->route('login');
    }
    //登录
    public function login(){
      return view('goodsaccount.login');
    }
    public function check(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ],[]);
            if(Auth::attempt(['name'=>$request->name,'password'=>$request->password,'is_by'=>1],$request->has('remember'))){
                session()->flash('登录成功!');
                return redirect()->route('goodsaccount.create');
            }else{
                session()->flash('登录失败!');
                return redirect()->route('login');
            }
        }
    //突出
    public function logut(){
        Auth::logout();
        session()->flash('success','退出成功!');
        return redirect()->route('login');
    }
    //修改密码
    public function revise(Request $request){
        if($_SERVER['REQUEST_METHOD']=='POST'){
          $this->validate($request,[
              'newPwd'=>'required|confirmed',
          ],[
          ]);
          if (!Hash::check($request->password,Auth::user()->password)){
              session()->flash('success','新旧密码不一致!');
              return redirect()->route('revise');
          }else{
              $newPwd=bcrypt($request->newPwd);
              $id=Auth::user()->id;
               DB::update("update goodsaccounts set password='{$newPwd}' where id={$id}");
               Auth::logout();
              session()->flash('success','修改密码成功!');
              return redirect()->route('login');
          }
        }else{
            return view('goodsaccount.revise');
        }
    }
}
