@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show staff
    </h1>
    <form method = 'get' action = '{!!url("staff")!!}'>
        <button class = 'btn blue'>staff Index</button>
    </form>
    <table class = 'highlight bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>name : </i></b>
                </td>
                <td>{!!$staff->name!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>birthday : </i></b>
                </td>
                <td>{!!$staff->birthday!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>phone : </i></b>
                </td>
                <td>{!!$staff->phone!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection