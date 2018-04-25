@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>活动名称</th>
                <th>活动开始时间</th>
                <th>活动结束时间</th>
                <th>操作</th>
            </tr>
            @foreach($rows as $row)
                <tr>
                    <td>{{$row['id']}}</td>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['start']}}</td>
                    <td>{{$row['end']}}</td>
                    <td>
                        <a href="{{route('activity.show',['activity'=>$row])}}" class="btn btn-danger">查看活动详情</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop