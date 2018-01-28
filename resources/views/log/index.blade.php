@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        log Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("log")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New log</button>
        </form>
    </div>
    <table>
        <thead>
            <th>mission_id</th>
            <th>project</th>
            <th>original</th>
            <th>modification</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($logs as $log) 
            <tr>
                <td>{!!$log->mission_id!!}</td>
                <td>{!!$log->project!!}</td>
                <td>{!!$log->original!!}</td>
                <td>{!!$log->modification!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/log/{!!$log->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/log/{!!$log->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/log/{!!$log->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $logs->render() !!}

</div>
@endsection