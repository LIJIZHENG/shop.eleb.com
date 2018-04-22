@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
    <form action="{{route('revise')}}" method="post">
        <div class="form-group">
            <label for="exampleInputPassword1">旧密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="旧密码">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" name="newPwd" class="form-control" id="exampleInputPassword1" placeholder="新密码">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">确认密码</label>
            <input type="password" name="newPwd_confirmation" class="form-control" id="exampleInputPassword1" placeholder="确认密码">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-danger">确认修改</button>
    </form>
    </div>
@stop
