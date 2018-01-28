@extends('admin.admin')
@section('title','Edit')

@section('content')

    <div class = 'container'>
        <h2 class="page-header">修改员工信息员工</h2>
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
                                   value="{!!$staff->name!!}" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label>员工岗位
                                <small class="text-red">*</small>
                            </label>
                            <select id="post" name = "post" class="js-example-placeholder-single form-control" >
                                @foreach($posts as $post)
                                    <option @if($staff->post_name == $post->name) selected = "selected" @endif value="{{$post->id}}">{{$post->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>员工状态
                                <small class="text-red">*</small>
                            </label>
                            <select id="status" name = "status" class="js-example-placeholder-single form-control">
                                @foreach($status as $dict)
                                    <option @if($staff->status_name == $dict->name) selected = "selected"@endif value="{{$dict->id}}">{{$dict->name}}</option>
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
@section('content')

<div class = 'container'>
    <h1>
        修改员工信息
    </h1>
    <form method = 'get' action = '{!!url("staff")!!}'>
        <button class = 'btn blue'>员工列表</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("staff")!!}/{!!$staff->
        id!!}/update'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate" value="{!!$staff->
            name!!}">
            <label for="name">name</label>
        </div>
        <div class="input-field col s6">
            <input id="birthday" name = "birthday" type="text" class="validate" value="{!!$staff->
            birthday!!}">
            <label for="birthday">birthday</label>
        </div>
        <div class="input-field col s6">
            <input id="phone" name = "phone" type="text" class="validate" value="{!!$staff->
            phone!!}">
            <label for="phone">phone</label>
        </div>
        <button class = 'btn red' type ='submit'>Update</button>
    </form>
</div>
@endsection