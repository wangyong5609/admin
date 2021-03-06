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
    <div style="margin-top: 5px" class="box box-primary">
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
                    <th>设备</th>
                    <th>任务状态</th>
                    <th>优先级</th>
                    <th>描述</th>
                    <th>起始时间</th>
                    <th>计划时间</th>
                    <th>预测完成时间</th>
                    <th>已用时间</th>
                    <th>实际完成时间</th>
                    <th>任务量</th>
                    <th>所属人员</th>
                    <th>文件</th>
                    <th>备注</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($missions as $mission)
                        <tr>
                            <td>{!!$mission->id!!}</td>
                            <td>{!!$mission->name!!}</td>
                            <td>{!!$mission->post_name!!}</td>
                            <td>{!!$mission->device_name!!}</td>
                            <td>{!!$mission->status_name!!}</td>
                            <td>{!!$mission->priority_name!!}</td>
                            <td title="{{$mission->description}}">{!!$mission->short_desc!!}</td>
                            <td>{!!$mission->start_time!!}</td>
                            <td>{!!$mission->sustain!!}天</td>
                            <td>{!!$mission->plan_end_time!!}</td>
                            <td>{!!$mission->consuming!!}天</td>
                            <td>{!!$mission->complete_time!!}</td>
                            <td>{!!$mission->amount!!}</td>
                            <td>{!!$mission->staff_name!!}</td>
                            <td><a href="{{url('/files/download/'.$mission->file_uuid)}}">
                                    {!!$mission->filename!!}
                                </a>
                            </td>
                            <td title="{{$mission->remark}}">{!!str_limit($mission->remark,20)!!}</td>
                            <td>
                                <div>
                                    @if($mission->complete_time == '未完成')
                                        @if($mission->start_time)
                                            <a href = '{{url('/mission/'.$mission->id.'/complete')}}'>  完成</a>
                                        @else
                                            <a href = '{{url('/mission/'.$mission->id.'/start')}}'
                                            @if((\App\Helper\Util::diffDateOfDays(new \Carbon\Carbon($mission->created_at),new \Carbon\Carbon(date("Y-m-d H:i:s",time())),$mission->staff_id)) >= 1)
                                                 style="color: red" >  超时接单</a>
                                            @else
                                                > 接单</a>
                                            @endif
                                        @endif
                                    @endif
                                    @if(Auth::user()->hasRole('admin'))
                                        <a href = '{{url('/mission/'.$mission->id.'/edit')}}'>  修改</a>
                                        <a href = '{{url('/mission/'.$mission->id.'/remark')}}'>备注</a>
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

