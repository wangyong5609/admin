@extends('admin.admin')
@section('title','新建任务')
@section('other-css')
    {!! editor_css() !!}
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
@endsection
@section('content-header')
    <h1>
        任务
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="{{url('/admin/article/index')}}">任务 - 新建任务</a></li>
    </ol>
@stop

@section('content')

    <div class = 'container'>
        <h2 class="page-header">新建任务</h2>
        <a href="{{url('/choose')}}" class="btn btn-primary margin-bottom" >选择模板<a/>

        <form method="POST" action="{{url('/mission')}}" accept-charset="utf-8">
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
                                   placeholder="任务名称" maxlength="80" value="@if(isset($tem)) {{$tem->name}} @endif">
                        </div>
                        <div class="form-group">
                            <label>任务岗位
                                <small class="text-red">*</small>
                            </label>
                            <select id="post_id" name = "post_id" class="js-example-placeholder-single form-control">
                                @foreach($posts as $post)
                                    <option @if(isset($tem) && $tem->post_id == $post->id ) selected="selected" @endif value="{{$post->id}}">{{$post->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>任务描述 </label>
                            <input  id="description" name = "description" type="text" class="form-control"  autocomplete="off"
                                    placeholder="任务描述" maxlength="80" value="@if(isset($tem)) {{$tem->description}} @endif ">
                        </div>
                        <div class= "form-group" >
                            <label>起始时间
                            </label>
                            <input  id="start_time" name = "start_time" type="date" required="required"  class="form-control"  autocomplete="off"
                                    placeholder="起始时间" >
                        </div>
                        <div class="form-group">
                            <label>结束时间
                            </label>
                            <input  id="end_time" name = "end_time" type="date" required="required" class="form-control"  autocomplete="off"
                                    placeholder="结束时间">
                        </div>
                        <div class="form-group">
                            <label>任务量
                            </label>
                            <input  id="amount" name = "amount" type="number" class="form-control"  autocomplete="off"
                                    placeholder="任务量"  >
                        </div>
                        <div class="form-group">
                            <label>任务上限
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="upper" name = "upper"type="number" class="form-control"autocomplete="off"
                                   placeholder="任务上限" value="@if(isset($tem)){{$tem->upper}}@endif">
                        </div>
                        <div class="form-group">
                            <label>持续时间
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="sustain" name = "sustain" type="text" class="form-control"  autocomplete="off"
                                   placeholder="持续时间"  value="@if(isset($tem)){{$tem->sustain}}@endif ">
                        </div>
                        <div class="form-group">
                            <label>时间算法
                                <small class="text-red">*</small>
                            </label>
                            <select id="arithmetic" name = "arithmetic" class="js-example-placeholder-single form-control">
                                @foreach($arithmetic as $dict)
                                    <option @if(isset($tem) && $tem->arithmetic == $dict->id ) selected="selected" @endif value="{{$dict->id}}">{{$dict->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
@endsection
