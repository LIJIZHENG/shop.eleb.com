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
        return view('activity.index',compact('rows'));
    }
}
