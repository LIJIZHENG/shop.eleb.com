@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
    <table class="table table-bordered">
        <tr>
            <th>订单ID</th>
            <th>订单货号</th>
            <th>时间</th>
            <th>状态</th>
            <th>店铺名称</th>
            <th>店铺图片</th>
            <th>收货地址</th>
            <th>联系电话</th>
            <th>收货人</th>
            <th>菜品名称</th>
            <th>菜品图片</th>
            <th>菜品数量</th>
            <th>菜品金额</th>
            <th>操作</th>
        </tr>
        @foreach($rows as $row)
        <tr>
           <td>{{$row->id}}</td>
           <td>{{$row->order_code}}</td>
           <td>{{$row->order_birth_time}}</td>
           <td>{{$row->order_status}}</td>
           <td>{{$row->shop_name}}</td>
           <td><img src="{{$row->shop_img}}" alt=""></td>
           <td>{{$row->provence.$row->city.$row->area.$row->detail_address}}</td>
           <td>{{$row->tel}}</td>
           <td>{{$row->name}}</td>
           <td>{{$row->ints->goods_name}}</td>
           <td><img src="{{$row->ints->goods_img}}" alt=""></td>
           <td>{{$row->ints->amount}}</td>
           <td>{{$row->ints->goods_price}}</td>
           <td>
               @if($row->order_status=='代付款')-
                   <a href="{{route('orders',['id'=>$row->id])}}" class="btn btn-danger">发货</a>
                   <a href="{{route('recall',['id'=>$row->id])}}" class="btn btn-danger">取消订单</a>
               @endif
               @if($row->order_status=='取消订单')
                   <a href="{{route('restore',['id'=>$row->id])}}" class="btn btn-danger">恢复订单</a>
               @endif
               @if($row->order_status=='已完成')
                    <a href="{{route('recall',['id'=>$row->id])}}" class="btn btn-danger">取消订单</a>
               @endif
           </td>
        </tr>
        @endforeach
    </table>
    </div>
@stop
