@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
        <form action="{{route('amount')}}" method="get">
            查看某天的订单:<input type="date" name="time">
            <input type="submit" value="查看">
        </form>
        <form action="{{route('amount')}}" method="get">
            查看某月的订单:<input type="date" name="month">
            <input type="submit" value="查看">
        </form>
    <table class="table table-responsive">
        <tr>
            <th>每日订单数</th>
            <th>每月订单数</th>
            <th>总订单数</th>
        </tr>
         <tr>
             <td>
                  {{$a[0]->$f}}
             </td>
             <td>
                 {{$r[0]->$f}}
             </td>
             <td>
                 {{$zong[0]->$f}}
             </td>
         </tr>
    </table>
    </div>
@stop
