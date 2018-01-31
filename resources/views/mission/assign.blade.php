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
                <th>上限</th>
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
                        <td>{!!$mission->upper!!}</td>
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
        </div>
        <div class="box-body table-responsive">
            @if( count($staffs))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th></th>
                    <th>ID</th>
                    <th>姓名</th>
                    <th>岗位</th>
                    <th>工作状态</th>
                    <th>任务状态</th>
                    <th>上次任务开始时间</th>
                    <th>上次任务结束时间</th>
                    <th>任务量</th>
                    <th>任务开始时间</th>
                    <th>任务结束时间</th>
                    </thead>
                    <tbody>
                    @php
                        $amount = 120
                    @endphp
                    @foreach($staffs as $staff)
                        <tr>
                            <td>@if($amount > 0)<input type="checkbox" name="check" value="">@endif</td>
                            <td class="staff_id">{!!$staff->id!!}</td>
                            <td>{!!$staff->name!!}</td>
                            <td>{!!$staff->post_name!!}</td>
                            <td >{!!$staff->status_name!!}</td>
                            <td>{!!$staff->description!!}</td>
                            <td>{!!$staff->description!!}</td>
                            <td>{!!$staff->description!!}</td>
                            <td>@if($amount > 0)<input name="amount"  type="number" style="width: 100px" @if($amount > 50) value="50" @else value="{{$amount}}" @endif > @endif</td>
                            <td>@if($amount > 0)<input name="start_time" type="date" style="height: 25px" value="">@endif</td>
                            <td>@if($amount > 0)<input name="end_time" type="date" style="height: 25px" value="">@endif</td>
                        </tr>
                        @php
                            $amount -= 50
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
        </div>
    </div>
    <a onclick = 'add()' class="btn btn-primary margin-bottom">自动分配</a>
    <a href="{{url('mission')}}" class="btn btn-primary margin-bottom">返回任务列表</a>
@stop
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script>
    var arr = [];
    var add = function add() {

        Array.from($('input[name="check"]:checked')).forEach(function(item) {
            var amount = $(item).closest('tr').find('input[name="amount"]').val();
            var start_time = $(item).closest('tr').find('input[name="start_time"]').val();
            var end_time = $(item).closest('tr').find('input[name="end_time"]').val();
            var staff_id = $(item).closest('tr').find('.staff_id').html();
            var data = {
                'amount': amount,
                'staff_id' :staff_id,
                'start_time' : start_time,
                'end_time' : end_time
            }
            arr.push(data);
        });
        console.log(arr);
        $.post('http://localhost:8280/mission/1/division', {
            'data' : arr
        }, function(res) {
        })
    }



</script>