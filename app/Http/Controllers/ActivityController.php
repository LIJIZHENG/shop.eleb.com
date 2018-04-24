<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    //

    public function index(){
//        $obj=Activity::all();
        $rows=DB::table('activities')->select()->get();
//        $rows=(object)null;
//        foreach ($obj as $value){
//            if(strtotime($value->end)>=strtotime(date('Y-m-d',time()))){
//                $rows=$value;
//            }
//        }
        return view('activity.index',compact('rows'));
    }
}
