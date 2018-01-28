@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show mission
    </h1>
    <form method = 'get' action = '{!!url("mission")!!}'>
        <button class = 'btn blue'>mission Index</button>
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
                <td>{!!$mission->name!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>post_id : </i></b>
                </td>
                <td>{!!$mission->post_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>description : </i></b>
                </td>
                <td>{!!$mission->description!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>status : </i></b>
                </td>
                <td>{!!$mission->status!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>start_time : </i></b>
                </td>
                <td>{!!$mission->start_time!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>end_time : </i></b>
                </td>
                <td>{!!$mission->end_time!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>complete_time : </i></b>
                </td>
                <td>{!!$mission->complete_time!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>amount : </i></b>
                </td>
                <td>{!!$mission->amount!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>staff_id : </i></b>
                </td>
                <td>{!!$mission->staff_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>upper : </i></b>
                </td>
                <td>{!!$mission->upper!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection