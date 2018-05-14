@extends('layouts.app')
@section('title','话题列表')
@section('content')
<div class="container">
    <div class="col-lg-9 col-md-9 topic-list">
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <i class="active" role="presentation"><a href="#">最后发布</a></i>
                    <i role="presentation"><a href="#">最新回复</a></i>
                </ul>
            </div>

            <div class="panel-body">
                {{-- 话题列表 --}}
                @include('topics._topic_list',['topics'=>$topics])
                {{-- 分页 --}}
                {!! $topics->render() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 sidebar">
        @include('topics._sidebar')
    </div>
</div>

@endsection