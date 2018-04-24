@extends('layouts.default')
@section('content')
    <div class="container">
    @include('layouts._herder')
        <table class="table table-responsive">
            <tr>
                <td colspan="3" style="text-align: center">
                    <h1>最新活动</h1>
                </td>
            </tr>
            @foreach($rows as $row)
                @if(strtotime($row->end)>=strtotime(date('Y-m-d',time())))
                <tr>
                    <td><h1>{{$row->name}}</h1></td>
                    <td>{!! $row->contents !!}</td>
                    <td><h3>活动有效时间:{{$row->start}}<---->{{$row->end}}</h3></td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>
@stop