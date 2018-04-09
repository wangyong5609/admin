@extends('admin.admin')
@section('title','修改个人信息')
@section('content-header')
    <h1>
        个人信息
    </h1>
    <ol class="breadcrumb">
        <li class="active">个人设置 - 修改个人信息</li>
    </ol>
@stop
@section('content')

    <div class="container">
        <div class="panel panel-default col-md-10 col-md-offset-1">

            @include('common.error')
            <div class="panel-body">

                <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name-field">姓名</label>
                        <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name ) }}" />
                    </div>
                    <div class="form-group">
                        <label for="email-field">用户名</label>
                        <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email ) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>

@endsection