@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Create')
@section('content')

<div class = 'container'>
    <h1>
        Create staff
    </h1>
    <form method = 'get' action = '{!!url("staff")!!}'>
        <button class = 'btn blue'>staff Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("staff")!!}'>
        <input type = 'hidden' name = '_token' value = '{{ Session::token() }}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate">
            <label for="name">name</label>
        </div>
        <div class="input-field col s6">
            <input id="birthday" name = "birthday" type="text" class="validate">
            <label for="birthday">birthday</label>
        </div>
        <div class="input-field col s6">
            <input id="phone" name = "phone" type="text" class="validate">
            <label for="phone">phone</label>
        </div>
        <button class = 'btn red' type ='submit'>Create</button>
    </form>
</div>
@endsection