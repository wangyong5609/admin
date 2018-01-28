@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        mission Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("mission")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New mission</button>
        </form>
    </div>
    <table>
        <thead>
            <th>name</th>
            <th>post_id</th>
            <th>description</th>
            <th>status</th>
            <th>start_time</th>
            <th>end_time</th>
            <th>complete_time</th>
            <th>amount</th>
            <th>staff_id</th>
            <th>upper</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($missions as $mission) 
            <tr>
                <td>{!!$mission->name!!}</td>
                <td>{!!$mission->post_id!!}</td>
                <td>{!!$mission->description!!}</td>
                <td>{!!$mission->status!!}</td>
                <td>{!!$mission->start_time!!}</td>
                <td>{!!$mission->end_time!!}</td>
                <td>{!!$mission->complete_time!!}</td>
                <td>{!!$mission->amount!!}</td>
                <td>{!!$mission->staff_id!!}</td>
                <td>{!!$mission->upper!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/mission/{!!$mission->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/mission/{!!$mission->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/mission/{!!$mission->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $missions->render() !!}

</div>
@endsection