@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Create')
@section('content')

<div class = 'container'>
    <h1>
        Create mission_template
    </h1>
    <form method = 'get' action = '{!!url("mission_template")!!}'>
        <button class = 'btn blue'>mission_template Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("mission_template")!!}'>
        <input type = 'hidden' name = '_token' value = '{{ Session::token() }}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate">
            <label for="name">name</label>
        </div>
        <div class="input-field col s6">
            <input id="post_id" name = "post_id" type="text" class="validate">
            <label for="post_id">post_id</label>
        </div>
        <div class="input-field col s6">
            <input id="description" name = "description" type="text" class="validate">
            <label for="description">description</label>
        </div>
        <div class="input-field col s6">
            <input id="upper" name = "upper" type="text" class="validate">
            <label for="upper">upper</label>
        </div>
        <div class="input-field col s6">
            <input id="sustain" name = "sustain" type="text" class="validate">
            <label for="sustain">sustain</label>
        </div>
        <div class="input-field col s6">
            <input id="arithmetic" name = "arithmetic" type="text" class="validate">
            <label for="arithmetic">arithmetic</label>
        </div>
        <button class = 'btn red' type ='submit'>Create</button>
    </form>
</div>
@endsection