@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
            <form action="{{route('goodsaccount.store')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">商家名称</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="商家名称" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密码</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="密码">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">邮箱</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="邮箱" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">商品分类</label>
                    <select name="goods_class_id" class="form-control">
                        @foreach($rows as $row)
                            <option value="{{$row['id']}}" {{old('class_id')==$row['id']?'selected="selected"':''}}>{{$row['goods_class_name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">商家图片</label>
                    <input type="file" id="exampleInputFile" name="logo">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">是否是品牌</label>
                    <input type="radio" name="brand" {{old('brand')==1?'checked':''}} value="1">是/否
                    <input type="radio" name="brand" {{old('brand')==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                    <label for="exampleInputPassword1">是否准时送达</label>
                    <input type="radio" name="on_time" {{old('on_time')==1?'checked':''}} value="1">是/否
                    <input type="radio" name="on_time" {{old('on_time')==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                    <label for="exampleInputPassword1">是否是蜂鸟配送</label>
                    <input type="radio" name="fengniao" {{old('fengniao')==1?'checked':''}} value="1">是/否
                    <input type="radio" name="fengniao" {{old('fengniao')==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                    <label for="exampleInputPassword1">是否保标记</label>
                    <input type="radio" name="bao" {{old('bao')==1?'checked':''}} value="1">是/否
                    <input type="radio" name="bao" {{old('bao')==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                    <label for="exampleInputPassword1">是否保标记</label>
                    <input type="radio" name="piao" {{old('piao')==1?'checked':''}} value="1">是/否
                    <input type="radio" name="piao" {{old('piao')==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                    <label for="exampleInputPassword1">是否是准标记</label>
                    <input type="radio" name="zhun" {{old('zhun')==1?'checked':''}} value="1">是/否
                    <input type="radio" name="zhun" {{old('zhun')==2?'checked':''}} value="2">&emsp;&emsp;&emsp;
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">起送金额</label>
                    <input type="text" class="form-control" name="start_send" id="exampleInputEmail1" placeholder="起送金额" value="{{old('start_send')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">配送费</label>
                    <input type="text" class="form-control" name="send_cost" id="exampleInputEmail1" placeholder="配送金额" value="{{old('send_cost')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">预计时间</label>
                    <input type="text" class="form-control" name="estimate_time" id="exampleInputEmail1" placeholder="预计时间" value="{{old('estimate_time')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">店公告</label>
                    <input type="text" class="form-control" name="notice" id="exampleInputEmail1" placeholder="店公告" value="{{old('notice')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">优惠信息</label>
                    <input type="text" class="form-control" name="discount" id="exampleInputEmail1" placeholder="优惠信息" value="{{old('discount')}}">
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-danger">添加</button>
            </form>
        </div>
@stop
