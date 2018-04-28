
@extends('admin.admin')
@section('title','员工列表')
@section('content-header')
    <h1>
        员工列表
    </h1>
    <ol class="breadcrumb">
        <li class="active">员工管理 - 员工列表</li>
    </ol>
@stop

@section('content')
    <a href="{{url('staff/create')}}" class="btn btn-primary margin-bottom">添加员工</a>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">员工列表({!!app(\App\StaffWorkLog::class)->todayStatus()!!})</h3>
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
        <form method="POST" action="{{url('/work')}}" accept-charset="utf-8">
            {!! csrf_field() !!}
            <div class="box-body table-responsive">
                @if( count($staffs))
                    <table class="table table-hover table-bordered">
                        <thead>
                        <th >ID</th>
                        <th>姓名</th>
                        <th>岗位</th>
                        <th>状态</th>
                        <th>描述</th>
                        <th>电话号码</th>
                        <th>操作</th>
                        </thead>
                        <tbody>
                        @foreach($staffs as $staff)
                            <tr>
                                <td>{!!$staff->id!!}</td>
                                <input type="hidden" name="staff_id[]" value="{{$staff->id}}">
                                <td>{!!$staff->name!!}</td>
                                <td>{{ implode(',',$staff->post_names) }}</td>
                                <td>
                                    <select id="status[]" name = "status[]" style="width:150px " class="form-control">
                                        @foreach($status as $dict)
                                            <option value="{{$dict->id}}" @if($dict->name == $staff->status_name) selected="selected" @endif>{{$dict->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{!!$staff->description!!}</td>
                                <td>{!!$staff->phone!!}</td>
                                <td>
                                    <div>
                                        <a href = '{{url('/staff/'.$staff->id.'/edit')}}'>  修改</a>
                                        <a methods="delete" href = '{{url('/staff/'.$staff->id.'/delete')}}'>  删除</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">保存</button>
                @else
                    <div class="empty-block">暂无数据 ~_~ </div>
                @endif
            </div>
        </form>

    </div>
@stop
