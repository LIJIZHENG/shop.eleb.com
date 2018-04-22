@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <form action="{{route('menu.update',['menu'=>$menu])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">菜品名称</label>
                <input type="text" name="menu_name" class="form-control" id="exampleInputEmail1" placeholder="菜品名称" value="{{$menu->menu_name}}">
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="exampleInputPassword1">评分</label>--}}
                {{--<input type="number" name="rating" class="form-control" id="exampleInputPassword1" placeholder="评分">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="exampleInputPassword1">菜品价格</label>
                <input type="number" name="menu_price" class="form-control" id="exampleInputPassword1" placeholder="菜品价格" value="{{$menu->menu_price}}">
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
                <label for="exampleInputFile">菜品图片</label>
                <img src="{{$menu->menu_img}}">
                <input type="file" name="menu_img" id="exampleInputFile">
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
