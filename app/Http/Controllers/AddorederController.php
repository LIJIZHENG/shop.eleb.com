<?php

namespace App\Http\Controllers;

use App\Addoreder;
use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddorederController extends Controller
{
    //
    public function index(){
        $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
        $rows=DB::table('addoreders')->where('shop_id','=',$goodsnews->goodsnews_id)->get();
        foreach ($rows as $row){
            $val=DB::table('ints')->where('order_id','=',$row->id)->first();
            $row->ints=$val;
        }
        return view('addoreder.index',compact('rows'));
    }
    public function orders(Request $request){
        DB::table('addoreders')
            ->where('id',$request->id)
            ->update(['order_status' => '已完成']);
        $row=DB::table('addoreders')->where('id',$request->id)->first();
        $tel=$row->tel;
       $sms=SmsController::sms($tel);
       if ($sms){
           session()->flash('success','下单成功短信已发送!');
       }else{
           session()->flash('success','下单失败!');
       }
        return redirect()->route('addoreder.index');
    }
    public function recall(Request $request){
        DB::table('addoreders')
            ->where('id',$request->id)
            ->update(['order_status' => '取消订单']);
        session()->flash('success','订单取消成功!');
        return redirect()->route('addoreder.index');
    }
    public function restore(Request $request){
        DB::table('addoreders')
            ->where('id',$request->id)
            ->update(['order_status' => '代付款']);
        session()->flash('success','订单恢复成功!');
        return redirect()->route('addoreder.index');
    }
    public function amount(Request $request){
        $f="count(*)";
        $time=date('Y-m-d H:i:s',strtotime($request->time));
        $time1=date('Y-m-d 23:59:59',strtotime($request->time));
        if($request->time){
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
           $a=DB::select("select count(*) from addoreders where shop_id=? AND order_birth_time>=? AND order_birth_time<=?",[$goodsnews->goodsnews_id,$time,$time1]);
        }else{
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
            $a=DB::select("select count(*) from addoreders where shop_id=? AND order_birth_time=?",[$goodsnews->goodsnews_id,date('Y-m-d H:i:s',strtotime(time()))]);
        }
        if($request->month){
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
            $month=date("Y-m-d H:i:s",strtotime($request->month));
           $month1=date('Y-m-d 23:59:59', strtotime("$month+1month -1 day"));
            $r=DB::select("select count(*) from addoreders WHERE shop_id=? AND order_birth_time>=? AND order_birth_time<=?",[$goodsnews->goodsnews_id,$month,$month1]);
        }else{
            $month=date('Y-m-t H:i:s', strtotime('-1 month'));
            $month1=date('Y-m-t 23:59:59', strtotime('0 month'));
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
            $r=DB::select("select count(*) from addoreders WHERE shop_id=? AND order_birth_time>=? AND order_birth_time<=?",[$goodsnews->goodsnews_id,$month,$month1]);
        }
        $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
        $zong=DB::select("select count(*) from addoreders WHERE shop_id=?",[$goodsnews->goodsnews_id]);
//        dd($zong);
        return view('addoreder.amount',['a'=>$a,'f'=>$f,'r'=>$r,'zong'=>$zong]);
    }
    public function dishes(Request $request){
        if($request->time){
            $time=date('Y-m-d H:i:s',strtotime($request->time));
            $time1=date('Y-m-d 23:59:59',strtotime($request->time));
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
//            $addoreders=DB::table('addoreders')->where('shop_id','=',$goodsnews->goodsnews_id)->get();
//            $t=[];
//            foreach ($addoreders as $addoreder){
//                $a=DB::select("select * from ints where order_id=? AND created_at>=? AND created_at<=?",[$addoreder->id,$time,$time1]);
//               foreach ($a as $o){
//                   $t[]=$o;
//               }
//            }
            $t=DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',$time],['ints.created_at','<=',$time1],['addoreders.shop_id','=',$goodsnews->goodsnews_id]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
        }else{
            $t=[];
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
//            $addoreders=DB::table('addoreders')->where('shop_id','=',$goodsnews->goodsnews_id)->get();
            $t=DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',date('Y-m-d 00:00:00',time())],['ints.created_at','<=',date('Y-m-d 23:59:59',time())],['addoreders.shop_id','=',$goodsnews->goodsnews_id]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
//            foreach ($addoreders as $addoreder){
//                $a=DB::select("select * from ints where order_id=? AND created_at>=? AND created_at<=?",[$addoreder->id,date('Y-m-d 00:00:00',time()),date('Y-m-d 23:59:59',time())]);
//                foreach ($a as $o){
//                    $t[]=$o;
//                }
//            }
        }
        if($request->month){
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
//            $addoreders=DB::table('addoreders')->where('shop_id','=',$goodsnews->goodsnews_id)->get();
            $month=date("Y-m-d H:i:s",strtotime($request->month));
            $month1=date('Y-m-d 23:59:59', strtotime("$month+1month -1 day"));
            $p=DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',$month],['ints.created_at','<=',$month1],['addoreders.shop_id','=',$goodsnews->goodsnews_id]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
//            $p=[];
//            foreach ($addoreders as $addoreder){
//                $r=DB::select("select * from ints WHERE order_id=? AND created_at>=? AND created_at<=?",[$addoreder->id,$month,$month1]);
//                foreach ($r as $q){
//                    $p[]=$q;
//                }
//            }

        }else{
            $month=date('Y-m-t H:i:s', strtotime('-1 month'));
            $month1=date('Y-m-t 23:59:59', strtotime('0 month'));
            $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
            $p=DB::table('ints')
                ->join('addoreders','ints.order_id','=','addoreders.id')
                ->join('goodsnews','addoreders.id','=','goodsnews.id')
                ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
                ->where([['ints.created_at','>=',$month],['ints.created_at','<=',$month1],['addoreders.shop_id','=',$goodsnews->goodsnews_id]])
                ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
                ->orderBy('amounts','desc')
                ->get();
//            $addoreders=DB::table('addoreders')->where('shop_id','=',$goodsnews->goodsnews_id)->get();
//            $p=[];
//            foreach ($addoreders as $addoreder){
//                $r=DB::select("select * from ints WHERE order_id=? AND created_at>=? AND created_at<=?",[$addoreder->id,$month,$month1]);
//                foreach ($r as $q){
//                    $p[]=$q;
//                }
//            }

        }
//        $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
        $goodsnews = DB::table('goodsaccounts')->where('id','=',Auth::user()->id)->first();
        $zon=DB::table('ints')
            ->join('addoreders','ints.order_id','=','addoreders.id')
            ->join('goodsnews','addoreders.id','=','goodsnews.id')
            ->select('goodsnews.shop_name','addoreders.shop_id','ints.goods_name','ints.goods_id',DB::raw('sum(ints.amount) as amounts'))
            ->where([['addoreders.shop_id','=',$goodsnews->goodsnews_id]])
            ->groupBy('goodsnews.shop_name','addoreders.shop_id','ints.goods_id','ints.goods_name')
            ->orderBy('amounts','desc')
            ->get();
//        $addoreders=DB::table('addoreders')->where('shop_id','=',$goodsnews->goodsnews_id)->get();
//        $zon=[];
//        foreach ($addoreders as $addoreder){
//            $zong=DB::select("select * from ints WHERE order_id=?",[$addoreder->id]);
//            foreach ($zong as $z){
//                $zon[]=$z;
//            }
//        }
//        dd($zon);
        return view('addoreder.dishes',['t'=>$t,'p'=>$p,'zon'=>$zon]);
    }
}
