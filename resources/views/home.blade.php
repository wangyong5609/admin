@extends('admin.admin')
@section('title','主页')
@section('content-header')
    <h1>
        当前状态
    </h1>
    <ol class="breadcrumb">
        <li class="active">当前状态</li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">员工-任务</h3>
            <div class="box-tools">
                <form action="{{url('home')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="name"
                               style="width: 150px;" placeholder="搜索员工姓名">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if( count($missions))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th >ID</th>
                    <th>姓名</th>
                    <th>岗位</th>
                    <th>状态</th>
                    <th>当前状态</th>
                    <th>起始时间</th>
                    <th>结束时间</th>
                    <th>项目总时长</th>
                    <th>已用时长</th>
                    <th>任务状态</th>
                    </thead>
                    <tbody>
                    @foreach($missions as $mission)
                        <tr>
                            <td>{!!$mission->id!!}</td>
                            <td>{!!$mission->staff_name!!}</td>
                            <td>{!!$mission->staff->post_name!!}</td>
                            <td>{!!$mission->staff->status_name!!}</td>
                            @if($mission->staff->mission_status_name == '任务中')
                                <td>进行任务：{{$mission->name}}</td>
                                <td>{{$mission->start_time}}</td>
                                <td>{{$mission->end_time}}</td>
                                <td>{{$mission->life}} 天</td>
                                <td>{{$mission->consuming}} 天</td>
                                <td>{{$mission->status_name}}</td>
                            @else
                                <td>{{$staff->mission_status_name}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
            {{ $missions->render() }}
        </div>
    </div>
@stop