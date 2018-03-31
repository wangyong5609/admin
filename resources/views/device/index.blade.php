@extends('admin.admin')
@section('title','设备列表')
@section('content-header')
    <h1>
        设备列表
    </h1>
    <ol class="breadcrumb">
        <li class="active">设备管理 - 设备列表</li>
    </ol>
@stop

@section('content')
    <a href="{{url('devices/create')}}" class="btn btn-primary margin-bottom">创建新设备</a>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">设备列表</h3>
            <div class="box-tools">
                <form action="{{url('devices')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="name"
                               style="width: 150px;" placeholder="搜索设备名称">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            @if( count($devices))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th>ID</th>
                    <th>设备名称</th>
                    <th>数量</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($devices as $device)
                        <tr>
                            <td>{!!$device->id!!}</td>
                            <td>{!!$device->name!!}</td>
                            <td>{!!$device->amount!!}</td>
                            <td>
                                <div class = ''>
                                    <a href = '{{url('/devices/'.$device->id.'/edit')}}'>  修改</a>
                                    <a methods="delete" href = '{{url('/devices/'.$device->id.'/delete')}}'>  删除</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
            {{ $devices->render() }}
        </div>
    </div>
@stop