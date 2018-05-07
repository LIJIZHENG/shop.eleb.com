<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuClass extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'is_selected','type_accumulation','goodsnews_id'
    ];
}
