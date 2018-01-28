@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show log
    </h1>
    <form method = 'get' action = '{!!url("log")!!}'>
        <button class = 'btn blue'>log Index</button>
    </form>
    <table class = 'highlight bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>mission_id : </i></b>
                </td>
                <td>{!!$log->mission_id!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>project : </i></b>
                </td>
                <td>{!!$log->project!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>original : </i></b>
                </td>
                <td>{!!$log->original!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>modification : </i></b>
                </td>
                <td>{!!$log->modification!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection