@extends('admin.admin')
@section('title','Index')
@section('content-header')
    <h1>
        任务分配
    </h1>
    <ol class="breadcrumb">
        <li class="active">任务 - 任务列表 - 任务分配</li>
    </ol>
@stop

@section('content')
    <div class="box-body table-responsive">
        <h4 >任务信息</h4>
        @if( count($mission))
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
                <th>持续时间</th>
                <th>算法</th>
                </thead>
                <tbody>
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
                        <td>{!!$mission->sustain!!}</td>
                        <td>{!!$mission->arithmetic_name!!}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
    <div class="box box-primary" style="margin-top: 10px">
        <div class="box-header with-border">
            <h3 class="box-title">员工列表</h3>
            <div class="box-tools">
                <form action="{{url('staff')}}" method="get">
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
            @if( count($staffs))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th data-field="state" data-checkbox="true"></th>
                    <th >ID</th>
                    <th>姓名</th>
                    <th>岗位</th>
                    <th>工作状态</th>
                    <th>任务状态</th>
                    <th>上次任务开始时间</th>
                    <th>上次任务结束时间</th>
                    </thead>
                    <tbody>
                    @foreach($staffs as $staff)
                        <tr>

                            <td property="sd"></td>
                            <td>{!!$staff->id!!}</td>
                            <td>{!!$staff->name!!}</td>
                            <td>{!!$staff->post_name!!}</td>
                            <td >{!!$staff->status_name!!}</td>
                            <td>{!!$staff->description!!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
        </div>
    </div>
@stop

<script>
    var x =document.getElementsByName("myInput");
</script>