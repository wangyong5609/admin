@extends('admin.admin')
@section('title','任务模板列表')
@section('content-header')
    <h1>
        任务模板
    </h1>
    <ol class="breadcrumb">
        <li class="active">任务模板 - 任务模板列表</li>
    </ol>
@stop

@section('content')
    <a href="{{url('mission_template/create')}}" class="btn btn-primary margin-bottom">创建新模板</a>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">模板列表</h3>
            <div class="box-tools">
                <form action="{{url('mission_template')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="name"
                               style="width: 150px;" placeholder="搜索模板名称">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if( count($templates))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th>ID</th>
                    <th>任务名称</th>
                    <th>任务岗</th>
                    <th>使用设备</th>
                    <th>任务描述</th>
                    <th>任务数量上限</th>
                    <th>任务时间</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($templates as $template)
                        <tr>
                            <td>{!!$template->id!!}</td>
                            <td>{!!$template->name!!}</td>
                            <td>{!!$template->post_name!!}</td>
                            <td>{!!$template->device_name!!}</td>
                            <td>{!!$template->description!!}</td>
                            <td>{!!$template->upper!!}</td>
                            <td>{!!$template->sustain!!}天</td>
                            <td>
                                <div class = ''>
                                    <a href = '{{url('/mission_template/'.$template->id.'/edit')}}'>  修改</a>
                                    <a methods="delete" href = '{{url('/mission_template/'.$template->id.'/delete')}}'>  删除</a>
                                    <a methods="delete" href = '{{url('/mission/'.$template->id.'/assign')}}'>  发布</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
            {{ $templates->render() }}
        </div>
    </div>
@stop