<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Goodsaccount extends Authenticatable
{
    //
    protected $fillable = [
        'name', 'email', 'password','logo','goods_class_id','goodsnews_id'
    ];
}
