@extends('admin.admin')
@section('title','修改设备信息')
@section('content-header')
    <h1>
        修改设备信息
    </h1>
    <ol class="breadcrumb">
        <li class="active">设备管理 - 设备列表 - 修改设备信息</li>
    </ol>
@stop
@section('content')

    <div class = 'container'>
        <h2 class="page-header">修改设备信息</h2>
        <form method="POST" action="{{url('devices/'.$device->id.'/update')}}" accept-charset="utf-8">
            {!! csrf_field() !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            <label>设备名称
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="name" name = "name" type="text" class="form-control" autocomplete="off"
                                   value="{!!$device->name!!}" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label>设备数量
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="amount" name = "amount"type="number" class="form-control"  autocomplete="off"
                                   placeholder="设备数量" maxlength="80" value="{{$device->amount}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
@endsection
