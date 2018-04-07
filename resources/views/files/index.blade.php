@extends('admin.admin')
@section('title','任务列表')
@section('content-header')
    <h1>
        任务
    </h1>
    <ol class="breadcrumb">
        <li class="active">文件 - 文件列表</li>
    </ol>

@stop

@section('content')
    <div style="margin-top: 5px" class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">上传文件</h3>
            <div class="box-tools">
            </div>
        </div>
        <div class="box-body table-responsive">
            <form action="{{url('/files/upload')}}" method="post" enctype="multipart/form-data">
                选择需要上传的文件:
                    <div class="box-header with-border">
                    <input type="file" name="file" id="file">
                    </div>
                    <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
    </div>

    <div style="margin-top: 5px" class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">文件列表</h3>
            <div class="box-tools">
            </div>
        </div>
        <div class="box-body table-responsive">
            @if( count($files))
                <table class="table table-hover table-bordered">
                    <thead>
                    <th>ID</th>
                    <th>文件名</th>
                    <th>上传时间</th>
                    <th>操作</th>
                    </thead>
                    <tbody>
                    @foreach($files as $file)
                        <tr>
                            <td>{!!$file->id!!}</td>
                            <td>{!!$file->originalename!!}</td>
                            <td>{!!$file->created_at!!}</td>
                            <td><a href="{{url('/files/delete/'.$file->uuid)}}">
                                    删除
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-block">暂无数据 ~_~ </div>
            @endif
                {{ $files->render() }}
        </div>
    </div>

@stop

