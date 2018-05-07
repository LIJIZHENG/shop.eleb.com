@extends('layouts.default')
@section('content')
    <div class="container">
        @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>活动名称</th>
                <th>报名开始时间</th>
                <th>报名结束时间</th>
                <th>开奖日期</th>
                <th>报名人数限制</th>
                <th>是否已开奖</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
            <tr data-id="{{$row->id}}">
                <td>{{$row->id}}</td>
                <td>{{$row->title}}</td>
                <td>{{date("Y-m-d",$row->signup_start)}}</td>
                <td>{{date("Y-m-d",$row->signup_end)}}</td>
                <td>{{date("Y-m-d",$row->prize_date)}}</td>
                <td>{{$row->signup_num}}</td>
                <td>{{$row->is_prize==1?'是':'否'}}</td>
                <td>
                    <a href="{{route('event.show',['event'=>$row])}}" class="btn btn-danger">查看活动详情</a>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="8">
                    <a href="start" class="btn btn-danger">我的活动结果</a>
                    <a href="/lottery" class="btn btn-danger">所有活动得结果</a>
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
                    url: "event/"+id,
                    data: "_token={{csrf_token()}}",
                    success: function(msg){
                        tr.remove()
                    }
                })
            }
        });
    </script>
@stop