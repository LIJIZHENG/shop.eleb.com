<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    //

    public function index(){
        $rows=Activity::all();
        return view('activity.index',compact('rows'));
    }
    public function show(Activity $activity){
        $row=Activity::find($activity->id);
        return view('activity.show',compact('row'));
    }
}
