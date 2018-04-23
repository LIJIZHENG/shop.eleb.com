<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goodsnews extends Model
{
    protected $fillable = [
        'shop_name', 'shop_img','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','estimate_time','notice','discount'
    ];
}
