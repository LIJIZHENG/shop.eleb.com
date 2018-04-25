@extends('layouts.default')
@section('content')
<div class="container">
    @include('layouts._herder')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>菜品名称</th>
            <th>菜品评分</th>
            <th>菜品价钱</th>
            <th>菜品描述</th>
            <th>每月销售</th>
            <th>评分记录</th>
            <th>菜品提示</th>
            <th>满足记录</th>
            <th>满足率</th>
            <th>菜品图片</th>
            <th>菜品分类名称</th>
            <th>商家</th>
            <th>操作</th>
        </tr>
        @foreach($rows as $row)
        <tr data-id="{{$row['goods_id']}}">
            <td>{{$row['goods_id']}}</td>
            <td>{{$row['goods_name']}}</td>
            <td>{{$row['rating']}}</td>
            <td>{{$row['goods_price']}}</td>
            <td>{{$row['description']}}</td>
            <td>{{$row['month_sales']}}</td>
            <td>{{$row['rating_count']}}</td>
            <td>{{$row['tips']}}</td>
            <td>{{$row['satisfy_count']}}</td>
            <td>{{$row['satisfy_rate']}}</td>
            <td><img src="{{$row['menu_img']}}" alt=""></td>
            <td>{{$row->menuclass->name}}</td>
            <td>{{$row->goodsnews->shop_name}}</td>
            <td>
                <a href="{{route('menu.edit',['menu'=>$row])}}" class="btn btn-warning">修改</a>
                <button class="btn btn-primary">删除</button>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="14">
                <a href="{{route('menu.create')}}" class="btn btn-danger">添加</a>
            </td>
        </tr>
    </table>
</div>
@stop
@section('js')
    <script>
        $(".btn-primary").click(function () {
            var tr=$(this).closest('tr');
            if(confirm('是否删除数据!')){
                var id=tr.data('id');
//                console.log(id);
                $.ajax({
                    type: "DELETE",
                    url: "menu/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop
