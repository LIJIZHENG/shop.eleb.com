@extends('layouts.default')
@section('content')
    <div class="container">
        <h1>{{$event->title}}</h1>
        <p>报名开始时间:{{$event->signup_start}}</p>
        <p>报名结束时间:{{$event->signup_end}}  </p>
        <p>开奖日期:{{$event->prize_date}}</p>
        <p>报名人数限制:{{$event->signup_num}}</p>
        <p>开没开奖:{{$event->is_prize==1?'已开奖':'未开奖'}}</p>
        <p>活动内容:{!! $event->content !!}</p>
        @if($event->is_prize==0)
        <a href="{{route('event.create',['id'=>$event->id])}}" class="btn btn-danger">报名</a>
        @endif
    </div>
@stop