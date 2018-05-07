@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
        <form action="{{route('dishes')}}" method="get">
            查看某天的订单:<input type="date" name="time">
            <input type="submit" value="查看">
        </form>
        <form action="{{route('dishes')}}" method="get">
            查看某月的订单:<input type="date" name="month">
            <input type="submit" value="查看">
        </form>
    <table class="table table-responsive">
        <tr>
            <th>每日菜品数量</th>
            <th>每月菜品数量</th>
            <th>总菜品数量</th>
        </tr>
         <tr>
             <td>
                 @foreach($t as $v)
                     {{'菜品名称'.$v->goods_name.'销量'.$v->amounts}}<br/>
                 @endforeach
             </td>
             <td>
                 @foreach($p as $y)
                     {{'菜品名称'.$y->goods_name.'销量'.$y->amounts}}<br/>
                 @endforeach
             </td>
             <td>
                 @foreach($zon as $z)
                     {{'菜品名称'.$z->goods_name.'销量'.$z->amounts}}<br/>
                 @endforeach
             </td>
         </tr>
    </table>
    </div>
@stop
