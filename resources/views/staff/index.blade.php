@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        staff Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("staff")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New staff</button>
        </form>
    </div>
    <table>
        <thead>
            <th>name</th>
            <th>birthday</th>
            <th>phone</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($staffs as $staff) 
            <tr>
                <td>{!!$staff->name!!}</td>
                <td>{!!$staff->birthday!!}</td>
                <td>{!!$staff->phone!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/staff/{!!$staff->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/staff/{!!$staff->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/staff/{!!$staff->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $staffs->render() !!}

</div>
@endsection