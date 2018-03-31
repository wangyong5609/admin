@extends('admin.admin')
@section('title',$title)
@section('content-header')
    <h1>
        任务
    </h1>
    <ol class="breadcrumb">
        <li class="active">任务 - 任务列表 - {{$title}}</li>
    </ol>
@stop

@section('content')

    <div class = 'container'>
        <h2 class="page-header">{{$title}}</h2>
        <form method="post" action="{{url('mission/'.$mission->id.'/update')}}" accept-charset="utf-8">
            {!! csrf_field() !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            <label>备注</label>
                            <input id="remark" name = "remark" type="text" class="form-control" autocomplete="off"
                                   value="{!!$mission->remark!!}" >
                        </div>

                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
@endsection