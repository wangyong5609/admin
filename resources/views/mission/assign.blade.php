@extends('admin.admin')
@section('title','任务分配')
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
                        <td>{!!$mission->id!!}  <input name="mission_id" type="hidden" value="{!!$mission->id!!}"></td>
                        <td>{!!$mission->name!!}</td>
                        <td>{!!$mission->post_name!!}</td>
                        <td>{!!$mission->status_name!!}</td>
                        <td title="{{$mission->description}}">{!!$mission->short_desc!!}</td>
                        <td>{!!$mission->start_time!!}</td>
                        <td>{!!$mission->end_time!!}</td>
                        <td>{!!$mission->complete_time!!}</td>
                        <td>{!!$mission->amount!!}</td>
                        <td>{!!$mission->staff_name!!}</td>
                        <td>{!!$mission->upper!!} <input name="upper" type="hidden" value="{!!$mission->upper!!}"></td>
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
                        $amount = $mission->amount;
                        $upper = $mission->upper;
                    @endphp
                    @foreach($staffs as $staff)
                        <tr>
                            <td>@if($amount > 0)<input type="checkbox" name="check" value="">@endif</td>
                            <td class="staff_id">{!!$staff->id!!}</td>
                            <td>{!!$staff->name!!}</td>
                            <td>{!!$staff->post_name!!}</td>
                            <td >{!!$staff->status_name!!}</td>
                            <td>{!!$staff->mission_status_name!!}</td>
                            <td>{!!$staff->last_mission_start!!}</td>
                            <td>{!!$staff->last_mission_end!!}</td>
                            <td>
                                @if($amount > 0)
                                    <input name="amount"  type="number" max="{{$upper}}" style="width: 100px"
                                           @if($amount > $upper)
                                           value="{{$upper}}"
                                           @else
                                           value="{{$amount}}"
                                        @endif >
                                @endif
                            </td>
                            <td>
                                @if($amount > 0)
                                    <pd name="start_time">{{date('Y-m-d',time())}}</pd>
                                @endif
                            </td>
                            <td>
                                @if($amount > 0 )
                                    @if($mission->arithmetic_name =='单个')
                                        @if($amount > $upper)
                                            <pd name="end_time">{{date('Y-m-d',time()+ $upper*$mission->sustain * 3600*24)}}</pd>
                                        @else
                                            <pd name="end_time">{{date('Y-m-d',time()+ $amount*$mission->sustain * 3600*24)}}</pd>
                                        @endif
                                    @else
                                        $mission->end_time
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @php
                            $amount -= $upper
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
        </div>
    </div>
    <input name="url" type="hidden" value="{{url("mission/".$mission->id."/division")}}">
    <a onclick = 'add()' class="btn btn-primary margin-bottom">自动分配</a>
    <a href="{{url('mission')}}" class="btn btn-primary margin-bottom">返回任务列表</a>
@stop
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script>
    var arr = [];
    var add = function add() {

        Array.from($('input[name="check"]:checked')).forEach(function(item) {
            var amount = $(item).closest('tr').find('input[name="amount"]').val();
            var start_time = $(item).closest('tr').find('pd[name="start_time"]').html();
            var end_time = $(item).closest('tr').find('pd[name="end_time"]').html();
            var staff_id = $(item).closest('tr').find('.staff_id').html();
            var upper = $(" input[ name='upper' ] ").val();
            var data = {
                'amount': amount,
                'staff_id' :staff_id,
                'start_time' : start_time,
                'end_time' : end_time
            }
            arr.push(data);
        });
        console.log(arr);
        var url = $(" input[ name='url' ] ").val()
        $.post(url, {
            'data' : arr
        }, function(res) {
            if (res.code == 400){
                alert(res.data)
            }else{
                window.location.replace(res);
            }
        })
    }

    // $(document).ready(function(){
    //     var day2 = new Date();
    //     $(" input[ name='start_time' ] ").val(formatDate(day2))
    // });

    // function formatDate(now) {
    //     var year=now.getFullYear();
    //     var month=now.getMonth()+1;
    //     var date=now.getDate();
    //     return year+"-"+month+"-"+date;
    //}
</script>