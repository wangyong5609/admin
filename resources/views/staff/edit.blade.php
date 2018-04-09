@extends('admin.admin')
@section('title','修改员工信息')
@section('content-header')
    <h1>
        员工
    </h1>
    <ol class="breadcrumb">
        <li class="active">员工 - 员工列表 - 修改员工信息</li>
    </ol>
@stop

@section('content')

    <div class = 'container'>
        <h2 class="page-header">修改员工信息</h2>
        <form method="POST" action="{{url('staff/'.$staff->id.'/update')}}" accept-charset="utf-8">
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
                                   value="{!!$staff->name!!}" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label>员工岗位
                                <small class="text-red">*</small>
                            </label>
                            <br>
                            @foreach($posts as $post)
                                <input name="posts[]" type="checkbox" value="{{$post->id}}"
                                       @if($staff->posts()->where('post_id',$post->id)->first())checked="checked" @endif />
                                {{$post->name}}
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label>手机号码
                            </label>
                            <input  id="phone" name = "phone" type="tel" class="form-control"
                                   value="{!!$staff->phone!!}" maxlength="80">
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label>员工状态--}}
                                {{--<small class="text-red">*</small>--}}
                            {{--</label>--}}
                            {{--<select required="required" id="status" name = "status" class="js-example-placeholder-single form-control">--}}
                                {{--@foreach($status as $dict)--}}
                                    {{--<option @if($staff->status_name == $dict->name) selected = "selected"@endif value="{{$dict->id}}">{{$dict->name}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label>描述
                            </label>
                            <input  id="description" name = "description" type="text" class="form-control"  autocomplete="off"
                                    placeholder="描述" maxlength="80" value="{{$staff->description}}">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
@endsection