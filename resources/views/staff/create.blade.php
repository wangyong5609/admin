@extends('admin.admin')
@section('other-css')
    {!! editor_css() !!}
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
@endsection
@section('content-header')
    <h1>
        员工
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">员工 - 添加员工</li>
    </ol>
@stop
@section('content')

    <div class = 'container'>
        <h2 class="page-header">添加新员工</h2>
        <form method="POST" action="{{url('/staff')}}" accept-charset="utf-8">
            {!! csrf_field() !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            <label>员工姓名
                                <small class="text-red">*</small>
                            </label>
                            <input required="required" id="name" name = "name" type="text" class="form-control" autocomplete="off"
                                   placeholder="员工姓名" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label>员工岗位
                                <small class="text-red">*</small>
                            </label>
                            <select id="post" name = "post" class="js-example-placeholder-single form-control">
                                @foreach($posts as $post)
                                    <option value="{{$post->id}}">{{$post->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>员工状态
                                <small class="text-red">*</small>
                            </label>
                            <select id="status" name = "status" class="js-example-placeholder-single form-control">
                                @foreach($status as $dict)
                                    <option value="{{$dict->id}}">{{$dict->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>描述
                            </label>
                            <input  id="description" name = "description" type="text" class="form-control"  autocomplete="off"
                                    placeholder="描述" maxlength="80">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
@endsection