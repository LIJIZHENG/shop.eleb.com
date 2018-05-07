@extends('layouts.default')
@section('content')
    <div class="container">
        @foreach($b as $value)
     <h1>活动标题:{{$value->enevts->title}}</h1>
        <p>奖励名称:{{$value->name}}.{!! $value->description !!}</p>
         @endforeach
    </div>
@stop
