@extends('admin.admin')
@section('title','修改任务')
@section('content-header')
    <h1>
        任务
    </h1>
    <ol class="breadcrumb">
        <li class="active">任务 - 任务列表 - 修改任务信息</li>
    </ol>
@stop

@section('content')

    <div class = 'container'>
        <h2 class="page-header">修改任务信息</h2>
        <form method="post" action="{{url('mission/'.$mission->id.'/update')}}" accept-charset="utf-8">
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
                                   value="{!!$mission->name!!}" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label>任务岗位
                                <small class="text-red">*</small>
                            </label>
                            <select required="required" id="post_id" name = "post_id" class="js-example-placeholder-single form-control" >
                                @foreach($posts as $post)
                                    <option @if($mission->post_name == $post->name) selected = "selected" @endif value="{{$post->id}}">{{$post->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>任务状态
                                <small class="text-red">*</small>
                            </label>
                            <select  disabled="disabled"required="required" id="status" name = "status" class="js-example-placeholder-single form-control">
                                @foreach($status as $dict)
                                    <option @if($mission->status_name == $dict->name) selected = "selected"@endif value="{{$dict->id}}">{{$dict->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>任务描述
                            </label>
                            <input  id="description" name = "description" type="text" class="form-control"  autocomplete="off"
                                    placeholder="任务描述" maxlength="80" value="{{$mission->description}}">
                        </div>

                        <div class="form-group">
                            <label>任务量
                            </label>
                            <input  id="amount" name = "amount" type="number" @if(!empty($mission->staff_id)) disabled="disabled" @endif class="form-control"  autocomplete="off"
                                    placeholder="任务量"  value="{{$mission->amount}}">
                        </div>
                        <div class="form-group">
                            <label>所属人员
                            </label>
                            @if($mission->staff_id)
                                @if(count($staffs))
                                <select required="required" id="staff_id" name = "staff_id" class="js-example-placeholder-single form-control">
                                    <option value="{{$mission->staff_id}}" selected="selected">{{$mission->staff_name}}</option>
                                    @foreach($staffs as $staff)
                                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                                    @endforeach
                                </select>
                                    @else
                                    <input class="form-control"  autocomplete="off" disabled="disabled" value="暂无空闲人员">
                                    @endif
                            @else
                                <input class="form-control"  autocomplete="off" disabled="disabled" value="{{$mission->staff_name}}">
                            @endif
                        </div>

                        <div class="form-group">
                            <label>任务上限
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="upper" name = "upper" type="number"  @if(! empty($mission->staff_id))  disabled="disabled" @endif  class="form-control"  autocomplete="off"
                                   placeholder="任务上限" maxlength="80" value="{{$mission->upper}}">
                        </div>
                        <div class="form-group">
                            <label>持续时间
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="sustain" name = "sustain" type="text" class="form-control"  autocomplete="off"
                                   placeholder="持续时间" maxlength="80" value="{{$mission->sustain}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
@endsection