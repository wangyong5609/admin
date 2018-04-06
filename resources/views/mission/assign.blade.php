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
        @if($mission)
            <table class="table table-hover table-bordered">
                <thead>
                <th>ID</th>
                <th>任务名称</th>
                <th>任务岗</th>
                <th>设备</th>
                <th>描述</th>
                <th>任务量</th>
                <th>任务数量上限</th>
                <th>任务时间(天)</th>
                <th>优先级</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{!!$mission->id!!}  <input name="mission_id" type="hidden" value="{!!$mission->id!!}"></td>
                        <td><input name="mission_name" type="text" value="{!!$mission->name!!}"></td>
                        <td>{!!$mission->post_name!!}</td>
                        <td>{!!$mission->device_name!!}</td>
                        <td title="{{$mission->description}}">{!!$mission->short_desc!!}</td>
                        <td><input id="total_amount" type="number" value="{!! $mission->total_amount !!}" :minlength="1"></td>
                        <td>{!!$mission->upper!!} <input name="upper" type="hidden" value="{!!$mission->upper!!}"></td>
                        <td><input disabled = "disabled" id = "sustain" name="sustain" style="border:0;width: 100px" value="{!!$mission->sustain!!}"></td>
                        <td>
                            <select id="priority" name = "priority" class="js-example-placeholder-single form-control">
                                @foreach($priority as $dict)
                                    <option value="{{$dict->id}}">{{$dict->name}}</option>
                                @endforeach
                            </select>
                        </td>
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
                    <th>工作状态</th>
                    <th>任务状态</th>
                    <th>上次任务开始时间</th>
                    <th>上次任务结束时间</th>
                    <th>预计任务开始时间</th>
                    <th>预计任务结束时间</th>
                    <th>任务量</th>
                    <th>任务所需时长</th>
                    </thead>
                    <tbody>
                    @foreach($staffs as $staff)
                        <tr>
                            <td><input type="hidden" name="check" value=""></td>
                            <td class="staff_id">{!!$staff->id!!}</td>
                            <td>{!!$staff->name!!}</td>
                            <td>{!!$staff->status_name!!}</td>
                            <td>{!!$staff->mission_status_name!!}</td>
                            <td>{!!$staff->last_mission_start!!}</td>
                            <td>{!!$staff->last_mission_end!!}</td>
                            <td>{!!$staff->plan_mission_start!!}</td>
                            <td><input id="plan_mission_end" name="plan_mission_end" value="{!!$staff->plan_mission_end!!}" readonly="readonly" style="border:0"></td>
                            <td><input id="amount" name="amount" value="{!!$staff->amount!!}" readonly="readonly" style="border:0;width: 100px"></td>

                            <td><input id="need_time" name="need_time" value="{!!$staff->need_time!!}天"  align="right" readonly="readonly" style="border:0;width: 100px;"></td>
                            {{--<td>--}}
                                {{--<input id = "amount" name="amount" readonly="readonly" style="border:0;width: 100px">--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<input id = "need_time" name="need_time"  readonly="readonly" style="border:0;width: 100px">--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
        </div>
    </div>
    <input name="url" type="hidden" value="{{url("mission/".$mission->id."/division")}}">
    <a onclick = 'add()' class="btn btn-primary margin-bottom">确定</a>
    {{--<i title="" class=" fa fa-question-circle-o"></i>--}}
    <a onclick = 'print()' class="btn btn-primary margin-bottom">打印</a>
@stop
<script src="{{url('dist/js/jquery.min.js')}}"></script>
<script>
    $(function(){
        var serachtimer;
        $('#total_amount').bind('keypress',function(event) {
            if (event.keyCode == "13") {
                var new_url = document.location.origin+document.location.pathname;
                //console.log(document.location.origin+document.location.pathname);
                var total = $(" input[ id='total_amount' ] ").val();
                new_url = new_url+"?total_amount="+total;
                window.location.replace(new_url);
            }
        })
    });

    var arr = [];
    var add = function add() {

        Array.from($('input[name="amount"]')).forEach(function(item) {
            var amount = item.value;
            if (amount && amount >0){
                var staff_id = $(item).closest('tr').find('.staff_id').html();
                var plan_end_time =$(item).closest('tr').find("#plan_mission_end").val();
                var data = {
                    'amount': amount,
                    'staff_id' :staff_id,
                    'plan_end_time':plan_end_time,
                }
                arr.push(data);
            }

        });
        console.log(arr);
        var url = $(" input[ name='url' ] ").val()
        $.post(url, {
            'data' : arr,
            'priority' :$("#priority").find("option:selected").val(),
            'mission_name' : $(" input[ name='mission_name' ] ").val()
        }, function(res) {
            if (res.code == 400){
                alert(res.data)
                arr = [];
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