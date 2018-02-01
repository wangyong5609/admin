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
                <th >ID</th>
                <th>姓名</th>
                <th>岗位</th>
                <th>状态</th>
                <th>描述</th>
                <th>操作</th>
                </thead>
                <tbody>
                @foreach($staffs as $staff)
                    <tr>
                        <td>{!!$staff->id!!}</td>
                        <td>{!!$staff->name!!}</td>
                        <td>{!!$staff->post_name!!}</td>
                        <td>{!!$staff->status_name!!}</td>
                        <td>{!!$staff->description!!}</td>
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
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
            {{ $staffs->render() }}
        </div>
    </div>
@stop
{{--@section('content')--}}

{{--<div class = 'container'>--}}
    {{--<h1>--}}
        {{--staff Index--}}
    {{--</h1>--}}
    {{--<div class="row">--}}
        {{--<form class = 'col s3' method = 'get' action = '{!!url("staff")!!}/create'>--}}
            {{--<button class = 'btn red' type = 'submit'>Create New staff</button>--}}
        {{--</form>--}}
    {{--</div>--}}
    {{--<table>--}}
        {{--<thead>--}}
            {{--<th>name</th>--}}
            {{--<th>birthday</th>--}}
            {{--<th>phone</th>--}}
            {{--<th>actions</th>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
            {{--@foreach($staffs as $staff)--}}
            {{--<tr>--}}
                {{--<td>{!!$staff->name!!}</td>--}}
                {{--<td>{!!$staff->birthday!!}</td>--}}
                {{--<td>{!!$staff->phone!!}</td>--}}
                {{--<td>--}}
                    {{--<div class = 'row'>--}}
                        {{--<a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/staff/{!!$staff->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>--}}
                        {{--<a href = '#' class = 'viewEdit btn-floating blue' data-link = '/staff/{!!$staff->id!!}/edit'><i class = 'material-icons'>edit</i></a>--}}
                        {{--<a href = '#' class = 'viewShow btn-floating orange' data-link = '/staff/{!!$staff->id!!}'><i class = 'material-icons'>info</i></a>--}}
                    {{--</div>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}
    {{--{!! $staffs->render() !!}--}}

{{--</div>--}}
{{--@endsection--}}