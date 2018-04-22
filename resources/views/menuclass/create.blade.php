@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
    <form action="{{route('menuclass.store')}}" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">分类名称</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="分类名称">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">分类描述</label>
            <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="分类描述">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">属于那个积累</label>
            <input type="text" name="type_accumulation" class="form-control" id="exampleInputPassword1" placeholder="属于那个积累">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_selected" value="1">是否选中
            </label>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-danger">添加</button>
    </form>
    </div>
@stop