@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show mission_template
    </h1>
    <form method = 'get' action = '{!!url("mission_template")!!}'>
        <button class = 'btn blue'>mission_template Index</button>
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
                <td>{!!$mission_template->name!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>post_id : </i></b>
                </td>
                <td>{!!$mission_template->post_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>description : </i></b>
                </td>
                <td>{!!$mission_template->description!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>upper : </i></b>
                </td>
                <td>{!!$mission_template->upper!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>sustain : </i></b>
                </td>
                <td>{!!$mission_template->sustain!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>arithmetic : </i></b>
                </td>
                <td>{!!$mission_template->arithmetic!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection