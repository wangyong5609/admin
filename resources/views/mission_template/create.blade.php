@extends('admin.admin')
@section('title','新建模板')
@section('other-css')
    {!! editor_css() !!}
    {{--<link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">--}}
@endsection
@section('content-header')
    <h1>
        任务模板
    </h1>
    <ol class="breadcrumb">
        <li class="active">任务模板 - 新建模板</li>
    </ol>
@stop
@section('content')

<div class = 'container'>
    <h2 class="page-header">新建模板</h2>
    <form method="POST" action="{{url('/mission_template')}}" accept-charset="utf-8">
        {!! csrf_field() !!}
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>任务名称
                            <small class="text-red">*</small>
                        </label>
                        <input required="required" id="name" name = "name" type="text" class="form-control" autocomplete="off"
                               placeholder="任务名称" maxlength="80">
                    </div>
                    <div class="form-group">
                        <label>任务岗位
                            <small class="text-red">*</small>
                        </label>
                        <select id="post_id" name = "post_id" class="js-example-placeholder-single form-control">
                            @foreach($posts as $post)
                            <option value="{{$post->id}}">{{$post->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>使用设备
                            <small class="text-red">*</small>
                        </label>
                        <select id="device_id" name = "device_id" class="js-example-placeholder-single form-control">
                            <option value=''>不使用设备</option>
                            @foreach($devices as $device)
                                <option value="{{$device->id}}">{{$device->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>任务描述
                        </label>
                        <input  id="description" name = "description" type="text" class="form-control"  autocomplete="off"
                               placeholder="任务描述" maxlength="120">
                    </div>
                    <div class="form-group">
                        <label>任务数量上限
                            <small class="text-red">*</small>
                        </label>
                        <input required="required" id="upper" name = "upper"type="number" class="form-control"  autocomplete="off"
                               placeholder="任务数量上限" maxlength="80">
                    </div>
                    <div class="form-group">
                        <label>任务时间(天)
                            <small class="text-red">*</small>
                        </label>
                        <input required="required" id="sustain" name = "sustain"  class="form-control"  autocomplete="off"
                               placeholder="任务时间" maxlength="80">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>
</div>
@endsection