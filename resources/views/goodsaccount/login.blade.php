@extends('layouts.default')
@section('content')
    <div class="container">
        <form action="{{route('check')}}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">商家名称</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="用户名" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="密码">
            </div>
            <div class="form-group">
                <label>验证码:</label>
                <div class="row">
                    <div class="col-xs-3"><input id="captcha" class="form-control" name="captcha" ></div>
                    <div class="col-xs-7"><img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></div>
                </div>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="remember"> 记住我</label>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-primary">登录</button>
        </form>
    </div>
@stop
