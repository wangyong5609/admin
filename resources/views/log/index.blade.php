@extends('admin.admin')
@section('content-header')
    <h1>
        操作日志
    </h1>
    <ol class="breadcrumb">
        <li class="active">操作日志 - 操作日志列表</li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">操作日志列表</h3>
            <div class="box-tools">
                <form action="{{url('log')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="mission_name"
                               style="width: 150px;" placeholder="搜索任务名称">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if( count($logs))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th>ID</th>
                    <th>任务名称</th>
                    <th>任务描述</th>
                    <th>修改项目</th>
                    <th>修改前</th>
                    <th>修改后</th>
                    <th>修改时间</th>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{!!$log->id!!}</td>
                            <td>{!!$log->mission_name!!}</td>
                            <td>{!!$log->mission_desc!!}</td>
                            <td>{!!$log->project!!}</td>
                            <td>{!!$log->original!!}</td>
                            <td>{!!$log->modification!!}</td>
                            <td>{!!$log->created_at!!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
            {{ $logs->render() }}
        </div>
    </div>
@stop