@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>菜品分类描述</th>
                <th>是否选中</th>
                <th>分类名称</th>
                <th>类型积累</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr data-id="{{$row['id']}}">
                <td>{{$row['id']}}</td>
                <td>{{$row['description']}}</td>
                <td>{{$row['is_selected']==1?'是':'否'}}</td>
                <td>{{$row['name']}}</td>
                <td>{{$row['type_accumulation']}}</td>
                <td>
                    <a href="{{route('menuclass.edit',['menuclass'=>$row])}}" class="btn btn-warning">修改</a>
                    <button class="btn btn-primary">删除</button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6">
                    <a href="{{route('menuclass.create')}}" class="btn btn-danger">添加</a>
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
            $.ajax({
            type: "DELETE",
            url: "menuclass/"+id,
            data: "_token={{csrf_token()}}",
            success: function(msg){
            tr.remove()
            }
       })
     }
    });
    </script>
@stop
