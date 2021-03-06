@extends('admin.admin')
@section('title','添加员工')
@section('other-css')
    {!! editor_css() !!}
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
@endsection
@section('content-header')
    <h1>
        员工
    </h1>
    <ol class="breadcrumb">
        <li class="active">员工 - 添加员工</li>
    </ol>
@stop
@section('content')

    <div class = 'container'>
        <h2 class="page-header">添加员工</h2>
        <form method="POST" action="{{url('/staff')}}" accept-charset="utf-8">
            {!! csrf_field() !!}
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                </ul>
                @include('common.error')
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
                            <br>
                            <div style="font-size: ">
                                @foreach($posts as $post)
                                    <input name="posts[]" type="checkbox" value="{{$post->id}}" />{{$post->name}}
                                @endforeach
                            </div>

                        </div>
                        <div class="form-group">
                            <label>手机号码
                            </label>
                            <input id="phone" name = "phone" type="tel" class="form-control" autocomplete="off"
                                   placeholder="手机号码" maxlength="80">
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