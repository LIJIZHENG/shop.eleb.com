<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //
    public function index(){
        $rows=Event::all();
        return view('event.index',compact('rows'));
    }

    public function show(Event $event){
        return view('event.show',compact('event'));
    }

    public function create(Request $request){
        $time=time();
       $events=DB::table('events')->where('id','=',$request->id)->first();
        if($events->signup_num){
            if(date("Y-m-d",$events->signup_start)>=date("Y-m-d",$time)) {
                $users = DB::table('event_members')->where([['member_id', '=', Auth::user()->id],['events_id','=',$request->id]])->first();
                if (empty($users)) {
                    DB::table('event_members')->insert(
                        ['events_id' => $request->id, 'member_id' => Auth::user()->id]
                    );
                    $num=$events->signup_num-1;
                    DB::table('events')
                        ->where('id','=',$request->id)
                        ->update(['signup_num' =>$num]);
                    session()->flash('success', '报名成功!');
                } else {
                    session()->flash('success', '该活动你已报名!');
                }
            }else{
                session()->flash('success', '该活动报名时间已结束!');
            }
        }else{
            session()->flash('success', '活动报名人数已满!');
        }

        return redirect()->route('event.index');
    }

    public function start(){
       $rows=DB::table('results')->where('member_id', '=',Auth::user()->id)->get();
       $b=[];
       foreach ($rows as $row){
           $enevt_prizes=DB::table('enevt_prizes')->where('id', '=',$row->events_id)->first();
           $enevts=DB::table('events')->where('id', '=',$enevt_prizes->events_id)->first();
           $enevt_prizes->enevts=$enevts;
           $b[]=$enevt_prizes;
       }

        return view('event.start',compact('b'));
    }

    public function lottery(){
        $rows=DB::table('results')->select('id','events_id','member_id')->get();;
        $b=[];
        foreach ($rows as $row){
            $goodsaccounts=DB::table('goodsaccounts')->where('id', '=',$row->member_id)->first();
            $enevt_prizes=DB::table('enevt_prizes')->where('id', '=',$row->events_id)->first();
            $enevts=DB::table('events')->where('id', '=',$enevt_prizes->events_id)->first();
            $enevt_prizes->enevts=$enevts;
            $enevt_prizes->goodsaccounts=$goodsaccounts;
            $b[]=$enevt_prizes;
        }
        return view('event.lottery',compact('b'));
    }
}
