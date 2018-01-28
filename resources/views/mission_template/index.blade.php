@extends('admin.admin')
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
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_title"
                               style="width: 150px;" placeholder="搜索模板名称">
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
                    <th>任务描述</th>
                    <th>任务上限</th>
                    <th>持续时间</th>
                    <th>时间算法</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($templates as $template)
                        <tr>
                            <td>{!!$template->name!!}</td>
                            <td>{!!$template->post_name!!}</td>
                            <td>{!!$template->description!!}</td>
                            <td>{!!$template->upper!!}</td>
                            <td>{!!$template->sustain!!}天</td>
                            <td>{!!$template->arithmetic!!}天</td>
                            <td>
                                <div class = 'row'>
                                    <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/staff/{!!$template->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                                    <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/staff/{!!$template->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                                    <a href = '#' class = 'viewShow btn-floating orange' data-link = '/staff/{!!$template->id!!}'><i class = 'material-icons'>info</i></a>
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