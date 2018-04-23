<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable=[
        'menu_name','menu_price','description','tips','menu_img','menuclass_id','goodsnews_id'
    ];
    public function menuclass(){
        return $this->belongsTo(MenuClass::class,'menuclass_id','id');
    }
    public function goodsnews(){
        return $this->belongsTo(Goodsnews::class,'goodsnews_id','id');
    }
}
