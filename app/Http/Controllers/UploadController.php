<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UploadController extends Controller
{
    //
    public function upload(Request $request){
        $fileName=$request->file('file')->store('public/logo');
        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile(getenv('OSS_BUCKET'), $fileName, storage_path('app/'.$fileName));
            $url=['url'=>'https://lijizheng-laravel.oss-cn-beijing.aliyuncs.com/'.$fileName];
            return $url;
        } catch(OssException $e) {
            printf($e->getMessage() . "\n");
            return;
        }
    }
}
