@extends('layouts.default')
@section('content')
    <h1>活动名称{{$row->name}}</h1>
    活动内容:{!! $row->contents !!}
@stop
