@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        mission_template Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("mission_template")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New mission_template</button>
        </form>
    </div>
    <table>
        <thead>
            <th>name</th>
            <th>post_id</th>
            <th>description</th>
            <th>upper</th>
            <th>sustain</th>
            <th>arithmetic</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($mission_templates as $mission_template) 
            <tr>
                <td>{!!$mission_template->name!!}</td>
                <td>{!!$mission_template->post_id!!}</td>
                <td>{!!$mission_template->description!!}</td>
                <td>{!!$mission_template->upper!!}</td>
                <td>{!!$mission_template->sustain!!}</td>
                <td>{!!$mission_template->arithmetic!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/mission_template/{!!$mission_template->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/mission_template/{!!$mission_template->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/mission_template/{!!$mission_template->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $mission_templates->render() !!}

</div>
@endsection