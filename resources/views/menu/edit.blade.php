@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <form action="{{route('menu.update',['menu'=>$menu])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">菜品名称</label>
                <input type="text" name="goods_name" class="form-control" id="exampleInputEmail1" placeholder="菜品名称" value="{{$menu->goods_name}}">
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="exampleInputPassword1">评分</label>--}}
                {{--<input type="number" name="rating" class="form-control" id="exampleInputPassword1" placeholder="评分">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="exampleInputPassword1">菜品价格</label>
                <input type="number" name="goods_price" class="form-control" id="exampleInputPassword1" placeholder="菜品价格" value="{{$menu->goods_price}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">菜品描述</label>
                <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="菜品描述" value="{{$menu->description}}">
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="exampleInputPassword1">每月销售</label>--}}
                {{--<input type="number" name="month_sales" class="form-control" id="exampleInputPassword1" placeholder="每月销售">--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label for="exampleInputPassword1">评分记录</label>--}}
                {{--<input type="text" name="month_sales" class="form-control" id="exampleInputPassword1" placeholder="评分记录">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="exampleInputPassword1">菜品提示</label>
                <input type="text" name="tips" class="form-control" id="exampleInputPassword1" placeholder="菜品提示" value="{{$menu->tips}}">
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="exampleInputPassword1">满足记录</label>--}}
                {{--<input type="number" name="satisfy_count" class="form-control" id="exampleInputPassword1" placeholder="满足记录">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="exampleInputPassword1">图片</label>
                <input type="hidden" name="goods_img" class="form-control" id="menu_img">
            </div>
            <div class="form-group">
                <div id="uploader-demo">
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
                <img src="{{$menu->goods_img}}" alt="" id="img">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">菜品分类</label>
                <select name="menuclass_id" class="form-control">
                    @foreach($rows as $row)
                    <option value="{{$row->id}}" {{$menu->menuclass_id==$row->id?'selected="selected"':''}}>{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
            <button type="submit" class="btn btn-danger">修改</button>
        </form>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf:'/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            formData:{'_token':"{{csrf_token()}}"},
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on( 'uploadSuccess', function( file,response) {
            $("#img").attr('src',response.url);
            $("#menu_img").val(response.url);
        });
    </script>
@stop
