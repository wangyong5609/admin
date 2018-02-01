@extends('admin.admin')
@section('title','任务列表')
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
                <form    action="{{url('mission')}}" method="get">
                    <div style="width: 120px;display:inline-block;float:left;" >
                        <lable>状态:</lable>
                        <select   id="status" name= "status" >
                            <option value=""></option>
                            @foreach($status as $dict)
                                <option value="{{$dict->id}}">{{$dict->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="width: 120px;display:inline-block;float:left;" >
                        <lable>岗位:</lable>
                        <select   id="post_id" name= "post_id" >
                            <option value=""></option>
                            @foreach($posts as $post)
                                <option value="{{$post->id}}">{{$post->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group" style="width: 200px">
                        <input type="text" class="form-control input-sm pull-right" name="name"
                               style="width: 150px;" placeholder="搜索任务名称">

                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default">筛选</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if( count($missions))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th>ID</th>
                    <th>任务名称</th>
                    <th>任务岗</th>
                    <th>任务状态</th>
                    <th>描述</th>
                    <th>起始时间</th>
                    <th>结束时间</th>
                    <th>实际完成时间</th>
                    <th>任务量</th>
                    <th>所属人员</th>
                    <th>上限</th>
                    <th>持续时间</th>
                    <th>算法</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($missions as $mission)
                        <tr>
                            <td>{!!$mission->id!!}</td>
                            <td>{!!$mission->name!!}</td>
                            <td>{!!$mission->post_name!!}</td>
                            <td>{!!$mission->status_name!!}</td>
                            <td title="{{$mission->description}}">{!!$mission->short_desc!!}</td>
                            <td>{!!$mission->start_time!!}</td>
                            <td>{!!$mission->end_time!!}</td>
                            <td>{!!$mission->complete_time!!}</td>
                            <td>{!!$mission->amount!!}</td>
                            <td>{!!$mission->staff_name!!}</td>
                            <td>{!!$mission->upper!!}</td>
                            <td>{!!$mission->sustain!!}</td>
                            <td>{!!$mission->arithmetic_name!!}</td>
                            <td>
                                <div>
                                    <a href = '{{url('/mission/'.$mission->id.'/edit')}}'>  修改</a>

                                    @if(! $mission->staff_id)
                                        <a href = '{{url('/mission/'.$mission->id.'/assign')}}'>自动分配</a>
                                    @endif


                                    @if(empty($mission->staff_id))
                                        <a methods="delete" href = '{{url('/mission/'.$mission->id.'/delete')}}'>  删除</a>
                                    @endif
                                </div>
                            </td>
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

