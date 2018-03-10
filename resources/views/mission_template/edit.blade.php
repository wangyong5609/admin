@extends('admin.admin')
@section('title','修改任务模板')
@section('content-header')
    <h1>
        任务模板
    </h1>
    <ol class="breadcrumb">
        <li class="active">任务模板 - 任务模板列表 - 修改任务模板</li>
    </ol>
@stop
@section('content')

    <div class = 'container'>
        <h2 class="page-header">修改任务模板</h2>
        <form method="POST" action="{{url('mission_template/'.$template->id.'/update')}}" accept-charset="utf-8">
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
                                   value="{!!$template->name!!}" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label>任务岗位
                                <small class="text-red">*</small>
                            </label>
                            <select id="post_id" name = "post_id" class="js-example-placeholder-single form-control" >
                                @foreach($posts as $post)
                                    <option @if($template->post_id == $post->id) selected = "selected" @endif value="{{$post->id}}">{{$post->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>描述
                            </label>
                            <input  id="description" name = "description" type="text" class="form-control"  autocomplete="off"
                                    placeholder="描述" maxlength="80" value="{{$template->description}}">
                        </div>
                        <div class="form-group">
                            <label>任务上限
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="upper" name = "upper"type="number" class="form-control"  autocomplete="off"
                                   placeholder="任务上限" maxlength="80" value="{{$template->upper}}">
                        </div>
                        <div class="form-group">
                            <label>持续时间
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="sustain" name = "sustain" type="number" class="form-control"  autocomplete="off"
                                   placeholder="持续时间" maxlength="80" value="{{$template->sustain}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
@endsection
