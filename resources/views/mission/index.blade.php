@extends('admin.admin')
@section('content-header')
    <h1>
        任务
    </h1>
    <ol class="breadcrumb">
        <li class="active">任务 - 任务列表</li>
    </ol>
@stop

@section('content')
    <a href="{{url('mission/create')}}" class="btn btn-primary margin-bottom">创建新任务</a>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">任务列表</h3>
            <div class="box-tools">
                <form action="{{url('mission')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_title"
                               style="width: 150px;" placeholder="搜索任务名称、">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if( isset($templates))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th>任务名称</th>
                    <th>任务岗</th>
                    <th>任务状态</th>
                    <th>起始时间</th>
                    <th>结束时间</th>
                    <th>实际完成时间</th>
                    <th>任务量</th>
                    <th>所属人员</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($missions as $mission)
                        <tr>
                            <td>{!!$mission->name!!}</td>
                            <td>{!!$mission->post_name!!}</td>
                            <td>{!!$mission->status_name!!}</td>
                            <td>{!!$mission->start_time!!}</td>
                            <td>{!!$mission->end_time!!}</td>
                            <td>{!!$mission->complete_time!!}</td>
                            <td>{!!$mission->amount!!}</td>
                            <td>{!!$mission->staff_name!!}</td>
                            <td>
                                <div class = 'row'>
                                    <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/staff/{!!$mission->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                                    <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/staff/{!!$mission->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                                    <a href = '#' class = 'viewShow btn-floating orange' data-link = '/staff/{!!$mission->id!!}'><i class = 'material-icons'>info</i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h1>暂无数据</h1>
            @endif
        </div>
    </div>
@stop